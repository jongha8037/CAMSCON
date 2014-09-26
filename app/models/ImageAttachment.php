<?php

class ImageAttachment extends Eloquent {

	protected $visible = array('id', 'url', 'width', 'height');
	protected $appends = array('uploaded_file', 'remote_file', 'temp_img', 'source_type', 'relative_path', 'width_restriction', 'height_restriction', 'url');


	/*-------------------------------------------------*/
	/* Protected properties
	/*-------------------------------------------------*/

	protected $uploaded_file=null;
	protected $remote_file=null;
	protected $temp_img=null;
	protected $source_type=null;
	protected $relative_path=null;
	protected $width_restriction=null;
	protected $height_restriction=null;


	/*-------------------------------------------------*/
	/* Accessors
	/*-------------------------------------------------*/

	public function getUploadedFileAttribute() {
		return $this->uploaded_file;
	}//getUploadedFileAttribute()

	public function getRemoteFileAttribute() {
		return $this->remote_file;
	}//getRemoteFileAttribute()

	public function getTempImgAttribute() {
		return $this->temp_img;
	}//getTempImgAttribute()

	public function getSourceTypeAttribute() {
		return $this->source_type;
	}//getSourceTypeAttribute()

	public function getRelativePathAttribute() {
		return $this->relative_path;
	}//getRelativePathAttribute()

	public function getWidthRestrictionAttribute() {
		return $this->width_restriction;
	}//getWidthRestrictionAttribute()

	public function getHeightRestrictionAttribute() {
		return $this->height_restriction;
	}//getHeightRestrictionAttribute()

	public function getUrlAttribute() {
		if(isset($this->id,$this->original_extension,$this->dir_path,$this->filename)) {
			return url( sprintf('%s/%s.%s', $this->dir_path, $this->filename, $this->original_extension) );
		} else {
			return false;
		}
	}//getUrlAttribute()


	/*-------------------------------------------------*/
	/* Setters
	/*-------------------------------------------------*/

	public function restrictWidth($width=null) {
		$this->width_restriction=intval($width);
	}//restrictWidth()

	public function restrictHeight($height) {
		$this->height_restriction=intval($height);
	}//restrictHeight()

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
				throw new Exception('Uploaded file is not an acceptable image.',102);
			} else {
				//Set image size
				$this->width=$imageSize[0];
				$this->height=$imageSize[1];

				//Store file in uploaded_file
				$this->uploaded_file=$file;
				$this->source_type='uploaded';
			}

			return true;
		} else {
			throw new Exception('Uploaded file is not valid.',101);

			return false;
		}
	}//setUploadedFile()

	public function setRemoteFile($url) {
		$imgContent=file_get_contents($url);
		if($imgContent===false) {
			throw new Exception('Remote resource is not available.',201);
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
				$extension=$this->get_extension($mimetype);
				if(!$extension) {
					throw new Exception('Remote resource mime type is not supported.',203);
				} else {
					$this->original_extension=$extension;
				}

				//Create gd image resource
				$this->temp_img=imagecreatefromstring($imgContent);
				if(empty($this->temp_img)) {
					throw new Exception('Remote resource is not an image.',204);
				} else {
					//Get image size
					$width=imagesx($this->temp_img);
					$height=imagesy($this->temp_img);
					if(isset($width,$height)) {
						$this->width=$width;
						$this->height=$height;
						$this->remote_file=$imgContent;
						$this->source_type='remote';
					} else {
						throw new Exception('Failed to access image size.',205);
					}
				}
			} else {
				throw new Exception('Headers not available.',202);
			}

		}
	}//setRemoteFile()


	/*-------------------------------------------------*/
	/* Helpers
	/*-------------------------------------------------*/

	public function generate_path($relative_path) {
		/*-------------------------------------------------*/
		/* Generates storage path and returns absolute path
		/* Creates new directory structure if needed
		/* dir_path property of model is set (relative to public_path())
		/*-------------------------------------------------*/

		//Clean relative path
		$relative_path=str_replace('..', '', $relative_path);
		$relative_path=str_replace(' ', '', $relative_path);
		$relative_path=trim($relative_path, '/');

		$absolute_path=public_path().'/'.$relative_path;
		$sub_path=date('/Y/m', time() );
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
	}//generate_path()

	public function generate_filename() {
		//return pseudo random filename
		return str_random(32);
	}//generate_filename()

	private function get_extension($mime_type) {
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
	}//get_extension()


	/*-------------------------------------------------*/
	/* Bind model event handlers
	/*-------------------------------------------------*/

	public static function boot() {
		parent::boot();

		static::saving(function($attachment) {
			if($attachment->source_type=='uploaded') {
				if($attachment->uploaded_file instanceof Symfony\Component\HttpFoundation\File\UploadedFile) {
					$absolute_path=$attachment->generate_path($attachment->relative_path);
					if($absolute_path) {
						//Generate filename
						$filename=$attachment->generate_filename();
						while(file_exists($absolute_path.'/'.$filename.'.'.$attachment->original_extension)) {
							$filename=$attachment->generate_filename();
						}

						//Resize
						if((isset($attachment->width_restriction) && ($attachment->width>$attachment->width_restriction)) || (isset($attachment->height_restriction) && ($attachment->height>$attachment->height_restriction))) {
							if(isset($attachment->width_restriction) && empty($attachment->height_restriction)) {
								$attachment->height_restriction=$attachment->height/$attachment->width*$attachment->width_restriction;
							} elseif(empty($attachment->width_restriction) && isset($attachment->height_restriction)) {
								$attachment->width_restriction=$attachment->width/$attachment->height*$attachment->height_restriction;
							}

							$originalImg=null;
							switch(strtolower($attachment->original_extension)) {
								case 'jpeg':
									$originalImg=imagecreatefromjpeg($attachment->uploaded_file->getRealPath());
									break;
								case 'jpg':
									$originalImg=imagecreatefromjpeg($attachment->uploaded_file->getRealPath());
									break;
								case 'png':
									$originalImg=imagecreatefrompng($attachment->uploaded_file->getRealPath());
									break;
								case 'gif':
									$originalImg=imagecreatefromgif($attachment->uploaded_file->getRealPath());
									break;
							}
							
							$resizedImg=imagecreatetruecolor($attachment->width_restriction, $attachment->height_restriction);
							imagecopyresampled($resizedImg, $originalImg, 0, 0, 0, 0, $attachment->width_restriction, $attachment->height_restriction, $attachment->width, $attachment->height);

							$saveResult=false;
							switch($attachment->original_extension) {
								case 'jpeg':
									$saveResult=imagejpeg($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension, 100);
									break;
								case 'jpg':
									$saveResult=imagejpeg($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension, 100);
									break;
								case 'png':
									$saveResult=imagepng($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension, 9);
									break;
								case 'gif':
									$saveResult=imagegif($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension);
									break;
							}

							if( $saveResult===false ) {
								//Failed to store file
								Log::error('Failed to store resized image.', array('resizedImg'=>$resizedImg, 'path'=>$absolute_path.'/'.$filename.'.'.$attachment->original_extension));
								return false;
							} else {
								//File has been stored!!!
								$attachment->width=imagesx($resizedImg);
								$attachment->height=imagesy($resizedImg);
								$attachment->filename=$filename;
							}
						} else {
							//Move file
							try {
								$attachment->uploaded_file->move($absolute_path, $filename.'.'.$attachment->original_extension);
							} catch(FileException $e) {
								//Failed to move file
								Log::error('Failed to move file.');
								return false;
							}
						}

						//File has been moved!!!
						$attachment->filename=$filename;
					} else {
						//Path generation failed
						Log::error('Path generation failed.');
						return false;
					}
				} else {
					//uploaded_file is not an instance of UploadedFile
					Log::error('Uploaded_file is not an instance of UploadedFile.');
					return false;
				}
			} elseif($attachment->source_type=='remote') {
				if(!empty($attachment->remote_file)) {
					$absolute_path=$attachment->generate_path($attachment->relative_path);
					if($absolute_path) {
						//Generate filename
						$filename=$attachment->generate_filename();
						while(file_exists($absolute_path.'/'.$filename.'.'.$attachment->original_extension)) {
							$filename=$attachment->generate_filename();
						}

						//Resize
						if((isset($attachment->width_restriction) && ($attachment->width>$attachment->width_restriction)) || (isset($attachment->height_restriction) && ($attachment->height>$attachment->height_restriction))) {
							if(isset($attachment->width_restriction) && empty($attachment->height_restriction)) {
								$attachment->height_restriction=$attachment->height/$attachment->width*$attachment->width_restriction;
							} elseif(empty($attachment->width_restriction) && isset($attachment->height_restriction)) {
								$attachment->width_restriction=$attachment->width/$attachment->height*$attachment->height_restriction;
							}
							
							$resizedImg=imagecreatetruecolor($attachment->width_restriction, $attachment->height_restriction);
							imagecopyresampled($resizedImg, $attachment->temp_img, 0, 0, 0, 0, $attachment->width_restriction, $attachment->height_restriction, $attachment->width, $attachment->height);

							$saveResult=false;
							switch($attachment->original_extension) {
								case 'jpeg':
									$saveResult=imagejpeg($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension, 100);
									break;
								case 'jpg':
									$saveResult=imagejpeg($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension, 100);
									break;
								case 'png':
									$saveResult=imagepng($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension, 9);
									break;
								case 'gif':
									$saveResult=imagegif($resizedImg, $absolute_path.'/'.$filename.'.'.$attachment->original_extension);
									break;
							}

							if( $saveResult===false ) {
								//Failed to store file
								return false;
							} else {
								//File has been stored!!!
								$attachment->width=imagesx($resizedImg);
								$attachment->height=imagesy($resizedImg);
								$attachment->filename=$filename;
							}
						} else {
							//Store file
							if( file_put_contents($absolute_path.'/'.$filename.'.'.$attachment->original_extension, $attachment->remote_file)===false ) {
								//Failed to store file
								return false;
							}
						}

						//File has been stored!!!
						$attachment->filename=$filename;
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

		static::deleting(function($attachment) {
			$file=public_path().'/'.$attachment->dir_path.'/'.$attachment->filename.'.'.$attachment->original_extension;
			if(File::exists($file)) {
				return File::delete($file);
			}
		});
	}//boot()

}