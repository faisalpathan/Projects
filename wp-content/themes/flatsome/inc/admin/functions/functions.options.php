<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");

		// Presets URL
		$preset_url = get_template_directory_uri().'/inc/admin/presets/';

	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		$of_pages['0'] = 'Select a page:';
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->post_name] = $of_page->post_title; }
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		//$google_fonts = array('Open Sans' => 'Open Sans','Sacramento' => 'Sacramento','Droid Sans' =>'Droid Sans','Oswald' => 'Oswald','Droid Serif' => 'Droid Serif','Lato' => 'Lato','Francois One' => 'Francois One','Raleway' => 'Raleway','Arvo' => 'Arvo','Roboto Slab' => 'Roboto Slab','Noto Serif' => 'Noto Serif','Noto Sans' =>'Noto Sans','Abril Fatface'=>'Abril Fatface','Clicker Script' => 'Clicker Script');
		$google_fonts = array(
						'customFont' => 'Custom Font',
						'arial'=>'Arial',
						'verdana'=>'Verdana, Geneva',
						'trebuchet'=>'Trebuchet',
						'trebuchet ms'=>'Trebuchet MS',
						'georgia' =>'Georgia',
						'times'=>'Times New Roman',
						'tahoma'=>'Tahoma, Geneva',
						'helvetica'=>'Helvetica',
						'Abel' => 'Abel',
						'Abril Fatface' => 'Abril Fatface',
						'Aclonica' => 'Aclonica',
						'Acme' => 'Acme',
						'Actor' => 'Actor',
						'Adamina' => 'Adamina',
						'Advent Pro' => 'Advent Pro',
						'Aguafina Script' => 'Aguafina Script',
						'Aladin' => 'Aladin',
						'Aldrich' => 'Aldrich',
						'Alegreya' => 'Alegreya',
						'Alegreya SC' => 'Alegreya SC',
						'Alex Brush' => 'Alex Brush',
						'Alfa Slab One' => 'Alfa Slab One',
						'Alice' => 'Alice',
						'Alike' => 'Alike',
						'Alike Angular' => 'Alike Angular',
						'Allan' => 'Allan',
						'Allerta' => 'Allerta',
						'Allerta Stencil' => 'Allerta Stencil',
						'Allura' => 'Allura',
						'Almendra' => 'Almendra',
						'Almendra SC' => 'Almendra SC',
						'Amaranth' => 'Amaranth',
						'Amatic SC' => 'Amatic SC',
						'Amethysta' => 'Amethysta',
						'Andada' => 'Andada',
						'Andika' => 'Andika',
						'Angkor' => 'Angkor',
						'Annie Use Your Telescope' => 'Annie Use Your Telescope',
						'Anonymous Pro' => 'Anonymous Pro',
						'Antic' => 'Antic',
						'Antic Didone' => 'Antic Didone',
						'Antic Slab' => 'Antic Slab',
						'Anton' => 'Anton',
						'Arapey' => 'Arapey',
						'Arbutus' => 'Arbutus',
						'Architects Daughter' => 'Architects Daughter',
						'Arimo' => 'Arimo',
						'Arizonia' => 'Arizonia',
						'Armata' => 'Armata',
						'Artifika' => 'Artifika',
						'Arvo' => 'Arvo',
						'Asap' => 'Asap',
						'Asset' => 'Asset',
						'Astloch' => 'Astloch',
						'Asul' => 'Asul',
						'Atomic Age' => 'Atomic Age',
						'Aubrey' => 'Aubrey',
						'Audiowide' => 'Audiowide',
						'Average' => 'Average',
						'Averia Gruesa Libre' => 'Averia Gruesa Libre',
						'Averia Libre' => 'Averia Libre',
						'Averia Sans Libre' => 'Averia Sans Libre',
						'Averia Serif Libre' => 'Averia Serif Libre',
						'Bad Script' => 'Bad Script',
						'Balthazar' => 'Balthazar',
						'Bangers' => 'Bangers',
						'Basic' => 'Basic',
						'Battambang' => 'Battambang',
						'Baumans' => 'Baumans',
						'Bayon' => 'Bayon',
						'Belgrano' => 'Belgrano',
						'Belleza' => 'Belleza',
						'Bentham' => 'Bentham',
						'Berkshire Swash' => 'Berkshire Swash',
						'Bevan' => 'Bevan',
						'Bigshot One' => 'Bigshot One',
						'Bilbo' => 'Bilbo',
						'Bilbo Swash Caps' => 'Bilbo Swash Caps',
						'Bitter' => 'Bitter',
						'Black Ops One' => 'Black Ops One',
						'Bokor' => 'Bokor',
						'Bonbon' => 'Bonbon',
						'Boogaloo' => 'Boogaloo',
						'Bowlby One' => 'Bowlby One',
						'Bowlby One SC' => 'Bowlby One SC',
						'Brawler' => 'Brawler',
						'Bree Serif' => 'Bree Serif',
						'Bubblegum Sans' => 'Bubblegum Sans',
						'Buda' => 'Buda',
						'Buenard' => 'Buenard',
						'Butcherman' => 'Butcherman',
						'Butterfly Kids' => 'Butterfly Kids',
						'Cabin' => 'Cabin',
						'Cabin Condensed' => 'Cabin Condensed',
						'Cabin Sketch' => 'Cabin Sketch',
						'Caesar Dressing' => 'Caesar Dressing',
						'Cagliostro' => 'Cagliostro',
						'Calligraffitti' => 'Calligraffitti',
						'Cambo' => 'Cambo',
						'Candal' => 'Candal',
						'Cantarell' => 'Cantarell',
						'Cantata One' => 'Cantata One',
						'Cardo' => 'Cardo',
						'Carme' => 'Carme',
						'Carter One' => 'Carter One',
						'Caudex' => 'Caudex',
						'Cedarville Cursive' => 'Cedarville Cursive',
						'Ceviche One' => 'Ceviche One',
						'Changa One' => 'Changa One',
						'Chango' => 'Chango',
						'Chau Philomene One' => 'Chau Philomene One',
						'Chelsea Market' => 'Chelsea Market',
						'Chenla' => 'Chenla',
						'Cherry Cream Soda' => 'Cherry Cream Soda',
						'Chewy' => 'Chewy',
						'Chicle' => 'Chicle',
						'Chivo' => 'Chivo',
						'Coda' => 'Coda',
						'Coda Caption' => 'Coda Caption',
						'Codystar' => 'Codystar',
						'Comfortaa' => 'Comfortaa',
						'Coming Soon' => 'Coming Soon',
						'Concert One' => 'Concert One',
						'Condiment' => 'Condiment',
						'Content' => 'Content',
						'Contrail One' => 'Contrail One',
						'Convergence' => 'Convergence',
						'Cookie' => 'Cookie',
						'Copse' => 'Copse',
						'Corben' => 'Corben',
						'Cousine' => 'Cousine',
						'Coustard' => 'Coustard',
						'Covered By Your Grace' => 'Covered By Your Grace',
						'Crafty Girls' => 'Crafty Girls',
						'Creepster' => 'Creepster',
						'Crete Round' => 'Crete Round',
						'Crimson Text' => 'Crimson Text',
						'Crushed' => 'Crushed',
						'Cuprum' => 'Cuprum',
						'Cutive' => 'Cutive',
						'Damion' => 'Damion',
						'Dancing Script' => 'Dancing Script',
						'Dangrek' => 'Dangrek',
						'Dawning of a New Day' => 'Dawning of a New Day',
						'Days One' => 'Days One',
						'Delius' => 'Delius',
						'Delius Swash Caps' => 'Delius Swash Caps',
						'Delius Unicase' => 'Delius Unicase',
						'Della Respira' => 'Della Respira',
						'Devonshire' => 'Devonshire',
						'Didact Gothic' => 'Didact Gothic',
						'Diplomata' => 'Diplomata',
						'Diplomata SC' => 'Diplomata SC',
						'Doppio One' => 'Doppio One',
						'Dorsa' => 'Dorsa',
						'Dosis' => 'Dosis',
						'Dr Sugiyama' => 'Dr Sugiyama',
						'Droid Sans' => 'Droid Sans',
						'Droid Sans Mono' => 'Droid Sans Mono',
						'Droid Serif' => 'Droid Serif',
						'Duru Sans' => 'Duru Sans',
						'Dynalight' => 'Dynalight',
						'EB Garamond' => 'EB Garamond',
						'Eater' => 'Eater',
						'Economica' => 'Economica',
						'Electrolize' => 'Electrolize',
						'Emblema One' => 'Emblema One',
						'Emilys Candy' => 'Emilys Candy',
						'Engagement' => 'Engagement',
						'Enriqueta' => 'Enriqueta',
						'Erica One' => 'Erica One',
						'Esteban' => 'Esteban',
						'Euphoria Script' => 'Euphoria Script',
						'Ewert' => 'Ewert',
						'Exo' => 'Exo',
						'Exo 2' => 'Exo 2',
						'Expletus Sans' => 'Expletus Sans',
						'Fanwood Text' => 'Fanwood Text',
						'Fascinate' => 'Fascinate',
						'Fascinate Inline' => 'Fascinate Inline',
						'Federant' => 'Federant',
						'Federo' => 'Federo',
						'Felipa' => 'Felipa',
						'Fjord One' => 'Fjord One',
						'Flamenco' => 'Flamenco',
						'Flavors' => 'Flavors',
						'Fira Mono' => 'Fira Mono',
						'Fondamento' => 'Fondamento',
						'Fontdiner Swanky' => 'Fontdiner Swanky',
						'Forum' => 'Forum',
						'Fjalla One' => 'Fjalla One',
						'Francois One' => 'Francois One',
						'Fredericka the Great' => 'Fredericka the Great',
						'Fredoka One' => 'Fredoka One',
						'Freehand' => 'Freehand',
						'Fresca' => 'Fresca',
						'Frijole' => 'Frijole',
						'Fugaz One' => 'Fugaz One',
						'GFS Didot' => 'GFS Didot',
						'GFS Neohellenic' => 'GFS Neohellenic',
						'Galdeano' => 'Galdeano',
						'Gentium Basic' => 'Gentium Basic',
						'Gentium Book Basic' => 'Gentium Book Basic',
						'Geo' => 'Geo',
						'Geostar' => 'Geostar',
						'Geostar Fill' => 'Geostar Fill',
						'Germania One' => 'Germania One',
						'Gilda Display' => 'Gilda Display',
						'Give You Glory' => 'Give You Glory',
						'Glass Antiqua' => 'Glass Antiqua',
						'Glegoo' => 'Glegoo',
						'Gloria Hallelujah' => 'Gloria Hallelujah',
						'Goblin One' => 'Goblin One',
						'Gochi Hand' => 'Gochi Hand',
						'Gorditas' => 'Gorditas',
						'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
						'Graduate' => 'Graduate',
						'Gravitas One' => 'Gravitas One',
						'Great Vibes' => 'Great Vibes',
						'Gruppo' => 'Gruppo',
						'Gudea' => 'Gudea',
						'Habibi' => 'Habibi',
						'Hammersmith One' => 'Hammersmith One',
						'Handlee' => 'Handlee',
						'Hanuman' => 'Hanuman',
						'Happy Monkey' => 'Happy Monkey',
						'Henny Penny' => 'Henny Penny',
						'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
						'Holtwood One SC' => 'Holtwood One SC',
						'Homemade Apple' => 'Homemade Apple',
						'Homenaje' => 'Homenaje',
						'IM Fell DW Pica' => 'IM Fell DW Pica',
						'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
						'IM Fell Double Pica' => 'IM Fell Double Pica',
						'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
						'IM Fell English' => 'IM Fell English',
						'IM Fell English SC' => 'IM Fell English SC',
						'IM Fell French Canon' => 'IM Fell French Canon',
						'IM Fell French Canon SC' => 'IM Fell French Canon SC',
						'IM Fell Great Primer' => 'IM Fell Great Primer',
						'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
						'Iceberg' => 'Iceberg',
						'Iceland' => 'Iceland',
						'Imprima' => 'Imprima',
						'Inconsolata' => 'Inconsolata',
						'Inder' => 'Inder',
						'Indie Flower' => 'Indie Flower',
						'Inika' => 'Inika',
						'Irish Grover' => 'Irish Grover',
						'Istok Web' => 'Istok Web',
						'Italiana' => 'Italiana',
						'Italianno' => 'Italianno',
						'Jim Nightshade' => 'Jim Nightshade',
						'Jockey One' => 'Jockey One',
						'Jolly Lodger' => 'Jolly Lodger',
						'Josefin Sans' => 'Josefin Sans',
						'Josefin Slab' => 'Josefin Slab',
						'Judson' => 'Judson',
						'Julee' => 'Julee',
						'Junge' => 'Junge',
						'Jura' => 'Jura',
						'Just Another Hand' => 'Just Another Hand',
						'Just Me Again Down Here' => 'Just Me Again Down Here',
						'Kameron' => 'Kameron',
						'Karla' => 'Karla',
						'Kaushan Script' => 'Kaushan Script',
						'Kelly Slab' => 'Kelly Slab',
						'Kenia' => 'Kenia',
						'Khmer' => 'Khmer',
						'Knewave' => 'Knewave',
						'Kotta One' => 'Kotta One',
						'Koulen' => 'Koulen',
						'Kranky' => 'Kranky',
						'Kreon' => 'Kreon',
						'Kristi' => 'Kristi',
						'Krona One' => 'Krona One',
						'La Belle Aurore' => 'La Belle Aurore',
						'Lancelot' => 'Lancelot',
						'Lato' => 'Lato',
						'League Script' => 'League Script',
						'Leckerli One' => 'Leckerli One',
						'Ledger' => 'Ledger',
						'Lekton' => 'Lekton',
						'Lemon' => 'Lemon',
						'Libre Baskerville' => 'Libre Baskerville',
						'Lilita One' => 'Lilita One',
						'Limelight' => 'Limelight',
						'Linden Hill' => 'Linden Hill',
						'Lobster' => 'Lobster',
						'Lobster Two' => 'Lobster Two',
						'Londrina Outline' => 'Londrina Outline',
						'Londrina Shadow' => 'Londrina Shadow',
						'Londrina Sketch' => 'Londrina Sketch',
						'Londrina Solid' => 'Londrina Solid',
						'Lora' => 'Lora',
						'Love Ya Like A Sister' => 'Love Ya Like A Sister',
						'Loved by the King' => 'Loved by the King',
						'Lovers Quarrel' => 'Lovers Quarrel',
						'Luckiest Guy' => 'Luckiest Guy',
						'Lusitana' => 'Lusitana',
						'Lustria' => 'Lustria',
						'Macondo' => 'Macondo',
						'Macondo Swash Caps' => 'Macondo Swash Caps',
						'Magra' => 'Magra',
						'Maiden Orange' => 'Maiden Orange',
						'Mako' => 'Mako',
						'Marcellus' => 'Marcellus',
						'Marcellus SC' => 'Marcellus SC',
						'Marck Script' => 'Marck Script',
						'Marko One' => 'Marko One',
						'Marmelad' => 'Marmelad',
						'Marvel' => 'Marvel',
						'Mate' => 'Mate',
						'Mate SC' => 'Mate SC',
						'Maven Pro' => 'Maven Pro',
						'Meddon' => 'Meddon',
						'MedievalSharp' => 'MedievalSharp',
						'Medula One' => 'Medula One',
						'Megrim' => 'Megrim',
						'Merienda One' => 'Merienda One',
						'Merriweather' => 'Merriweather',
						'Metal' => 'Metal',
						'Metamorphous' => 'Metamorphous',
						'Metrophobic' => 'Metrophobic',
						'Michroma' => 'Michroma',
						'Miltonian' => 'Miltonian',
						'Miltonian Tattoo' => 'Miltonian Tattoo',
						'Miniver' => 'Miniver',
						'Miss Fajardose' => 'Miss Fajardose',
						'Modern Antiqua' => 'Modern Antiqua',
						'Molengo' => 'Molengo',
						'Monofett' => 'Monofett',
						'Monoton' => 'Monoton',
						'Monsieur La Doulaise' => 'Monsieur La Doulaise',
						'Montaga' => 'Montaga',
						'Montez' => 'Montez',
						'Montserrat' => 'Montserrat',
						'Montserrat Alternates' => 'Montserrat Alternates',
						'Montserrat Subrayada' => 'Montserrat Subrayada',
						'Moul' => 'Moul',
						'Moulpali' => 'Moulpali',
						'Mountains of Christmas' => 'Mountains of Christmas',
						'Mr Bedfort' => 'Mr Bedfort',
						'Mr Dafoe' => 'Mr Dafoe',
						'Mr De Haviland' => 'Mr De Haviland',
						'Mrs Saint Delafield' => 'Mrs Saint Delafield',
						'Mrs Sheppards' => 'Mrs Sheppards',
						'Muli' => 'Muli',
						'Mystery Quest' => 'Mystery Quest',
						'Neucha' => 'Neucha',
						'Neuton' => 'Neuton',
						'News Cycle' => 'News Cycle',
						'Niconne' => 'Niconne',
						'Nixie One' => 'Nixie One',
						'Nobile' => 'Nobile',
						'Nokora' => 'Nokora',
						'Norican' => 'Norican',
						'Nosifer' => 'Nosifer',
						'Nothing You Could Do' => 'Nothing You Could Do',
						'Noticia Text' => 'Noticia Text',
						'Noto Sans' => 'Noto Sans',
						'Nova Cut' => 'Nova Cut',
						'Nova Flat' => 'Nova Flat',
						'Nova Mono' => 'Nova Mono',
						'Nova Oval' => 'Nova Oval',
						'Nova Round' => 'Nova Round',
						'Nova Script' => 'Nova Script',
						'Nova Slim' => 'Nova Slim',
						'Nova Square' => 'Nova Square',
						'Numans' => 'Numans',
						'Nunito' => 'Nunito',
						'Odor Mean Chey' => 'Odor Mean Chey',
						'Old Standard TT' => 'Old Standard TT',
						'Oldenburg' => 'Oldenburg',
						'Oleo Script' => 'Oleo Script',
						'Open Sans' => 'Open Sans',
						'Open Sans Condensed' => 'Open Sans Condensed',
						'Orbitron' => 'Orbitron',
						'Original Surfer' => 'Original Surfer',
						'Oswald' => 'Oswald',
						'Over the Rainbow' => 'Over the Rainbow',
						'Overlock' => 'Overlock',
						'Overlock SC' => 'Overlock SC',
						'Ovo' => 'Ovo',
						'Oxygen' => 'Oxygen',
						'PT Mono' => 'PT Mono',
						'PT Sans' => 'PT Sans',
						'PT Sans Caption' => 'PT Sans Caption',
						'PT Sans Narrow' => 'PT Sans Narrow',
						'PT Serif' => 'PT Serif',
						'PT Serif Caption' => 'PT Serif Caption',
						'Pacifico' => 'Pacifico',
						'Parisienne' => 'Parisienne',
						'Passero One' => 'Passero One',
						'Passion One' => 'Passion One',
						'Patrick Hand' => 'Patrick Hand',
						'Patua One' => 'Patua One',
						'Paytone One' => 'Paytone One',
						'Permanent Marker' => 'Permanent Marker',
						'Petrona' => 'Petrona',
						'Philosopher' => 'Philosopher',
						'Piedra' => 'Piedra',
						'Pinyon Script' => 'Pinyon Script',
						'Plaster' => 'Plaster',
						'Play' => 'Play',
						'Playball' => 'Playball',
						'Playfair Display' => 'Playfair Display',
						'Podkova' => 'Podkova',
						'Poiret One' => 'Poiret One',
						'Poller One' => 'Poller One',
						'Poly' => 'Poly',
						'Pompiere' => 'Pompiere',
						'Pontano Sans' => 'Pontano Sans',
						'Port Lligat Sans' => 'Port Lligat Sans',
						'Port Lligat Slab' => 'Port Lligat Slab',
						'Poppins' => 'Poppins',
						'Prata' => 'Prata',
						'Preahvihear' => 'Preahvihear',
						'Press Start 2P' => 'Press Start 2P',
						'Princess Sofia' => 'Princess Sofia',
						'Prociono' => 'Prociono',
						'Prosto One' => 'Prosto One',
						'Puritan' => 'Puritan',
						'Quantico' => 'Quantico',
						'Quattrocento' => 'Quattrocento',
						'Quattrocento Sans' => 'Quattrocento Sans',
						'Questrial' => 'Questrial',
						'Quicksand' => 'Quicksand',
						'Qwigley' => 'Qwigley',
						'Radley' => 'Radley',
						'Raleway' => 'Raleway',
						'Rammetto One' => 'Rammetto One',
						'Rancho' => 'Rancho',
						'Rationale' => 'Rationale',
						'Redressed' => 'Redressed',
						'Reenie Beanie' => 'Reenie Beanie',
						'Revalia' => 'Revalia',
						'Ribeye' => 'Ribeye',
						'Ribeye Marrow' => 'Ribeye Marrow',
						'Righteous' => 'Righteous',
						'Roboto' => 'Roboto',
						'Roboto Condensed' => 'Roboto Condensed',
						'Roboto Sans' => 'Roboto Sans',
						'Roboto Slab' => 'Roboto Slab',
						'Rochester' => 'Rochester',
						'Rock Salt' => 'Rock Salt',
						'Rokkitt' => 'Rokkitt',
						'Ropa Sans' => 'Ropa Sans',
						'Rosario' => 'Rosario',
						'Rosarivo' => 'Rosarivo',
						'Rouge Script' => 'Rouge Script',
						'Ruda' => 'Ruda',
						'Ruge Boogie' => 'Ruge Boogie',
						'Ruluko' => 'Ruluko',
						'Rum Raisin' => 'Rum Raisin',
						'Ruslan Display' => 'Ruslan Display',
						'Russo One' => 'Russo One',
						'Ruthie' => 'Ruthie',
						'Sacramento' => 'Sacramento',
						'Sail' => 'Sail',
						'Salsa' => 'Salsa',
						'Sancreek' => 'Sancreek',
						'Sansita One' => 'Sansita One',
						'Sarina' => 'Sarina',
						'Satisfy' => 'Satisfy',
						'Schoolbell' => 'Schoolbell',
						'Segoe UI' => 'Segoe UI',
						'Seaweed Script' => 'Seaweed Script',
						'Sevillana' => 'Sevillana',
						'Seymour One' => 'Seymour One',
						'Shadows Into Light' => 'Shadows Into Light',
						'Shadows Into Light Two' => 'Shadows Into Light Two',
						'Shanti' => 'Shanti',
						'Share' => 'Share',
						'Shojumaru' => 'Shojumaru',
						'Short Stack' => 'Short Stack',
						'Siemreap' => 'Siemreap',
						'Sigmar One' => 'Sigmar One',
						'Signika' => 'Signika',
						'Signika Negative' => 'Signika Negative',
						'Simonetta' => 'Simonetta',
						'Sirin Stencil' => 'Sirin Stencil',
						'Six Caps' => 'Six Caps',
						'Slackey' => 'Slackey',
						'Smokum' => 'Smokum',
						'Smythe' => 'Smythe',
						'Sniglet' => 'Sniglet',
						'Snippet' => 'Snippet',
						'Sofia' => 'Sofia',
						'Sonsie One' => 'Sonsie One',
						'Sorts Mill Goudy' => 'Sorts Mill Goudy',
						'Special Elite' => 'Special Elite',
						'Spicy Rice' => 'Spicy Rice',
						'Spinnaker' => 'Spinnaker',
						'Spirax' => 'Spirax',
						'Squada One' => 'Squada One',
						'Stardos Stencil' => 'Stardos Stencil',
						'Stint Ultra Condensed' => 'Stint Ultra Condensed',
						'Stint Ultra Expanded' => 'Stint Ultra Expanded',
						'Stoke' => 'Stoke',
						'Sue Ellen Francisco' => 'Sue Ellen Francisco',
						'Sunshiney' => 'Sunshiney',
						'Supermercado One' => 'Supermercado One',
						'Suwannaphum' => 'Suwannaphum',
						'Swanky and Moo Moo' => 'Swanky and Moo Moo',
						'Syncopate' => 'Syncopate',
						'Tangerine' => 'Tangerine',
						'Taprom' => 'Taprom',
						'Telex' => 'Telex',
						'Tenor Sans' => 'Tenor Sans',
						'The Girl Next Door' => 'The Girl Next Door',
						'Tienne' => 'Tienne',
						'Tinos' => 'Tinos',
						'Titan One' => 'Titan One',
						'Titillium Web' => 'Titillium Web',
						'Trade Winds' => 'Trade Winds',
						'Trocchi' => 'Trocchi',
						'Trochut' => 'Trochut',
						'Trykker' => 'Trykker',
						'Tulpen One' => 'Tulpen One',
						'Ubuntu' => 'Ubuntu',
						'Ubuntu Condensed' => 'Ubuntu Condensed',
						'Ubuntu Mono' => 'Ubuntu Mono',
						'Ultra' => 'Ultra',
						'Uncial Antiqua' => 'Uncial Antiqua',
						'UnifrakturCook' => 'UnifrakturCook',
						'UnifrakturMaguntia' => 'UnifrakturMaguntia',
						'Unkempt' => 'Unkempt',
						'Unlock' => 'Unlock',
						'Unna' => 'Unna',
						'VT323' => 'VT323',
						'Varela' => 'Varela',
						'Varela Round' => 'Varela Round',
						'Vast Shadow' => 'Vast Shadow',
						'Vibur' => 'Vibur',
						'Vidaloka' => 'Vidaloka',
						'Viga' => 'Viga',
						'Voces' => 'Voces',
						'Volkhov' => 'Volkhov',
						'Vollkorn' => 'Vollkorn',
						'Voltaire' => 'Voltaire',
						'Waiting for the Sunrise' => 'Waiting for the Sunrise',
						'Wallpoet' => 'Wallpoet',
						'Walter Turncoat' => 'Walter Turncoat',
						'Wellfleet' => 'Wellfleet',
						'Wire One' => 'Wire One',
						'Work Sans' => 'Work Sans',
						'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
						'Yellowtail' => 'Yellowtail',
						'Yeseva One' => 'Yeseva One',
						'Yesteryear' => 'Yesteryear',
						'Zeyada' => 'Zeyada'
		);



/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$url =  ADMIN_DIR . 'assets/images/';


$of_options[] = array( 	"name" 		=> "Global settings",
						"type" 		=> "heading",
);


$of_options[] = array( 	"name" 		=> "Enable minified CSS and JS",
						"id" 		=> "minified_flatsome",
						"desc"      => "Speed up your site by enable the minified CSS and Javscript of flatsome. <strong>NB!</strong> style.css will not be loaded. Custom styles needs to be placed in Theme Option > HTML Blocks > Custom CSS.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Flatsome Builder Beta",
						"id" 		=> "flatsome_builder",
						"desc"      => "Enable Flatsome Builder Beta.",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Flatsome Docs in Admin Bar.",
						"id" 		=> "flatsome_docs",
						"desc"      => "Enable Quick links to Flatsome Documentations in Admin Bar. (For Admins only)",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Maintenance Mode",
						"id" 		=> "maintenance_mode",
						"desc"      => "Enable Maintenance Mode for all users except admins.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Maintenance Mode Text",
						"desc" 		=> "The text that will be visible to your customers when accessing maintenance screen.",
						"id" 		=> "maintenance_mode_text",
						"std"       => "Please check back soon..",
						"type" 		=> "text"
);



$of_options[] = array( 	"name" 		=> "Header Scripts",
						"desc" 		=> "Add custom scripts inside HEAD tag. You need to have SCRIPT tag around the scripts.",
						"id" 		=> "html_scripts_header",
						"std" 		=> "",
						"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "Footer Scripts",
						"desc" 		=> "Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.",
						"id" 		=> "html_scripts_footer",
						"std" 		=> "",
						"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "Custom CSS",
						"type" 		=> "heading"
);


$of_options[] = array( 	"name" 		=> "Custom CSS ",
						"desc" 		=> "Add custom CSS here",
						"id" 		=> "html_custom_css",
						"std" 		=> "div {}",
						"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "Custom CSS (Mobile only)",
						"desc" 		=> "Add custom CSS here for mobile view",
						"id" 		=> "html_custom_css_mobile",
						"std" 		=> "",
						"type" 		=> "textarea"
);





// GENERAL //
$of_options[] = array( 	"name" 		=> "Logo and icons",
						"type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "Logo",
						"desc" 		=> "Upload logo here. Upload 2x Size if you want the logo to be sharp on retina displays.",
						"id" 		=> "site_logo",
						"std" 		=> "",
						"type" 		=> "media"
);


if(!function_exists('wp_site_icon')){
	$of_options[] = array( 	"name" 		=> "Favicon",
							"desc" 		=> "Add your custom Favicon image. 16x16px .ico or .png file required.",
							"id" 		=> "site_favicon",
							"std" 		=> "",
							"type" 		=> "media"
	);

	$of_options[] = array( 	"name" 		=> "Favicon retina",
							"desc" 		=> "The Retina/iOS version of your Favicon. 144x144px .png file required.",
							"id" 		=> "site_favicon_large",
							"std" 		=> "",
							"type" 		=> "media"
	);
} else{

	$of_options[] = array( 	
		"name" 		=> "Favicon",
		"id" 		=> "",
		"std" 		=> "Favicon upload has moved to: <br/> <a href='".admin_url('customize.php?&autofocus%5Bpanel%5Dof-option-logoandicons')."'>Appearance > Customize > Site Identity</a>",
		"type" 		=> "info"
	);

}

$of_options[] = array( 	"name" 		=> "Custom Cart Icon",
						"desc" 		=> "Upload a custom cart icon image here if you want to repliace the default cart icon. You need to add something to cart to see results.",
						"id" 		=> "custom_cart_icon",
						"std" 		=> "",
						"type" 		=> "media"
);

$of_options[] = array( 	"name" 		=> "Dark Logo",
						"desc" 		=> "Upload dark logo version here. Used for Transparent header template",
						"id" 		=> "site_logo_dark",
						"std" 		=> "",
						"type" 		=> "media"
);

$of_options[] = array( 	"name" 		=> "Sticky Logo",
						"desc" 		=> "Upload custom sticky header logo",
						"id" 		=> "site_logo_sticky",
						"std" 		=> "",
						"type" 		=> "media"
);




// HEADER SETTINGS //
$of_options[] = array( 	"name" 		=> "Layout",
						"type" 		=> "heading"
);

$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Layout mode",
						"desc" 		=> "Select Full width, boxed or framed layout",
						"id" 		=> "body_layout",
						"std" 		=> "full-width",
						"type" 		=> "images",
						"options" 	=> array(
									'full-width' 	=> $url . 'full-width.gif',
									'boxed' 	=> $url . 'boxed.gif',
									'framed-layout' 	=> $url . 'framed.gif',
						)
);

$of_options[] = array( 	"name" 		=> "Layout Box Shadow",
						"desc" 		=> "Add a subtle shadow around content",
						"id" 		=> "box_shadow",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);




$of_options[] = array( 	"name" 		=> "Body Background Color",
						"desc" 		=> "Pick a color for the background. Only shows on boxed layout (default: #eee).",
						"id" 		=> "body_bg",
						"std" 		=> "",
						"type" 		=> "color"
);


$of_options[] = array( 	"name" 		=> "Body Background Image",
						"desc" 		=> "Pick a pattern for background. Check <a href='http://subtlepatterns.com' target='_blank'>here</a>  for awesome textures",
						"id" 		=> "body_bg_image",
						"std" 		=> "",
						"type" 		=> "media"
);

$of_options[] = array( 	"name" 		=> "Body Background Repeat",
						"desc" 		=> "",
						"id" 		=> "body_bg_type",
						"std" 		=> "",
						"type" 		=> "select",
						"options"   => array("bg-full-size" => "Full Size", "bg-tiled" => "Tiled" )
);

$of_options[] = array( 	"name" 		=> "Content text color",
						"desc" 		=> "Light or Dark content text color",
						"id" 		=> "content_color",
						"std" 		=> "light",
						"type" 		=> "images",
						"options" 	=> array(
											'light' => $url . 'text-light.gif',
											'dark' 	=> $url . 'text-dark.gif',
						)
);

$of_options[] = array( 	"name" 		=> "Content background color",
						"desc" 		=> "Change background color for content",
						"id" 		=> "content_bg",
						"std" 		=> "#FFF",
						"type" 		=> "color"
);





// HEADER // // HEADER // // HEADER // // HEADER //
$of_options[] = array( 	"name" 		=> "Header",
						"type" 		=> "heading"
);



$of_options[] = array( 	"name" 		=> "Header preset",
						"id" 		=> "header_preset",
						"type" 		=> "presets",
						"options" 	=> array(
							$preset_url.'/headers/header1.jpg' => "header_1",
							$preset_url.'/headers/header1_2.jpg' => "header_1_2",
							$preset_url.'/headers/header1_3.jpg' => "header_1_3",
							$preset_url.'/headers/header1_4.jpg' => "header_1_4",
							$preset_url.'/headers/header1_5.jpg' => "header_1_5",
							$preset_url.'/headers/header6.jpg' => "header_6",
							$preset_url.'/headers/header2.jpg' => "header_2",
							$preset_url.'/headers/header3.jpg' => "header_3",
							$preset_url.'/headers/header3_1.jpg' => "header_3_1",
							$preset_url.'/headers/header3_2.jpg' => "header_3_2",
							$preset_url.'/headers/header5.jpg' => "header_5",
							$preset_url.'/headers/header5_2.jpg' => "header_5_2",
						)
);  



$of_options[] = array( 	"name" 		=> "Header height",
						"desc" 		=> "Set height of header in px.",
						"id" 		=> "header_height",
						"std" 		=> "120",
						"min" 		=> "50",
						"step"		=> "1",
						"max" 		=> "450",
						"type" 		=> "sliderui" 
);


$of_options[] = array( 	"name" 		=> "Logo container width",
						"desc" 		=> "Set width of logo container. Height is same as header height",
						"id" 		=> "logo_width",
						"std" 		=> "210",
						"min" 		=> "90",
						"step"		=> "1",
						"max" 		=> "700",
						"type" 		=> "sliderui" 
);

$of_options[] = array( 	"name" 		=> "Logo position",
						"desc" 		=> "Select logo position",
						"id" 		=> "logo_position",
						"std" 		=> "left",
						"type" 		=> "select",

						"options" 	=> array(
										"left" => "left",
										"center" => "center"
						)
);

$of_options[] = array( 	"name" 		=> "Search position",
						"desc" 		=> "Change position of search in main navigation",
						"id" 		=> "search_pos",
						"std" 		=> "left",
						"type" 		=> "select",
						"options" 	=> array(
										"left" => "Left (default)",
										"right" => "Right",
										"hide" => "Hide"

						)
);

$of_options[] = array( 	"name" 		=> "Main Navigation position",
						"desc" 		=> "Change position of main navigation",
						"id" 		=> "nav_position",
						"std" 		=> "top",
						"type" 		=> "select",

						"options" 	=> array(
										"top" => "Top Left (beside logo)",
										"top_right" => "Top Right",
										"bottom" => "Full width - Left",
										"bottom_center" => "Full width - Centered"
						)
);


$of_options[] = array( 	"name" 		=> "Main Navigation Size",
						"desc" 		=> "Change size of main navigation",
						"id" 		=> "nav_size",
						"std" 		=> "80%",
						"type" 		=> "select",
						"options" 	=> array(
										"70%" => "Small",
										"80%" => "Normal",
										"90%" => "Medium",
										"100%" => "Large"

						)
);



$of_options[] = array( 	"name" 		=> "Show My Account dropdown",
						"desc" 		=> "Show my account / login link in header",
						"id" 		=> "myaccount_dropdown",
						"type"		=> "select",
						"std" 		=> 1,
						"options" 	=> array(
							0 => "Hide",
							1 => "Header Main - Right",
							'top_bar' => "Top bar - Right",
						)
);


$of_options[] = array( "name" 		=> "My Account Login style (NEW)",
						"desc" 		=> "Change My Account header login style",
						"id" 		=> "account_login_style",
						"type"		=> "select",
						"std" 		=> 'link',
						"options" 	=> array(
							'link' => "Link",
							'lightbox' => "Lightbox",
						)
);


$of_options[] = array( 	"name" 		=> "Show Mini Cart",
						"desc" 		=> "Show cart in header (Requires WooCommerce)",
						"id" 		=> "show_cart",
						"type"		=> "select",
						"std" 		=> 1,
						"options" 	=> array(
							0 => "Hide",
							1 => "Header Main - Right",
							'top_bar' => "Top bar - Right",
						)
);

$of_options[] = array( 	"name" 		=> "Show Right Content",
						"desc" 		=> "Add HTML or shortcodes here that will show beside Cart and My Account links or replace them.<br> <br>You could use these: <br><strong>[follow facebook='#' twitter='#' instagram='#']<br> [header_button text='Shop now' tooltip='' link='http://#' border='2px']<br> [phone number='+00 000 000' border='2px' tooltip='Contact us today']<br>[search] <br> [share] </strong>",
						"id" 		=> "top_right_text",
						"type" 		=> "text"
);


$of_options[] = array( 	"name" 		=> "Sticky Header on scroll",
						"desc" 		=> "Make header stick to top on scroll",
						"id" 		=> "header_sticky",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Sticky Header height",
						"desc" 		=> "Set height of sticky header in px.",
						"id" 		=> "header_height_sticky",
						"std" 		=> "70",
						"min" 		=> "50",
						"step"		=> "1",
						"max" 		=> "220",
						"type" 		=> "sliderui" 
);



$of_options[] = array( 	"name" 		=> "Header text color",
						"desc" 		=> "Light or Dark header text color",
						"id" 		=> "header_color",
						"std" 		=> "light",
						"type" 		=> "images",
						"options" 	=> array(
											'light' => $url . 'text-light.gif',
											'dark' 	=> $url . 'text-dark.gif',
						)
);

$of_options[] = array( 	"name" 		=> "Header BG color",
						"desc" 		=> "Pick header background color",
						"id" 		=> "header_bg",
						"std" 		=> "#fff",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Header BG image",
						"desc" 		=> "Upload background image to header",
						"id" 		=> "header_bg_img",
						"std" 		=> "",
						"type" 		=> "media"
);


$of_options[] = array( 	"name" 		=> "Header BG image position",
						"desc" 		=> "Change header bg position",
						"id" 		=> "header_bg_img_pos",
						"std" 		=> "repeat-x",
						"type" 		=> "select",

						"options" 	=> array(
										"repeat-x" => "repeat-x",//please, always use this key: "none"
										"no-repeat" => "no-repeat"

						)
);


$of_options[] = array( 	"name" 		=> "Show Top Bar",
						"id" 		=> "topbar_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);

$of_options[] = array( 	"name" 		=> "Top Bar BG color",
						"desc" 		=> "Pick a background color for top bar background (default: #58728a).",
						"id" 		=> "topbar_bg",
						"std" 		=> "",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 	=> "Top bar left",
				"desc" 		=> "Insert text or shortcodes here",
				"id" 		=> "topbar_left",
				"std" 		=> "Add anything here here or just remove it..",
				"type" 		=> "text"
);


$of_options[] = array( 	"name" 	=> "Top bar right",
				"desc" 		=> "Insert text or shortcodes here",
				"id" 		=> "topbar_right",
				"std" 		=> "",
				"type" 		=> "text"
);


$of_options[] = array( 	"name" 		=> "Main Navigation background (For full width nav)",
						"desc" 		=> "Change position of main navigation",
						"id" 		=> "nav_position_bg",
						"std" 		=> "#eee",
						"type" 		=> "color"
);


$of_options[] = array( 	"name" 		=> "Main Navigation link color (For full width nav)",
						"desc" 		=> "Change position of main navigation",
						"id" 		=> "nav_position_color",
						"std" 		=> "light",
						"type" 		=> "images",
						"options" 	=> array(
											'light-header' => $url . 'text-light.gif',
											'dark-header' 	=> $url . 'text-dark.gif',
						)
);


$of_options[] = array( 	"name" 		=> "Full width Nav - Right menu content",
				"desc" 		=> "Insert content to right of the main menu. Shortcodes are allowed",
				"id" 		=> "nav_position_text",
				"std" 		=> "Add shortcode or text here",
				"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Full width Nav - Top content",
				"desc" 		=> "Insert content for header beside logo or search. Shortcodes are allowed",
				"id" 		=> "nav_position_text_top",
				"std" 		=> "Add shortcode or text here",
				"type" 		=> "text"
);


$of_options[] = array( 	"name" 		=> "After header HTML",
						"desc" 		=> "Enter HTML that should be placed after header here. Shortcodes are allowed.",
						"id" 		=> "html_after_header",
						"std" 		=> "",
						"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "Homepage Intro HTML",
						"desc" 		=> "Enter HTML that would be placed before header on homepage. Use for Intro images, slides etc.",
						"id" 		=> "html_intro",
						"std" 		=> "",
						"type" 		=> "textarea"
);





$of_options[] = array( 	"name" 		=> "Footer",
						"type" 		=> "heading"
);


$of_options[] = array( 	"name" 		=> "Footer bottom left content (copyright text)",
				"desc" 		=> "Insert text/html for left footer content",
				"id" 		=> "footer_left_text",
				"std" 		=> "Copyright [ux_current_year] &copy; <strong>UX Themes</strong>. Powered by <strong>WooCommerce</strong>",
				"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Footer bottom right content",
				"desc" 		=> "Add image of creditcards etc. here",
				"id" 		=> "footer_right_text",
				"std" 		=> "",
				"type" 		=> "textarea"
);





$of_options[] = array( 	"name" 		=> "Footer 1 text color",
						"desc" 		=> "Light or Dark text color",
						"id" 		=> "footer_1_color",
						"std" 		=> "light",
						"type" 		=> "images",
						"options" 	=> array(
											'light' => $url . 'text-light.gif',
											'dark' 	=> $url . 'text-dark.gif',
						)
);



$of_options[] = array( 	"name" 		=> "Footer 1 BG color",
						"id" 		=> "footer_1_bg_color",
						"std" 		=> "#fff",
						"type" 		=> "color"
);


$of_options[] = array( 	"name" 		=> "Footer 1 BG image",
						"id" 		=> "footer_1_bg_image",
						"std" 		=> "",
						"type" 		=> "media"
);



$of_options[] = array( 	"name" 		=> "Footer 1 columns",
						"desc" 		=> "",
						"id" 		=> "footer_1_columns",
						"std" 		=> "large-3",
						"type" 		=> "select",
						"options" 	=> array(
										"large-2" => "6",
										"large-3" => "4",
										"large-4" => "3",
										"large-6" => "2",
										"large-12" => "1"
						)
);




$of_options[] = array( 	"name" 		=> "Footer 2 text color",
						"desc" 		=> "Light or Dark text color",
						"id" 		=> "footer_2_color",
						"std" 		=> "dark",
						"type" 		=> "images",
						"options" 	=> array(
											'light' => $url . 'text-light.gif',
											'dark' 	=> $url . 'text-dark.gif',
						)
);



$of_options[] = array( 	"name" 		=> "Footer 2 BG color",
						"id" 		=> "footer_2_bg_color",
						"std" 		=> "#777",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Footer 2 BG image",
						"id" 		=> "footer_2_bg_image",
						"std" 		=> "",
						"type" 		=> "media"
);


$of_options[] = array( 	"name" 		=> "Footer 2 columns",
						"desc" 		=> "",
						"id" 		=> "footer_2_columns",
						"std" 		=> "large-3",
						"type" 		=> "select",
						"options" 	=> array(
										"large-2" => "6",
										"large-3" => "4",
										"large-4" => "3",
										"large-6" => "2",
										"large-12" => "1"
						)
);



$of_options[] = array( 	"name" 		=> "Footer bottom bar text color",
						"desc" 		=> "Light or Dark text color",
						"id" 		=> "footer_bottom_style",
						"std" 		=> "dark",
						"type" 		=> "images",
						"options" 	=> array(
											'light' => $url . 'text-light.gif',
											'dark' 	=> $url . 'text-dark.gif',
						)
);


$of_options[] = array( 	"name" 		=> "Footer bottom bar BG color",
						"id" 		=> "footer_bottom_color",
						"std" 		=> "#333",
						"type" 		=> "color"
);


$of_options[] = array( 	"name" 		=> "HTML before footer",
						"desc" 		=> "Enter HTML for footer here. Shortcodes are allowed. F.ex [block id='payments']",
						"id" 		=> "html_before_footer",
						"std" 		=> "",
						"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "HTML after footer",
						"desc" 		=> "Enter HTML for footer here. Shortcodes are allowed. F.ex [block id='payments']",
						"id" 		=> "html_after_footer",
						"std" 		=> "",
						"type" 		=> "textarea"
);



// TYPE 
$of_options[] = array( 	"name" 		=> "Fonts",
						"type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "Disable Google fonts",
						"desc" 		=> "Disable google fonts. No fonts will be loaded from Google.",
						"id" 		=> "disable_fonts",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);




$of_options[] = array( 	"name" 		=> "Heading fonts (h1,h2 etc)",
						"desc" 		=> "Select heading fonts.<br> Need inspiration? <br>Check popuplar <a href='http://www.google.com/fonts/#Analytics:total' target='_blank'>google fonts here</a>",
						"id" 		=> "type_headings",
						"std" 		=> "Lato",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "<strong>Flatsome is Awesome!</strong> <br><span style='font-size:60%!important'>THIS TEXT IS IN UPPERCASE</span>", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=>  $google_fonts
);


$of_options[] = array( 	"name" 		=> "Text fonts (paragraphs, buttons, sub-navigations)",
						"desc" 		=> "Select heading fonts",
						"id" 		=> "type_texts",
						"std" 		=> "Lato",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "Nostrud qui disrupt, vinyl occupy ennui beard. Assumenda mollit 90's sunt occupy. Marfa helvetica brooklyn, narwhal odd future leggings sint ethnic. Eu officia fixie, veniam gluten-free pop-up church-key truffaut nihil dreamcatcher sed aliquip odio wes anderson.", //this is the text from preview box
										"size" => "14px" //this is the text size from preview box
						),
						"options" 	=>  $google_fonts
);

$of_options[] = array( 	"name" 		=> "Main navigation",
						"desc" 		=> "Select heading fonts",
						"id" 		=> "type_nav",
						"std" 		=> "Lato",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "<span style='font-size:45%'>HOME WOMEN MEN APPERAL</span>", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=>  $google_fonts
);


$of_options[] = array( 	"name" 		=> "Alterntative font (.alt-font)",
						"desc" 		=> "Select alternative font",
						"id" 		=> "type_alt",
						"std" 		=> "Dancing Script",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This font will be used on banners etc.", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=>  $google_fonts
);


$of_options[] = array( 	"name" 		=> "Character Sub-sets",
						"desc" 		=> "Choose the character sets you want.",
						"id" 		=> "type_subset",
						"std" 		=> array("latin"),
						"type" 		=> "multicheck",
						"options" 	=> array("latin" => "Latin","cyrillic-ext" => "Cyrillic Extended","greek-ext" => "Greek Extended","greek" => "Greek","vietnamese" => "Vietnamese","latin-ext" => "Latin Extended","cyrillic" => "Cyrillic")
);


// Custom font
$of_options[] = array( 	
		"name" 		=> "Upload Custom Font",
		"desc" 		=> "Upload Custom Font file here. (.ttf, .otf). You can select this font by selecting 'Custom font' in the settings above, or by CSS: h1 {font-family: customFont} ",
		"id" 		=> "custom_font",
		"std" 		=> "",
	    "mod"       => "font",
		"type" 		=> "media"
);


// COLORS


$of_options[] = array( 	"name" 		=> "Style and Colors",
						"type" 		=> "heading",
);

$of_options[] = array( 	"name" 		=> "Primary Color",
						"desc" 		=> "Change primary color. Used for primary buttons, shopping cart icon, Top bar background, etc.",
						"id" 		=> "color_primary",
						"std" 		=> "#627f9a",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Secondary Color",
						"desc" 		=> "Change secondary color. Used for Add to cart, checkout buttons, review stars and sale bubble.",
						"id" 		=> "color_secondary",
						"std" 		=> "#d26e4b",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Success Color",
						"desc" 		=> "Change the success color. Used for global success messages.",
						"id" 		=> "color_success",
						"std" 		=> "#7a9c59",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Default link color",
						"desc" 		=> "Change default link color. Used for product links, and links at pages and blog entries.",
						"id" 		=> "color_links",
						"std" 		=> "",
						"type" 		=> "color"
);


if(ux_is_woocommerce_active()) {

$of_options[] = array( 	"name" 		=> "Add to cart / Checkout buttons",
						"desc" 		=> "Change color for checkout buttons. Default is Secondary color",
						"id" 		=> "color_checkout",
						"std" 		=> "",
						"type" 		=> "color"
);


$of_options[] = array( 	"name" 		=> "Sale bubble",
						"desc" 		=> "Change color of sale bubble. Default is Secondary color",
						"id" 		=> "color_sale",
						"std" 		=> "",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "New bubble",
						"desc" 		=> "Change color of the 'New' bubble.",
						"id" 		=> "color_new_bubble",
						"std" 		=> "#7a9c59",
						"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "Review Stars",
						"desc" 		=> "Change color of review stars",
						"id" 		=> "color_review",
						"std" 		=> "",
						"type" 		=> "color"
);

} // End  WooCommerce


$of_options[] = array( 	"name" 		=> "Button border radius",
						"desc" 		=> "change radius on buttons",
						"id" 		=> "button_radius",
						"std" 		=> "0px",
						"type" 		=> "select",

						"options" 	=> array(
										"0px" => "0px",
										"3px" => "3px",
										"5px" => "5px",
										"10px" => "10px",
										"15px" => "15px",
										"30px" => "30px",
										"99px" => "99px",

						)
);


$of_options[] = array( 	"name" 		=> "Dropdown border color",
						"desc" 		=> "Change color of dropdown border",
						"id" 		=> "dropdown_border",
						"std" 		=> "",
						"type" 		=> "color"
);



$of_options[] = array( 	"name" 		=> "Dropdown Background Color",
						"desc" 		=> "Change color of dropdown background",
						"id" 		=> "dropdown_bg",
						"std" 		=> "",
						"type" 		=> "color"
);



$of_options[] = array( 	"name" 		=> "Dropdown Text Color",
						"desc" 		=> "Light or Dark dropdown color",
						"id" 		=> "dropdown_text",
						"std" 		=> "light",
						"type" 		=> "images",
						"options" 	=> array(
											'light' => $url . 'text-light.gif',
											'dark' 	=> $url . 'text-dark.gif',
						)
);


if(ux_is_woocommerce_active()) {
	// ONLY FOR WOOCOMMERCE

$of_options[] = array( 	"name" 		=> "Product Page",
						"type" 		=> "heading",
);

$of_options[] = array( 	"name" 		=> "Product Page layout",
						"desc" 		=> "",
						"id" 		=> "product_sidebar",
						"std" 		=> "no_sidebar",
						"type" 		=> "select",
						"options" 	=> array(
										"no_sidebar" => "No Sidebar",
										"full_width" => "Full Width",
										"left_sidebar" => "Left Sidebar",
										"right_sidebar" => "Right Sidebar",
										"right_sidebar_fullheight" => "Right Sidebar - Full height"
						)
);

$of_options[] = array( 	"name" 		=> "Off-canvas Mobile Sidebar",
						"id" 		=> "product_offcanvas_sidebar",
						"desc"      => "Open Sidebar in Off-canvas on Mobile Screens",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);

$of_options[] = array( 	"name" 		=> "Product Info style",
						"desc" 		=> "Select how you want to display product info...",
						"id" 		=> "product_display",
						"std" 		=> "tabs",
						"type" 		=> "select",

						"options" 	=> array(
										"tabs" => "Tabs",
										"tabs_center" => "Tabs Center",
										"tabs_pills" => "Tabs (Pills style. NEW!)",
										"sections" => "Sections",
										"accordian" => "Accordion",
										"tabs_vertical" => "Vertical tabs"

						)
);



$of_options[] = array( 	"name" 		=> "Show Cart dropdown when product is added to cart",
						"id" 		=> "cart_dropdown_show",
						"desc"      => "Show Mini-cart dropdown after product is added to cart.",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Up-sell title",
				"id" 		=> "shop_aside_title",
				"std" 		=> "complete the look",
				"type" 		=> "text"
);


$of_options[] = array( 	"name" 		=> "Product Image Zoom (NEW)",
						"id" 		=> "product_zoom",
						"desc"      => "Enable zoom on product images when you hover your mouse.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);




$of_options[] = array( 	"name" 		=> "Related Products",
						"desc" 		=> "",
						"id" 		=> "related_products",
						"std" 		=> "slider",
						"type" 		=> "select",
						"options" 	=> array(
										"slider" => "Slider",
										"grid" => "Grid",
										"hidden" => "Remove"
						)
);


$of_options[] = array( 	"name" 		=> "Related Products pr row",
						"desc" 		=> "",
						"id" 		=> "related_products_pr_row",
						"std" 		=> "4",
						"type" 		=> "select",
						"options" 	=> array(
										"2" => "2",
										"3" => "3",
										"4" => "4",
										"5" => "5",
										"6" => "6"
						)
);

$of_options[] = array( 	"name" 		=> "Max number of related products",
						"desc" 		=> "",
						"id" 		=> "max_related_products",
						"std" 		=> "12",
						"type" 		=> "text",
);


$of_options[] = array( 	"name" 		=> "Disable Reviews Global",
						"id" 		=> "disable_reviews",
						"desc"      => "Disable reviews globally.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);

$of_options[] = array( 	"name"  => "Additional Global tab/section title",
				"id" 		=> "tab_title",
				"std" 		=> "",
				"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Additional Global tab/section content",
				"id" 		=> "tab_content",
				"std" 		=> "",
				"type" 		=> "textarea",
				"desc"      => "Add additional tab content here... Like Size Charts etc."
);


$of_options[] = array( 	"name" 		=> "HTML before Add To Cart button (Global)",
						"desc" 		=> "Enter HTML and shortcodes that will show before Add to cart selections.",
						"id" 		=> "html_before_add_to_cart",
						"std" 		=> " ",
						"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "HTML after Add To Cart button (Global)",
						"desc" 		=> "Enter HTML and shortcodes that will show after Add to cart button.",
						"id" 		=> "html_after_add_to_cart",
						"std" 		=> "",
						"type" 		=> "textarea"
);



$of_options[] = array( 	"name" 		=> "Category Page",
						"type" 		=> "heading"
);


$of_options[] = array( 	"name" 		=> "Shop header",
						"desc" 		=> "Enter HTML that should be placed on top of main shop page. Shortcodes are allowed. ",
						"id" 		=> "html_shop_page",
						"std" 		=> "",
						"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "Shop sidebar",
						"desc" 		=> "Select if you want a sidebar on product categories.",
						"id" 		=> "category_sidebar",
						"std" 		=> "left-sidebar",
						"type" 		=> "images",
						"options" 	=> array(
								'none' 	=> $url . 'shop-no-sidebar.gif',
								'left-sidebar' 	=> $url . 'shop-left-sidebar.gif',
								'right-sidebar' 	=> $url . 'shop-right-sidebar.gif',
								'off-canvas' 	=> $url . 'shop-off-canvas.gif',	
						)
);


$of_options[] = array( 	"name" 		=> "Product Grid style",
						"desc" 		=> "Select product grid style",
						"id" 		=> "grid_style",
						"std" 		=> "grid1",
						"type" 		=> "images",
						"options" 	=> array(
								'grid1' 	=> $url . 'grid1.gif',
								'grid2' 	=> $url . 'grid2.gif',
								'grid3' 	=> $url . 'grid3.gif',
									
						)
);



$of_options[] = array( 	"name" 		=> "Product Grid Frame Style",
						"desc" 		=> "Select product grid frame style",
						"id" 		=> "grid_frame",
						"std" 		=> "normal",
						"type" 		=> "images",
						"options" 	=> array(
											'normal' 	=> $url . 'grid-normal.gif',
											'frame' 	=> $url . 'grid-frame.gif',
											'boxed' 	=> $url . 'grid-box.gif',

						)
);



$of_options[] = array( 	"name" 		=> "Masonry Grid (NEW)",
						"id" 		=> "masonry_grid",
						"desc"      => "Display products as a Masonry Grid (Pinterest style) ",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);



$of_options[] = array( 	"name" 		=> "Add to cart button in grid", 
						"desc" 		=> "Add cart icon in grid. Choose between a Icon or a button",
						"id" 		=> "add_to_cart_icon",
						"std" 		=> "disable",
						"type" 		=> "images",
						"options" 	=> array(
											'disable' 	=> $url . 'disabled.gif',
											'show' 	=> $url . 'add-cart-icon.gif',
											'button'  => $url . 'grid4.gif',
						)
);


$of_options[] = array( 	"name" 		=> "Product short description",
						"id" 		=> "short_description_in_grid",
						"desc"      => "Show product short description in grid",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);






$of_options[] = array( 	"name" 		=> "Category Box style",
						"desc" 		=> "Change default category box style",
						"id" 		=> "cat_style",
						"std" 		=> "text-badge",
						"type" 		=> "select",
						"options" 	=> array(
										"text-badge" => "Text badge (default)",
										"text-overlay" => "Text Overlay",
										"text-bounce" => "Text Bounce",
										"text-normal" => "Text Normal",

						)
);






$of_options[] = array( 	"name" 		=> "Breadcrumb size",
						"desc" 		=> "Change size of breadcrumb on product categories. Useful if you have long breadcrumbs.",
						"id" 		=> "breadcrumb_size",
						"std" 		=> "breadcrumb-normal",
						"type" 		=> "select",

						"options" 	=> array(
										"breadcrumb-normal" => "Normal",//please, always use this key: "none"
										"breadcrumb-medium" => "Medium",
										"breadcrumb-small" => "Small",

						)
);

$of_options[] = array( 	"name" 		=> "Show 'Home' in breadcrumb",
						"id" 		=> "breadcrumb_home",
						"desc"      => "Show 'Home' in breadcrumb",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);

$of_options[] = array( 	"name" 		=> "Products per row - Desktop",
						"desc" 		=> "Change product per row for category pages.",
						"id" 		=> "category_row_count",
						"std" 		=> "3",
						"type" 		=> "select",

						"options" 	=> array(
										"1" => "1",
										"2" => "2",
										"3" => "3",
										"4" => "4",
										"5" => "5",
										"6" => "6",

						)
);


$of_options[] = array( 	"name" 		=> "Products per row - Mobile",
						"desc" 		=> "Change product per row for category pages.",
						"id" 		=> "category_row_count_mobile",
						"std" 		=> "2",
						"type" 		=> "select",

						"options" 	=> array(
										"1" => "1",
										"2" => "2",
						)
);




$of_options[] = array( 
				"name"  => "Products per page",
				"id" 		=> "products_pr_page",
				"desc" => "Change products per page.",
				"std" 		=> "12",
				"type" 		=> "text"
);

$of_options[] = array( 	"name" 		=> "Enable Blog and Pages in Search result",
						"desc" 		=> "",
						"id" 		=> "search_result",
						"desc"      => "Enable blog and pages in search result page.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);





$of_options[] = array( 	"name" 		=> "Product image hover style",
						"desc" 		=> "Change product image hover style",
						"id" 		=> "product_hover",
						"std" 		=> "fade_in_back",
						"type" 		=> "select",

						"options" 	=> array(
										"fade_in_back" => "Fade in back",
										"zoom_in" => "Zoom in",
										"none" => "Disabled"
						)
);


$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Sale bubble style",
						"desc" 		=> "change sale bubble style",
						"id" 		=> "bubble_style",
						"std" 		=> "style1",
						"type" 		=> "images",
						"options" 	=> array(
											'style1' 	=> $url . 'sale-bubble-style1.gif',
											'style2' 	=> $url . 'sale-bubble-style2.gif',
											'style3' 	=> $url . 'sale-bubble-style3.gif',
						)
);


$of_options[] = array( 	"name" 		=> "Display % instead of 'Sale!' in Sale bubble",
						"id" 		=> "sale_bubble_percentage",
						"desc"      => "Show % instead of the sale text. This will override the bubble text.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Disable quick view",
						"id" 		=> "disable_quick_view",
						"desc"      => "Disable quick view in product grid",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Wishlist Icon",
						"desc" 		=> "Change Wishlist Icon",
						"id" 		=> "wishlist_icon",
						"std" 		=> "heart",
						"type" 		=> "select",
						"options" 	=> array(
								"heart" => "Heart (Default)",
								"plus" => "Plus",
								"star" => "Star",
								"list" => "List",
								"pen" => "Pen",
						)
);



$of_options[] = array( 	"name" 		=> "Cart and Checkout",
						"type" 		=> "heading",
);


$of_options[] = array( 	"name" 		=> "Coupon on Checkout page",
						"id" 		=> "coupon_checkout",
						"desc"      => "Enable coupon at checkout page.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Continue Shopping button",
						"id" 		=> "continue_shopping",
						"desc"      => "Enable 'Continue Shopping' button on Cart and Thank you page",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);

$of_options[] = array( 	"name" 		=> "After cart content",
						"desc" 		=> "Enter HTML that will show after cart here.",
						"id" 		=> "html_cart_footer",
						"std" 		=> "",
						"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "Checkout Sidebar Content",
						"desc" 		=> "Enter HTML that will show on bottom of checkout sidebar",
						"id" 		=> "html_checkout_sidebar",
						"std" 		=> "",
						"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "Thank You Page Content / Scripts",
						"desc" 		=> "Enter scripts or custom HTML content for the thank you page here",
						"id" 		=> "html_thank_you",
						"std" 		=> "",
						"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "Catalog Mode",
						"type" 		=> "heading",
);


$of_options[] = array( 	"name" 		=> "Enable catalog mode",
						"id" 		=> "catalog_mode",
						"desc"      => "Enable catalog mode. This will disable Add To Cart buttons / Checkout and Shopping cart.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);



$of_options[] = array( 	"name" 		=> "Disable prices",
						"id" 		=> "catalog_mode_prices",
						"desc"      => "Select to disable prices on category pages and product page.",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" => "Cart / Account replacement (header)",
				"id" 		=> "catalog_mode_header",
				"std" 		=> "",
				"type" 		=> "textarea",
				"desc"      => "Enter content you want to display instad of Account / Cart. Shortcodes are allowed. For search box enter <b>[search]</b>. For social icons enter: <b>[follow twitter='http://' facebook='http://' email='post@email.com' pinterest='http://']</b>"
);

$of_options[] = array( 	"name" => "Add to cart replacement - Product page",
				"id" 		=> "catalog_mode_product",
				"std" 		=> "",
				"type" 		=> "textarea",
				"desc"      => "Enter contact information or enquery form shortcode here."
);

$of_options[] = array( 	"name" => "Add to cart replacement - Product Quick View",
				"id" 		=> "catalog_mode_lightbox",
				"std" 		=> "",
				"type" 		=> "textarea",
				"desc"      => "Enter text that will show in product quick view"
);


} // End if WooCommerce

$of_options[] = array( 	"name" 		=> "Blog",
						"type" 		=> "heading"
);


$of_options[] = array( 	"name" 		=> "Blog list layout",
						"desc" 		=> "Change blog layout",
						"id" 		=> "blog_layout",
						"std" 		=> "right-sidebar",
						"type" 		=> "select",
						"options"   => array("left-sidebar" => "Left sidebar", "right-sidebar" => "Right sidebar", "no-sidebar" => "No sidebar (Centered)" )
);


$of_options[] = array( 	"name" 		=> "Blog list style",
						"desc" 		=> "Change blog style",
						"id" 		=> "blog_style",
						"std" 		=> "blog-normal",
						"type" 		=> "select",
						"options"   => array("blog-normal" => "Normal", "blog-list" => "List style", "blog-pinterest" => "Pinterest style" )
);

$of_options[] = array( 	"name" 		=> "Blog Archive Title",
						"desc" 		=> "",
						"id" 		=> "blog_archive_title",
						"desc"      => "Enable title for Blog posts archives.",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);



$of_options[] = array( 	"name" 		=> "Blog homepage header",
						"desc" 		=> "Enter HTML for blog header here. Will be placed above content and sidebar. Shortcodes are allowed. F.ex [block id='blog-header']",
						"id" 		=> "blog_header",
						"std" 		=> " ",
						"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "HTML after blog posts",
						"desc" 		=> "Enter HTML or shortcodes that will be visible after blog posts. (Before comment box). Shortcodes are allowed",
						"id" 		=> "blog_after_post",
						"std" 		=> " ",
						"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "Blog single post layout",
						"desc" 		=> "Change blog post layout",
						"id" 		=> "blog_post_layout",
						"std" 		=> "right-sidebar",
						"type" 		=> "select",
						"options"   => array("left-sidebar" => "Left sidebar", "right-sidebar" => "Right sidebar", "no-sidebar" => "No sidebar (Centered)" )
);

$of_options[] = array( 	"name" 		=> "Blog single post header style",
						"desc" 		=> "Change blog post style",
						"id" 		=> "blog_post_style",
						"std" 		=> "default",
						"type" 		=> "select",
						"options"   => array("default" => "Default", "big-featured-image" => "Big featured image")
);



$of_options[] = array( 	"name" 		=> "Show author box",
						"desc" 		=> "",
						"id" 		=> "blog_author_box",
						"desc"      => "Show author box on blog posts",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);



$of_options[] = array( 	"name" 		=> "Enable Share Icons",
						"desc" 		=> "",
						"id" 		=> "blog_share",
						"desc"      => "Enable Share icons on blog",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Parallax effect",
						"desc" 		=> "",
						"id" 		=> "blog_parallax",
						"desc"      => "Enable parallax effect on featured images",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Featured Items",
						"type" 		=> "heading"
);


$of_options[] = array( 
				"name"  => "Featured Items Page",
				"id" => "featured_items_page",
				"desc" =>  "Set a custom page as parent for the Featured Items. <strong>NB: You might have to save Theme Options two times for the Featured Items permalinks to work properly.</strong>",
				"std" 		=> 0,
				"type" 		=> "select",
				"options" => $of_pages
);



$of_options[] = array( 
				"name"  => "Items per page (Archive and Template pages)",
				"id" 		=> "featured_items_pr_page",
				"desc" => "Change items per page.",
				"std" 		=> "12",
				"type" 		=> "text"
);



$of_options[] = array( 	"name" 		=> "Related items",
						"desc" 		=> "Change  style of related featured items",
						"id" 		=> "featured_items_related",
						"std" 		=> "2",
						"type" 		=> "select",
						"options"   => array("default" => "Default", "text_overlay" => "Text Overlay", "disabled" => "Disabled" ),
);

$of_options[] = array( 
				"name"  => "Featured items height",
				"id" 		=> "featured_items_related_height",
				"desc" => "Change image height on featured items.",
				"std" 		=> "250px",
				"type" 		=> "text"
);


$of_options[] = array( 	"name" 		=> "My Account Page",
						"type" 		=> "heading",
);

$of_options[] = array( 	"name" 		=> "Enable WC Endpoint links in Account dropdown and Sidebar (For WooCommerce 2.6 and up)",
						"id" 		=> "wc_account_links",
						"desc"      => "Enable automatic endpoint links in Account dropdown and sidebar'",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Enable Facebook Login / Register on Login page",
						"id" 		=> "facebook_login",
						"desc"      => "This will create a Registrer/login button for Facebook on all My Account pages. Requires the plugin 'Nextend Facebook Connect'",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);

$of_options[] = array( 	"name" 		=> "Facebook login - background image",
						"desc" 		=> "Upload background for facebook login header.",
						"id" 		=> "facebook_login_bg",
						"std" 		=> "",
						"type" 		=> "media"
);

$of_options[] = array( 	"name"  => "Facebook login - description text",
				"id" 		=> "facebook_login_text",
				"std" 		=> "",
				"type" 		=> "text"
);


$of_options[] = array( 	"name" 		=> "Enable Facebook Login / Register on Checkout",
						"id" 		=> "facebook_login_checkout",
						"desc"      => "Enable facebook login button on Checkout page",
						"std" 		=> 0,
						"type" 		=> "checkbox"
);


$of_options[] = array( 	"name" 		=> "Social and Sharing",
						"type" 		=> "heading",
);


$of_options[] = array( 	"name" 		=> "Share icons",
						"desc" 		=> "Select icons to be shown on share icons on product page, blog and [share] shortcode",
						"id" 		=> "social_icons",
						"std" 		=> array("facebook","twitter","email","pinterest","googleplus","whatsapp","tumblr"),
						"type" 		=> "multicheck",
						"options" 	=> array(
							"facebook" => "Facebook",
							"linkedin" => "LinkedIn",
							"twitter" => "Twitter",
							"email" => "Email",
							"pinterest" => "Pinterest",
							"googleplus" => "Google Plus",
							"vk" => "VKontakte",
							"tumblr" => "Tumblr",
							"whatsapp" => "WhatsApp (Only for Mobile)",
						)
);


$of_options[] = array( 	"name" 		=> "Custom share icons",
						"desc" 		=> "Replace share icons with custom share script or HTML. Leave empty to use default share icons.",
						"id" 		=> "custom_share_icons",
						"std" 		=> "",
						"type" 		=> "textarea"
);


				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup and Import",
						"type" 		=> "heading",
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
);


/*
$defaults = null;
foreach ($of_options as $key => $value) {
	if(isset($value['id']) && isset($value['std'])){
		$defaults[$value['id']] = $value['std'];
	}
}
$defaults = var_export($defaults);
echo $defaults; */
 
}//End function: of_options()
}//End chack if function exists: of_options()
?>
