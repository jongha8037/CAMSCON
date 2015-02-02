<?php

class AdditionalFashionBrandsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('AdditionalBrands_20150202');
		$this->command->info('Additional brands seeded! ver: 2015-02-02');
	}

}

class AdditionalBrands_20150202 extends Seeder {

	public function run() {
		FashionBrand::create(array('name_en'=>'R.MUTT','slug'=>'r-mutt','url'=>'http://www.r-mutt.co.kr'));
		FashionBrand::create(array('name_en'=>'SOGAPI','slug'=>'sogapi','url'=>'http://www.sogapi.com'));
		FashionBrand::create(array('name_en'=>'JEFFREY CAMPBELL','slug'=>'jeffrey-campbell','url'=>'http://www.jeffreycampbellshoes.com'));
		FashionBrand::create(array('name_en'=>'MANAS','slug'=>'manas','url'=>'http://www.manas.com'));
		FashionBrand::create(array('name_en'=>'BASS','slug'=>'bass','url'=>'http://www.ghbass.com'));
		FashionBrand::create(array('name_en'=>'STEREO','slug'=>'stereo','url'=>'http://www.stereo-shop.com'));
		FashionBrand::create(array('name_en'=>'ANDREW MARC','slug'=>'andrew-marc','url'=>'http://www.andrewmarc.com'));
		FashionBrand::create(array('name_en'=>'MORGAN','slug'=>'morgan','url'=>'http://www.morgandetoi.com'));
		FashionBrand::create(array('name_en'=>'GROWZE','slug'=>'growze','url'=>'http://www.growze.la'));
		FashionBrand::create(array('name_en'=>'SECOND MOVE','slug'=>'second-move','url'=>'http://www.secondmove.co.kr'));
		FashionBrand::create(array('name_en'=>'ROLEX','slug'=>'rolex','url'=>'http://www.rolex.com/ko'));
		FashionBrand::create(array('name_en'=>'KSUBI','slug'=>'ksubi','url'=>'http://ksubi.com'));
		FashionBrand::create(array('name_en'=>'TUMI','slug'=>'tumi','url'=>'http://www.tumi.com'));
		FashionBrand::create(array('name_en'=>'ANN DEMEULEMEESTER','slug'=>'ann-demeulemeester','url'=>'http://www.anndemeulemeester.be'));
		FashionBrand::create(array('name_en'=>'CARTIER','slug'=>'cartier','url'=>'http://www.cartier.com'));
		FashionBrand::create(array('name_en'=>'MODIFIED','slug'=>'modified','url'=>'http://www.modified.co.kr'));
		FashionBrand::create(array('name_en'=>'BYTHER','slug'=>'byther','url'=>'http://byther.kr'));
		FashionBrand::create(array('name_en'=>'JACK & JILL','slug'=>'jack-and-jill','url'=>'http://www.jackandjill.co.kr'));
		FashionBrand::create(array('name_en'=>'BUFFALO','slug'=>'buffalo','url'=>'http://buffalo.co.kr'));
		FashionBrand::create(array('name_en'=>'FOSSIL','slug'=>'fossil','url'=>'http://www.fossil.co.kr'));
		FashionBrand::create(array('name_en'=>'THE STORI','slug'=>'the-stori','url'=>'http://www.thestori.com'));
		FashionBrand::create(array('name_en'=>'NUOVO','slug'=>'nuovo','url'=>'http://www.nuovo.co.kr/'));
		FashionBrand::create(array('name_en'=>'THE HUNDREDS','slug'=>'the-hundreds','url'=>'http://thehundreds.com'));
		FashionBrand::create(array('name_en'=>'THE ROW','slug'=>'the-row','url'=>'http://www.therow.com'));
		FashionBrand::create(array('name_en'=>'ECCO','slug'=>'ecco','url'=>'http://global.ecco.com'));
		FashionBrand::create(array('name_en'=>'WAREHOUSE','slug'=>'warehouse','url'=>'http://www.warehouse.co.uk'));
		FashionBrand::create(array('name_en'=>'ROCKFISH','slug'=>'rockfish','url'=>'http://erockfish.com/main'));
		FashionBrand::create(array('name_en'=>'SE7EN JEANS','slug'=>'se7en-jeans','url'=>'http://www.7forallmankind.com'));
		FashionBrand::create(array('name_en'=>'MAERYO','slug'=>'maeryo','url'=>'http://www.maeryo.co.kr'));
		FashionBrand::create(array('name_en'=>'BOUNTYXHUNTER','slug'=>'bountyxhunter','url'=>'http://www.bounty-hunter.com'));
		FashionBrand::create(array('name_en'=>'CHRISTOPHER NEMETH','slug'=>'christopher-nemeth','url'=>'http://christophernemeth.co'));
		FashionBrand::create(array('name_en'=>'ALL SAINTS','slug'=>'all-saints','url'=>'http://www.allsaints.co.kr'));
		FashionBrand::create(array('name_en'=>'ESPRIT','slug'=>'esprit','url'=>'http://www.esprit.com'));
		FashionBrand::create(array('name_en'=>'BOTEGA VENETTA','slug'=>'botega-venetta','url'=>'http://www.bottegaveneta.com'));
		FashionBrand::create(array('name_en'=>'MOVE2MOVE','slug'=>'move2move','url'=>'http://www.move2move.kr'));
		FashionBrand::create(array('name_en'=>'MITCHELL & NESS','slug'=>'mitchell-and-ness','url'=>'http://www.mitchellandness.com'));
		FashionBrand::create(array('name_en'=>'PLAYMONSTERS','slug'=>'playmonsters','url'=>'http://www.playmonsters.co.kr'));
		FashionBrand::create(array('name_en'=>'NASTY PALM','slug'=>'nasty-palm','url'=>'http://www.hyperround.com'));
		FashionBrand::create(array('name_en'=>'ROMANTIC CROWN','slug'=>'romantic-crown','url'=>'http://www.romanticcrown.com'));
	}

}
