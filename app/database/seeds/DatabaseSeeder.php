<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('GroupTableSeeder');
		$this->command->info('Group table seeded!');

		$this->call('CampusMetaTableSeeder');
		$this->command->info('Campus meta table seeded!');

		$this->call('FashionBrandsTableSeeder');
		$this->command->info('Fashion brands table seeded!');

		$this->call('StreetMetaTableSeeder');
		$this->command->info('Street meta table seeded!');
	}

}

class GroupTableSeeder extends Seeder {

	public function run() {
		DB::table('groups')->delete();
		DB::table('groups')->truncate();

		Group::create(array('name'=>'Campus Style Icons'));
		Group::create(array('name'=>'Active Photographers'));
		Group::create(array('name'=>'Retired Photographers'));
		Group::create(array('name'=>'Bloggers'));
		Group::create(array('name'=>'Staff'));
		Group::create(array('name'=>'Managers'));
		Group::create(array('name'=>'Super Users'));
		Group::create(array('name'=>'Blacklist'));
	}

}

class CampusMetaTableSeeder extends Seeder {

	public function run() {
		DB::table('campus_meta')->delete();
		DB::table('campus_meta')->truncate();
		
		CampusMeta::create(array('name_ko'=>'가천대'));
		CampusMeta::create(array('name_ko'=>'가톨릭대'));
		CampusMeta::create(array('name_ko'=>'강원대'));
		CampusMeta::create(array('name_ko'=>'건국대'));
		CampusMeta::create(array('name_ko'=>'건국대(글로컬)'));
		CampusMeta::create(array('name_ko'=>'경기대'));
		CampusMeta::create(array('name_ko'=>'경북대'));
		CampusMeta::create(array('name_ko'=>'경상대'));
		CampusMeta::create(array('name_ko'=>'경성대'));
		CampusMeta::create(array('name_ko'=>'경인교대'));
		CampusMeta::create(array('name_ko'=>'경찰대학'));
		CampusMeta::create(array('name_ko'=>'경희대'));
		CampusMeta::create(array('name_ko'=>'계명대'));
		CampusMeta::create(array('name_ko'=>'계원예대'));
		CampusMeta::create(array('name_ko'=>'고려대'));
		CampusMeta::create(array('name_ko'=>'고려대(세종)'));
		CampusMeta::create(array('name_ko'=>'공군사관학교'));
		CampusMeta::create(array('name_ko'=>'공주대'));
		CampusMeta::create(array('name_ko'=>'광운대'));
		CampusMeta::create(array('name_ko'=>'국민대'));
		CampusMeta::create(array('name_ko'=>'국제패션학교'));
		CampusMeta::create(array('name_ko'=>'노인대학'));
		CampusMeta::create(array('name_ko'=>'단국대'));
		CampusMeta::create(array('name_ko'=>'단국대(천안)'));
		CampusMeta::create(array('name_ko'=>'대구대'));
		CampusMeta::create(array('name_ko'=>'대진대'));
		CampusMeta::create(array('name_ko'=>'덕성여대'));
		CampusMeta::create(array('name_ko'=>'동국대'));
		CampusMeta::create(array('name_ko'=>'동국대(경주)'));
		CampusMeta::create(array('name_ko'=>'동덕여대'));
		CampusMeta::create(array('name_ko'=>'동명대'));
		CampusMeta::create(array('name_ko'=>'동아대'));
		CampusMeta::create(array('name_ko'=>'동양미래대'));
		CampusMeta::create(array('name_ko'=>'라사라패션학교'));
		CampusMeta::create(array('name_ko'=>'명지대'));
		CampusMeta::create(array('name_ko'=>'목원대'));
		CampusMeta::create(array('name_ko'=>'백석대'));
		CampusMeta::create(array('name_ko'=>'부경대'));
		CampusMeta::create(array('name_ko'=>'부산경상대'));
		CampusMeta::create(array('name_ko'=>'부산대'));
		CampusMeta::create(array('name_ko'=>'삼육대'));
		CampusMeta::create(array('name_ko'=>'상명대'));
		CampusMeta::create(array('name_ko'=>'상명대(천안)'));
		CampusMeta::create(array('name_ko'=>'상지대'));
		CampusMeta::create(array('name_ko'=>'서강대'));
		CampusMeta::create(array('name_ko'=>'서경대'));
		CampusMeta::create(array('name_ko'=>'서울과기대'));
		CampusMeta::create(array('name_ko'=>'서울대'));
		CampusMeta::create(array('name_ko'=>'서울모드패션학교'));
		CampusMeta::create(array('name_ko'=>'서울시립대'));
		CampusMeta::create(array('name_ko'=>'서울여대'));
		CampusMeta::create(array('name_ko'=>'서울예전'));
		CampusMeta::create(array('name_ko'=>'서울종합예술학교'));
		CampusMeta::create(array('name_ko'=>'성균관대'));
		CampusMeta::create(array('name_ko'=>'성신여대'));
		CampusMeta::create(array('name_ko'=>'세종대'));
		CampusMeta::create(array('name_ko'=>'수원대'));
		CampusMeta::create(array('name_ko'=>'숙명여대'));
		CampusMeta::create(array('name_ko'=>'순천향대'));
		CampusMeta::create(array('name_ko'=>'숭실대'));
		CampusMeta::create(array('name_ko'=>'숭의여대'));
		CampusMeta::create(array('name_ko'=>'신구대'));
		CampusMeta::create(array('name_ko'=>'아주대'));
		CampusMeta::create(array('name_ko'=>'에스모드패션학교'));
		CampusMeta::create(array('name_ko'=>'연세대'));
		CampusMeta::create(array('name_ko'=>'연세대(원주)'));
		CampusMeta::create(array('name_ko'=>'영남대'));
		CampusMeta::create(array('name_ko'=>'용인대'));
		CampusMeta::create(array('name_ko'=>'원광대'));
		CampusMeta::create(array('name_ko'=>'육군사관학교'));
		CampusMeta::create(array('name_ko'=>'을지대'));
		CampusMeta::create(array('name_ko'=>'이화여대'));
		CampusMeta::create(array('name_ko'=>'인천대'));
		CampusMeta::create(array('name_ko'=>'인하공업전문대학'));
		CampusMeta::create(array('name_ko'=>'인하대'));
		CampusMeta::create(array('name_ko'=>'전남대'));
		CampusMeta::create(array('name_ko'=>'전북대'));
		CampusMeta::create(array('name_ko'=>'전주대'));
		CampusMeta::create(array('name_ko'=>'조선대'));
		CampusMeta::create(array('name_ko'=>'중앙대'));
		CampusMeta::create(array('name_ko'=>'중앙대(안성)'));
		CampusMeta::create(array('name_ko'=>'창원대'));
		CampusMeta::create(array('name_ko'=>'청주대'));
		CampusMeta::create(array('name_ko'=>'충남대'));
		CampusMeta::create(array('name_ko'=>'충북대'));
		CampusMeta::create(array('name_ko'=>'카이스트'));
		CampusMeta::create(array('name_ko'=>'포항공대'));
		CampusMeta::create(array('name_ko'=>'한경대'));
		CampusMeta::create(array('name_ko'=>'한국산기대'));
		CampusMeta::create(array('name_ko'=>'한국외대'));
		CampusMeta::create(array('name_ko'=>'한국외대(글로벌)'));
		CampusMeta::create(array('name_ko'=>'한국체대'));
		CampusMeta::create(array('name_ko'=>'한국항공대'));
		CampusMeta::create(array('name_ko'=>'한국해양대'));
		CampusMeta::create(array('name_ko'=>'한남대'));
		CampusMeta::create(array('name_ko'=>'한림대'));
		CampusMeta::create(array('name_ko'=>'한밭대'));
		CampusMeta::create(array('name_ko'=>'한서대'));
		CampusMeta::create(array('name_ko'=>'한성대'));
		CampusMeta::create(array('name_ko'=>'한신대'));
		CampusMeta::create(array('name_ko'=>'한양대'));
		CampusMeta::create(array('name_ko'=>'한양대(ERICA)'));
		CampusMeta::create(array('name_ko'=>'한예종'));
		CampusMeta::create(array('name_ko'=>'해군사관학교'));
		CampusMeta::create(array('name_ko'=>'호서대'));
		CampusMeta::create(array('name_ko'=>'홍익대'));
		CampusMeta::create(array('name_ko'=>'홍익대(세종)'));
		CampusMeta::create(array('name_en'=>'Beppu Univ.'));
		CampusMeta::create(array('name_en'=>'Dublin City Univ.'));
		CampusMeta::create(array('name_en'=>'Jonkoping Univ.'));
		CampusMeta::create(array('name_en'=>'London College of Fashion'));
		CampusMeta::create(array('name_en'=>'Monash Univ.'));
		CampusMeta::create(array('name_en'=>'Nihon Univ.'));
		CampusMeta::create(array('name_en'=>'SCAD'));
		CampusMeta::create(array('name_en'=>'UCLA'));
		CampusMeta::create(array('name_en'=>'UNIST'));
		CampusMeta::create(array('name_en'=>'Univ of Iowa'));
		CampusMeta::create(array('name_en'=>'Univ of Melbourne'));
		CampusMeta::create(array('name_en'=>'Univ of Toronto'));
		CampusMeta::create(array('name_en'=>'Yokohama National Univ.'));
		CampusMeta::create(array('name_en'=>'York Univ.'));
	}

}

class FashionBrandsTableSeeder extends Seeder {

	public function run() {
		DB::table('fashion_brands')->delete();
		DB::table('fashion_brands')->truncate();

		FashionBrand::create(array('name_en'=>'N/A'));
		FashionBrand::create(array('name_en'=>'8-SECONDS'));
		FashionBrand::create(array('name_en'=>'ACCESSORIZE'));
		FashionBrand::create(array('name_en'=>'ACNE'));
		FashionBrand::create(array('name_en'=>'ALO'));
		FashionBrand::create(array('name_en'=>'A-LAND'));
		FashionBrand::create(array('name_en'=>'A.P.C'));
		FashionBrand::create(array('name_en'=>'ABERCROMBIE'));
		FashionBrand::create(array('name_en'=>'ADIDAS'));
		FashionBrand::create(array('name_en'=>'ALDO'));
		FashionBrand::create(array('name_en'=>'ALEXANDER MCQUEEN'));
		FashionBrand::create(array('name_en'=>'ALEXANDER WANG'));
		FashionBrand::create(array('name_en'=>'AMERICAN APPAREL'));
		FashionBrand::create(array('name_en'=>'ANNE KLEIN'));
		FashionBrand::create(array('name_en'=>'APRIL 77'));
		FashionBrand::create(array('name_en'=>'ARMANI'));
		FashionBrand::create(array('name_en'=>'ARMANI EXCHANGE'));
		FashionBrand::create(array('name_en'=>'ASICS'));
		FashionBrand::create(array('name_en'=>'ASOS'));
		FashionBrand::create(array('name_en'=>'BALENCIAGA'));
		FashionBrand::create(array('name_en'=>'BALLY'));
		FashionBrand::create(array('name_en'=>'BALMAIN'));
		FashionBrand::create(array('name_en'=>'BANANA REPUBLIC'));
		FashionBrand::create(array('name_en'=>'BEAN POLE'));
		FashionBrand::create(array('name_en'=>'BENETTON'));
		FashionBrand::create(array('name_en'=>'BEYOND CLOSET'));
		FashionBrand::create(array('name_en'=>'BIKE REPAIR SHOP'));
		FashionBrand::create(array('name_en'=>'BIRKEN STOCK'));
		FashionBrand::create(array('name_en'=>'BON'));
		FashionBrand::create(array('name_en'=>'BROOKS BROTHERS'));
		FashionBrand::create(array('name_en'=>'BROWNBREATH'));
		FashionBrand::create(array('name_en'=>'BURBERRY'));
		FashionBrand::create(array('name_en'=>'BVLGARI'));
		FashionBrand::create(array('name_en'=>'CALVIN KLEIN'));
		FashionBrand::create(array('name_en'=>'CAMPER'));
		FashionBrand::create(array('name_en'=>'CAMPO MARZIO'));
		FashionBrand::create(array('name_en'=>'CARHARTT'));
		FashionBrand::create(array('name_en'=>'CASIO'));
		FashionBrand::create(array('name_en'=>'CELINE'));
		FashionBrand::create(array('name_en'=>'CHANEL'));
		FashionBrand::create(array('name_en'=>'CHEAP MONDAY'));
		FashionBrand::create(array('name_en'=>'CHLOE'));
		FashionBrand::create(array('name_en'=>'CHRISTIAN DIOR'));
		FashionBrand::create(array('name_en'=>'CLARKS'));
		FashionBrand::create(array('name_en'=>'CLUB MONACO'));
		FashionBrand::create(array('name_en'=>'COACH'));
		FashionBrand::create(array('name_en'=>'CODES COMBINE'));
		FashionBrand::create(array('name_en'=>'COMING STEP'));
		FashionBrand::create(array('name_en'=>'COMME DES GARÇONS'));
		FashionBrand::create(array('name_en'=>'CONVERSE'));
		FashionBrand::create(array('name_en'=>'COURONNE'));
		FashionBrand::create(array('name_en'=>'COVERNAT'));
		FashionBrand::create(array('name_en'=>'CUSTOMELLOW'));
		FashionBrand::create(array('name_en'=>'D&G'));
		FashionBrand::create(array('name_en'=>'DAKS'));
		FashionBrand::create(array('name_en'=>'DIESEL'));
		FashionBrand::create(array('name_en'=>'DKNY'));
		FashionBrand::create(array('name_en'=>'DR MARTENS'));
		FashionBrand::create(array('name_en'=>'DSQUARED2'));
		FashionBrand::create(array('name_en'=>'EAST PAK'));
		FashionBrand::create(array('name_en'=>'FENDI'));
		FashionBrand::create(array('name_en'=>'FREITAG'));
		FashionBrand::create(array('name_en'=>'FERRAGAMO'));
		FashionBrand::create(array('name_en'=>'FILA'));
		FashionBrand::create(array('name_en'=>'FOREVER21'));
		FashionBrand::create(array('name_en'=>'FRED PERRY'));
		FashionBrand::create(array('name_en'=>'GALAXY NOTE 3+ GEAR'));
		FashionBrand::create(array('name_en'=>'GAP'));
		FashionBrand::create(array('name_en'=>'GIORDANO'));
		FashionBrand::create(array('name_en'=>'GENERAL IDEA'));
		FashionBrand::create(array('name_en'=>'GENTLE MONSTER'));
		FashionBrand::create(array('name_en'=>'GIORGIO ARMANI'));
		FashionBrand::create(array('name_en'=>'GIVENCHY'));
		FashionBrand::create(array('name_en'=>'GUCCI'));
		FashionBrand::create(array('name_en'=>'GUESS'));
		FashionBrand::create(array('name_en'=>'H&M'));
		FashionBrand::create(array('name_en'=>'HAZZYS'));
		FashionBrand::create(array('name_en'=>'HEAD'));
		FashionBrand::create(array('name_en'=>'HAWKINS'));
		FashionBrand::create(array('name_en'=>'HOLLISTER'));
		FashionBrand::create(array('name_en'=>'HUNTER'));
		FashionBrand::create(array('name_en'=>'INCASE'));
		FashionBrand::create(array('name_en'=>'IT MICHAA'));
		FashionBrand::create(array('name_en'=>'J.CREW'));
		FashionBrand::create(array('name_en'=>'J.ESTINA'));
		FashionBrand::create(array('name_en'=>'JANSPORT'));
		FashionBrand::create(array('name_en'=>'JIL SANDER'));
		FashionBrand::create(array('name_en'=>'JILL STUART'));
		FashionBrand::create(array('name_en'=>'JILL BY JILL STUART'));
		FashionBrand::create(array('name_en'=>'JUUN.J'));
		FashionBrand::create(array('name_en'=>'KAI-AKKMAN'));
		FashionBrand::create(array('name_en'=>'KANGOL'));
		FashionBrand::create(array('name_en'=>'KEDS'));
		FashionBrand::create(array('name_en'=>'KENZO'));
		FashionBrand::create(array('name_en'=>'KIPLING'));
		FashionBrand::create(array('name_en'=>'KRIS VAN ASSCHE'));
		FashionBrand::create(array('name_en'=>'LACOSTE'));
		FashionBrand::create(array('name_en'=>'LACOSTE L!VE'));
		FashionBrand::create(array('name_en'=>'LANVIN'));
		FashionBrand::create(array('name_en'=>'LAP'));
		FashionBrand::create(array('name_en'=>'LAPALETTE'));
		FashionBrand::create(array('name_en'=>'LESHOP'));
		FashionBrand::create(array('name_en'=>'LESPORTSAC'));
		FashionBrand::create(array('name_en'=>"LEVI'S"));
		FashionBrand::create(array('name_en'=>'LEWITT'));
		FashionBrand::create(array('name_en'=>'LIFUL'));
		FashionBrand::create(array('name_en'=>'LONGCHAMP'));
		FashionBrand::create(array('name_en'=>'LOUIS QUATORZE'));
		FashionBrand::create(array('name_en'=>'LOUIS VUITTON'));
		FashionBrand::create(array('name_en'=>'LOW CLASSIC'));
		FashionBrand::create(array('name_en'=>'LOVCAT'));
		FashionBrand::create(array('name_en'=>'LUCKY CHOUETTE'));
		FashionBrand::create(array('name_en'=>'MANDARINA DUCK'));
		FashionBrand::create(array('name_en'=>'MANGO'));
		FashionBrand::create(array('name_en'=>'MARC JACOBS'));
		FashionBrand::create(array('name_en'=>'MARC BY MARC JACBOS'));
		FashionBrand::create(array('name_en'=>'MARGARIN FINGERS'));
		FashionBrand::create(array('name_en'=>'MCM'));
		FashionBrand::create(array('name_en'=>'MELLOW PLANET'));
		FashionBrand::create(array('name_en'=>'METROCITY'));
		FashionBrand::create(array('name_en'=>'MICHAEL KORS'));
		FashionBrand::create(array('name_en'=>'MINNETONKA'));
		FashionBrand::create(array('name_en'=>'MIXXO'));
		FashionBrand::create(array('name_en'=>'MLB'));
		FashionBrand::create(array('name_en'=>'MUJI'));
		FashionBrand::create(array('name_en'=>'MULBERRY'));
		FashionBrand::create(array('name_en'=>'MVIO'));
		FashionBrand::create(array('name_en'=>'NEW BALANCE'));
		FashionBrand::create(array('name_en'=>'NIKE'));
		FashionBrand::create(array('name_en'=>'NINE WEST'));
		FashionBrand::create(array('name_en'=>'NUDIE JEANS'));
		FashionBrand::create(array('name_en'=>'OAKLEY'));
		FashionBrand::create(array('name_en'=>'OBEY'));
		FashionBrand::create(array('name_en'=>'OILILY'));
		FashionBrand::create(array('name_en'=>'OLIVE DES OLIVE'));
		FashionBrand::create(array('name_en'=>'OMEGA'));
		FashionBrand::create(array('name_en'=>'OST'));
		FashionBrand::create(array('name_en'=>'OZOC'));
		FashionBrand::create(array('name_en'=>'PAUL SMITH'));
		FashionBrand::create(array('name_en'=>'PLAC JEANS'));
		FashionBrand::create(array('name_en'=>'PLASTIC ISLAND'));
		FashionBrand::create(array('name_en'=>'POLO'));
		FashionBrand::create(array('name_en'=>'PONY'));
		FashionBrand::create(array('name_en'=>'PRADA'));
		FashionBrand::create(array('name_en'=>'PUMA'));
		FashionBrand::create(array('name_en'=>'QUA'));
		FashionBrand::create(array('name_en'=>'RAF SIMONS'));
		FashionBrand::create(array('name_en'=>'RALPH LAUREN'));
		FashionBrand::create(array('name_en'=>'RAY BAN'));
		FashionBrand::create(array('name_en'=>'REEBOK'));
		FashionBrand::create(array('name_en'=>'RICK OWENS'));
		FashionBrand::create(array('name_en'=>'ROCK PORT'));
		FashionBrand::create(array('name_en'=>'ROEM'));
		FashionBrand::create(array('name_en'=>'ROMANTIC MOVE'));
		FashionBrand::create(array('name_en'=>'SAINT JAMES'));
		FashionBrand::create(array('name_en'=>'SAMSONITE'));
		FashionBrand::create(array('name_en'=>'SAUCONY'));
		FashionBrand::create(array('name_en'=>'SEIKO'));
		FashionBrand::create(array('name_en'=>'SERIES;'));
		FashionBrand::create(array('name_en'=>'SISLEY'));
		FashionBrand::create(array('name_en'=>'SODA'));
		FashionBrand::create(array('name_en'=>'SOUP'));
		FashionBrand::create(array('name_en'=>'SPAO'));
		FashionBrand::create(array('name_en'=>'SPRIS'));
		FashionBrand::create(array('name_en'=>'STEVEJ & YONIP'));
		FashionBrand::create(array('name_en'=>'STYLE NANDA'));
		FashionBrand::create(array('name_en'=>'SUE COMMA BONNIE'));
		FashionBrand::create(array('name_en'=>'SUPER'));
		FashionBrand::create(array('name_en'=>'SUPERGA'));
		FashionBrand::create(array('name_en'=>'SWAROVSKI'));
		FashionBrand::create(array('name_en'=>'SWATCH'));
		FashionBrand::create(array('name_en'=>'SYSTEM'));
		FashionBrand::create(array('name_en'=>'T.I FOR MEN'));
		FashionBrand::create(array('name_en'=>'TAG HEUER'));
		FashionBrand::create(array('name_en'=>'TANDY'));
		FashionBrand::create(array('name_en'=>'TATE'));
		FashionBrand::create(array('name_en'=>'THE NORTH FACE'));
		FashionBrand::create(array('name_en'=>'THEORY'));
		FashionBrand::create(array('name_en'=>'THURSDAY ISLAND'));
		FashionBrand::create(array('name_en'=>'TIMBERLAND'));
		FashionBrand::create(array('name_en'=>'TIME'));
		FashionBrand::create(array('name_en'=>'TIMEX'));
		FashionBrand::create(array('name_en'=>'TISSOT'));
		FashionBrand::create(array('name_en'=>'T-LEVEL'));
		FashionBrand::create(array('name_en'=>'TNGT'));
		FashionBrand::create(array('name_en'=>'TOMBOY'));
		FashionBrand::create(array('name_en'=>'TOMFORD'));
		FashionBrand::create(array('name_en'=>'TOMMY HILFIGER'));
		FashionBrand::create(array('name_en'=>'TOMS'));
		FashionBrand::create(array('name_en'=>'TOPMAN'));
		FashionBrand::create(array('name_en'=>'TOPSHOP'));
		FashionBrand::create(array('name_en'=>'TOP10'));
		FashionBrand::create(array('name_en'=>'TORY BURCH'));
		FashionBrand::create(array('name_en'=>'UGG'));
		FashionBrand::create(array('name_en'=>'UNIQLO'));
		FashionBrand::create(array('name_en'=>'URBAN OUTFITTERS'));
		FashionBrand::create(array('name_en'=>'VANS'));
		FashionBrand::create(array('name_en'=>'VERSACE'));
		FashionBrand::create(array('name_en'=>'VIVA STUDIO'));
		FashionBrand::create(array('name_en'=>'VIVIENNE WESTWOOD'));
		FashionBrand::create(array('name_en'=>'YOHJI YAMAMOTO'));
		FashionBrand::create(array('name_en'=>'YSL'));
		FashionBrand::create(array('name_en'=>'ZARA'));
		FashionBrand::create(array('name_en'=>'LOCLE'));
		FashionBrand::create(array('name_en'=>'GRAFIK PLASTIC'));
		FashionBrand::create(array('name_en'=>'VINTAGE HOLLYWOOD'));
		FashionBrand::create(array('name_en'=>'87MM'));
		FashionBrand::create(array('name_en'=>'NOHANT'));
		FashionBrand::create(array('name_en'=>'S=YZ'));
		FashionBrand::create(array('name_en'=>'UNBOUNDED AWE'));
		FashionBrand::create(array('name_en'=>'BPB'));
		FashionBrand::create(array('name_en'=>'VANDALIST'));
		FashionBrand::create(array('name_en'=>'EXCLUSIVE'));
		FashionBrand::create(array('name_en'=>'ROCKET X LUNCH'));
		FashionBrand::create(array('name_en'=>'BLINDNESS'));
		FashionBrand::create(array('name_en'=>'FUNFROMFUN'));
		FashionBrand::create(array('name_en'=>'COMPATHY'));
		FashionBrand::create(array('name_en'=>'ZERO SECOND'));
		FashionBrand::create(array('name_en'=>'AFM'));
		FashionBrand::create(array('name_en'=>'COUREGIEM'));
		FashionBrand::create(array('name_en'=>"CHARM'S"));
		FashionBrand::create(array('name_en'=>'OiOi'));
		FashionBrand::create(array('name_en'=>'SALADBOWLS'));
		FashionBrand::create(array('name_en'=>'DESIGN WORKERS'));
		FashionBrand::create(array('name_en'=>'ATAR'));
		FashionBrand::create(array('name_en'=>'90Z'));
		FashionBrand::create(array('name_en'=>'SAVANT SYNDROME'));
		FashionBrand::create(array('name_en'=>'JULIEBEANS'));
		FashionBrand::create(array('name_en'=>'VAIVATTOMASTI'));
		FashionBrand::create(array('name_en'=>'OUTSTANDINGORDINARY'));
		FashionBrand::create(array('name_en'=>'CRES.E.DIM.'));
		FashionBrand::create(array('name_en'=>'CUSTOMI'));
		FashionBrand::create(array('name_en'=>'FRENK'));
		FashionBrand::create(array('name_en'=>'BURBERRY PROSUM'));
		FashionBrand::create(array('name_en'=>'THISISNEVERTHAT'));
		FashionBrand::create(array('name_en'=>'STUSSY'));
		FashionBrand::create(array('name_en'=>'BOY LONDON'));
		FashionBrand::create(array('name_en'=>'CHROMEHEARTS'));
		FashionBrand::create(array('name_en'=>'THOM BROWNE'));
		FashionBrand::create(array('name_en'=>'SAINT LAURENT'));
		FashionBrand::create(array('name_en'=>'MARTIN MARGIELA'));
		FashionBrand::create(array('name_en'=>'NEW ERA'));
		FashionBrand::create(array('name_en'=>'ONITSUKA TIGER'));
		FashionBrand::create(array('name_en'=>'PATRON SAINT'));
		FashionBrand::create(array('name_en'=>'ZPLISH'));
		FashionBrand::create(array('name_en'=>'BRIXTON'));
		FashionBrand::create(array('name_en'=>'BRATSON'));
		FashionBrand::create(array('name_en'=>'R.SHEMISTE'));
		FashionBrand::create(array('name_en'=>'JOY RICH'));
		FashionBrand::create(array('name_en'=>'SKECHERS'));
		FashionBrand::create(array('name_en'=>'DIOR HOMME'));
		FashionBrand::create(array('name_en'=>'PIERREHARDY'));
		FashionBrand::create(array('name_en'=>'TEVA'));
		FashionBrand::create(array('name_en'=>'CHACO'));
		FashionBrand::create(array('name_en'=>'CHUBASCO'));
		FashionBrand::create(array('name_en'=>'ADIDAS ORIGINALS'));
		FashionBrand::create(array('name_en'=>'AMI'));
		FashionBrand::create(array('name_en'=>'BILLIONAIRE BOYS CLUB'));
		FashionBrand::create(array('name_en'=>'CLAE'));
		FashionBrand::create(array('name_en'=>'HUF'));
		FashionBrand::create(array('name_en'=>'KYE'));
		FashionBrand::create(array('name_en'=>'MAISON KITSUNE'));
		FashionBrand::create(array('name_en'=>'OPENING CEREMONY'));
		FashionBrand::create(array('name_en'=>'CK JEANS'));
		FashionBrand::create(array('name_en'=>'CRITIC'));
		FashionBrand::create(array('name_en'=>'THOROGOOD'));
		FashionBrand::create(array('name_en'=>'ALDEN'));
		FashionBrand::create(array('name_en'=>'GRENSON'));
		FashionBrand::create(array('name_en'=>'REDWING'));
		FashionBrand::create(array('name_en'=>'LEATA'));
		FashionBrand::create(array('name_en'=>'GRAM'));
		FashionBrand::create(array('name_en'=>'LOAKE'));
		FashionBrand::create(array('name_en'=>'PIECE MAKER'));
		FashionBrand::create(array('name_en'=>'HARE'));
		FashionBrand::create(array('name_en'=>'CARVEN'));
		FashionBrand::create(array('name_en'=>'3.1 PHILLIP LIM'));
		FashionBrand::create(array('name_en'=>'PENFIELD'));
		FashionBrand::create(array('name_en'=>'KRAVITZ'));
		FashionBrand::create(array('name_en'=>'CANADA GOOSE'));
		FashionBrand::create(array('name_en'=>'G SHOCK'));
		FashionBrand::create(array('name_en'=>'JHONNYWEST'));
		FashionBrand::create(array('name_en'=>'NIXON'));
		FashionBrand::create(array('name_en'=>'SUPREME'));
		FashionBrand::create(array('name_en'=>'NOIR'));
		FashionBrand::create(array('name_en'=>'CANBYBI'));
		FashionBrand::create(array('name_en'=>'BYBYO'));
		FashionBrand::create(array('name_en'=>'WNDERKAMMER'));
		FashionBrand::create(array('name_en'=>'RANGGAN'));
		FashionBrand::create(array('name_en'=>'MISCHIEF'));
		FashionBrand::create(array('name_en'=>'LOOKAST'));
		FashionBrand::create(array('name_en'=>'MOSCA'));
		FashionBrand::create(array('name_en'=>'MUTEGARMENT'));
		FashionBrand::create(array('name_en'=>'MAN.G'));
		FashionBrand::create(array('name_en'=>'SAVANT SYNDROME'));
		FashionBrand::create(array('name_en'=>'PALLADIUM'));
	}

}


class StreetMetaTableSeeder extends Seeder {

	public function run() {
		DB::table('street_meta')->delete();
		DB::table('street_meta')->truncate();

		StreetMeta::create(array('name_ko'=>'가로수길'));
		StreetMeta::create(array('name_ko'=>'홍대입구'));
		StreetMeta::create(array('name_ko'=>'부산 서면'));
		StreetMeta::create(array('name_ko'=>'신주쿠'));
		StreetMeta::create(array('name_ko'=>'하라주쿠'));
	}

}