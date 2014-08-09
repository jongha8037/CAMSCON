<?php

class ImageAttachment extends Eloquent {

	//protected $appends = array('uploaded_file','remote_file');

	private $uploaded_file=null;
	private $remote_file=null;
	private $source_type=null;
	protected $relative_path=null;

	public function setUploadedFile(Symfony\Component\HttpFoundation\File\UploadedFile $file) {

		/*-------------------------------------------------*/
		/* UploadedFile extends SplFileInfo
		/*-------------------------------------------------*/

		if($file->isValid()) {
			//Set basic file information
			$this->original_name=$file->getClientOriginalName();
			$this->original_extension=$file->getClientOriginalExtension();
			$this->mime_type=$file->getMimeType();
			$this->size=$file->getSize();

			$uploadedPath=$file->getRealPath();
			$imageSize=getimagesize($uploadedPath);
			if($imageSize===false) {
				throw new Exception('Uploaded file is not an acceptable image.','102');
			} else {
				//Set image size
				$this->width=$imageSize[0];
				$this->height=$imageSize[1];

				//Store file in uploaded_file
				$this->uploaded_file=$file;
				$this->source_type='uploaded';
			}
		} else {
			throw new Exception('Uploaded file is not valid.','101');
		}
	}//setUploadedFile()

	public function setRemoteFile($url) {
		$imgContent=file_get_contents($url);
		if($imgContent===false) {
			throw new Exception('Remote resource is not available.','201');
		} else {
			//Parse response header
			$filesize=null;$mimetype=null;

			//Content-Length
			$contentLengthPattern='/^content-length/';
			foreach($http_response_header as $header) {
				if(preg_match($contentLengthPattern, strtolower($header))===1) {
					$headerArray=explode(':', $header);
					$filesize=intval(trim(end($headerArray)));
					if($filesize==0) {
						$filesize=null;
					}
					break;
				}
			}

			//Content-Type
			$contentTypePattern='/^content-type/';
			foreach($http_response_header as $header) {
				if(preg_match($contentTypePattern, strtolower($header))===1) {
					$headerArray=explode(':', $header);
					$mimetype=trim(strtolower(end($headerArray)));
					break;
				}
			}

			if(isset($filesize,$mimetype)) {
				$this->size=$filesize;
				$this->mime_type=$mimetype;
				//Get file extension from mime type
				$extension=$this->getExtension($mimetype);
				if(!$extension) {
					throw new Exception('Remote resource mime type is not supported.','203');
				} else {
					$this->original_extension=$extension;
				}

				//Create gd image resource
				$img=imagecreatefromstring($imgContent);
				if($img===false) {
					throw new Exception('Remote resource is not an image.','204');
				} else {
					//Get image size
					$width=imagesx($img);
					$height=imagesy($img);
					if(isset($width,$height)) {
						$this->width=$width;
						$this->height=$height;
						$this->remote_file=$imgContent;
						$this->source_type='remote';
					} else {
						throw new Exception('Failed to access image size.','205');
					}
				}
			} else {
				throw new Exception('Headers not available.','202');
			}

		}
	}//setRemoteFile()

	private function generatePath($relative_path) {
		/*-------------------------------------------------*/
		/* Generates storage path and returns absolute path
		/* Creates new directory structure if needed
		/* dir_path property of model is set (relative to public_path())
		/*-------------------------------------------------*/

		$absolute_path=public_path().'/'.$relative_path;
		$dateArray=explode('-', date('Y-m', time() ) );
		$sub_path=sprintf('/%s/%s', $dateArray[0], $dateArray[1]);
		$absolute_path.=$sub_path;

		//Create new directory structure if needed
		if(file_exists($absolute_path)) {
			if(!is_dir($absolute_path)) {
				//absolute_path exists as file
				return false;
			}
		} else {
			//Create directory (rwx-rwx-r--)
			if( mkdir($absolute_path, 0774, true)!==true ) {
				//failed to create directory
				return false;
			}
		}

		//Check dir writable
		if(!is_writable($absolute_path)) {
			//absolute_path is not writable
			return false;
		}

		//Set dir_path property in model
		$this->dir_path=$relative_path.$sub_path;

		//Return the absolute path
		return $absolute_path;
	}//generatePath()

	private function generateFilename() {
		//return pseudo random filename
		return str_random(32);
	}//generateFilename()

	private function getExtension($mime_type) {
		$mimeTypes=array(
			'image/jpeg'=>'jpeg',
			'image/pjpeg'=>'jpeg',
			'image/png'=>'png',
			'image/gif'=>'gif'
		);

		if(isset($mimeTypes[$mime_type])) {
			return $mimeTypes[$mime_type];
		} else {
			return null;
		}
	}//getExtension()

	public static function boot() {
		parent::boot();

		static::saving(function($attachment) {
			if($attachment->source_type=='uploaded') {
				if($attachment->uploaded_file instanceof Symfony\Component\HttpFoundation\File\UploadedFile) {
					$absolute_path=$attachment->generatePath($attachment->relative_path);
					if($absolute_path) {
						//Generate filename
						$filename=$attachment->generateFilename();
						while(file_exists($absolute_path.'/'.$filename.'.'.$attachment->original_extension)) {
							$filename=$attachment->generateFilename();
						}
						//Move file
						try {
							$attachment->uploaded_file->move($absolute_path, $filename.'.'.$attachment->original_extension);
						} catch(FileException $e) {
							//Failed to move file
							return false;
						}

						//File has been moved!!!
						$attachment->filename=$filename;
					} else {
						//Path generation failed
						return false;
					}
				} else {
					//uploaded_file is not an instance of UploadedFile
					return false;
				}
			} elseif($attachment->source_type=='remote') {
				if(!empty($attachment->remote_file)) {
					$absolute_path=$attachment->generatePath($attachment->relative_path);
					if($absolute_path) {
						//Generate filename
						$filename=$attachment->generateFilename();
						while(file_exists($absolute_path.'/'.$filename.'.'.$attachment->original_extension)) {
							$filename=$attachment->generateFilename();
						}
						//Store file
						if( file_put_contents($absolute_path.'/'.$filename.'.'.$attachment->original_extension, $attachment->remote_file)===false ) {
							//Failed to store file
							return false;
						} else {
							//File has been stored!!!
							$attachment->filename=$filename;
						}
					} else {
						//Path generation failed
						return false;
					}
				} else {
					//remote_file is not set
					return false;
				}
			} else {
				//source_type is not set
				return false;
			}
		});//static::saving()
	}//boot()

}