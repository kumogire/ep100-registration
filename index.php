<?php

$f3=require('lib/base.php');
$f3->set('DEBUG',1);
$f3->config('config.ini');

// MySql settings
$f3->set('DB', new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=ep100',
    'root',
    ''
)); 

$f3->route('GET /',
	function($f3) {
$f3->reroute('/home/0');
	}
);


//DEFAULT SEARCH FORM VIEW(HOME)

$f3->route('GET /home/@status',
	function($f3) {

	$db = $f3->get('DB');
	
	//MESSAGING
	$status = $f3->get('PARAMS.status');
	if($status == '1'){
	$f3->set('message', 'Rider(s) successfully checked-in.');
	}elseif($status == '2'){
	$f3->set('message', 'Rider added to database.');
	}elseif($status == '3'){
	$f3->set('message', 'Rider information updated.');
	}elseif($status == '4'){
	$f3->set('message', 'Transfer created.');
	}else{
	$f3->set('message', '');
	}
	
$f3->set('totalriders',$db->exec('SELECT count(LastName) r FROM registrations'));
$f3->set('totalriderschecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber IS NOT NULL'));
	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('search.htm');
	echo $template->render('footer.htm');
	}
);


//SEARCH RESULTS VIEW

$f3->route('POST /results',
	function($f3) {
	
	//IF YOU WANT TO GET VALUES FROM SEF URL
	//$f3->route('GET /results/@id',
	//$search = $f3->get('PARAMS.id');
	
	//BACK TO HOME URL VALUE <-- NOT REALLY SURE WHY THIS DOESN'T WORK
	//$f3->set('home',$f3->get('BASE'));
	
	//ASSIGN POST PARAMETERS TO SEARCH VAR
	$search = $f3->get('POST.id');
	
		$db = $f3->get('DB');
	
		//SET VAR VALUE EXAMPLE
		//$f3->set('name','world');

		//CREATE QUERY AND ASSIGN TO DATA SET - OLD WAY
		//$f3->set('result',$db->exec('SELECT RiderID, OrderNum, BibNumber, FirstName, LastName, TicketType, Email, 2011Rider, 2012Rider, 2013Rider FROM registrations WHERE OrderNum LIKE "'.$search.'%" OR LastName LIKE "'.$search.'%" OR FirstName LIKE "'.$search.'%" ORDER BY TicketType, LastName ASC '));

		//CREATE QUERY AND ASSIGN TO DATA SET		
		$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');
		$filter = '  OrderNum LIKE "'.$search.'%" OR LastName LIKE "'.$search.'%" OR FirstName LIKE "'.$search.'%" ';
		//CAN ADD LIMIT PARAM TO OPTION ARRAY, REMEMBER COMMA AFTER ORDER LINE
		$option = array(
            'order' => 'TicketType, LastName ASC'
		);   
		$resultset=$riders->find($filter,$option);
		//HOW MANY RESULTS?
		$count = count($resultset);
		$f3->set('count',$count);
		//SET QUERY VAR
		$f3->set('search',$search);
		$f3->set('result',$resultset);
		
		
		//BUILD DISPLAY TEMPLATES
		$template=new Template;
		echo $template->render('header.htm');
        echo $template->render('results.htm');
		echo $template->render('footer.htm');
	}
);


//CURRENT RIDE CHECKIN STATS VIEW

$f3->route('GET /stats',
	function($f3) {

	$db = $f3->get('DB');
	
$f3->set('total10mi',$db->exec('SELECT count(LastName) c FROM registrations WHERE TicketType = "EP100 10 Mile"'));
$f3->set('total10michecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber IS NOT NULL AND TicketType = "EP100 10 Mile"'));
$f3->set('total50mi',$db->exec('SELECT count(LastName) c FROM registrations WHERE TicketType = "EP100 50 Mile"'));
$f3->set('total50michecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber IS NOT NULL AND TicketType = "EP100 50 Mile"'));
$f3->set('total100mi',$db->exec('SELECT count(LastName) c FROM registrations WHERE TicketType = "EP100 150K (93.2 miles)"'));
$f3->set('total100michecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber IS NOT NULL AND TicketType = "EP100 150K (93.2 miles)"'));
	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('stats.htm');
	echo $template->render('footer.htm');
	}
);



//ADD RIDER VIEW

$f3->route('GET /add',

	function($f3) {

	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('addrider.htm');
	echo $template->render('footer.htm');
	}
);


//RIDER DETAIL (& EDIT) VIEW

$f3->route('GET /details/@RiderID',

	function($f3) {

	$db = $f3->get('DB');
	$RiderID = $f3->get('PARAMS.RiderID');

$redit=new DB\SQL\Mapper($f3->get('DB'),'registrations');
$filter = ' RiderID = "'.$RiderID.'%"';
    
$rider=$redit->find($filter);
$f3->set('rider',$rider);

	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('details.htm');
	echo $template->render('footer.htm');
	}
);


//UPDATE GROUP FUNCTIONALITY (STATUS 1)

$f3->route('POST /updategroup',
function($f3) {

	$db = $f3->get('DB');

$R = $f3->get('POST.RiderID');
$B = $f3->get('POST.BibNumber');
$E = $f3->get('POST.Email');
$i = 0;

//$f3->set('rider',new DB\SQL\Mapper($f3->get('DB'),'registrations'));

foreach ($R as &$value) {
if($B[$i] != ''){
$db->exec('UPDATE registrations SET BibNumber = "'.$B[$i].'", Email = "'.$E[$i].'", CheckInDate = now() WHERE RiderID = "'.$value.'"');
$i++;
}
}

$f3->reroute('/home/1');
	}
);


//CREATE NEW RIDER (STATUS 2)

$f3->route('POST|HEAD /addrider',
function($f3) {

	$db = $f3->get('DB');
	$f3->set('rider',new DB\SQL\Mapper($f3->get('DB'),'registrations'));
	//$f3->get('rider')->load(array('RiderID=?',$f3->get('POST.RiderID')));
	$f3->get('rider')->copyFrom('POST');
	//$f3->get('rider')->update(); 
	$f3->get('rider')->save();  
	//echo $db->log();
$f3->reroute('/home/2');
 
	}
);


//UPDATE RIDER FUNCTIONALITY (STATUS 3)

$f3->route('POST|HEAD /updaterider',
function($f3) {

	$db = $f3->get('DB');
	$RiderID = $f3->get('POST.RiderID');

if($f3->exists('POST.RiderID'))
    {
	$f3->set('rider',new DB\SQL\Mapper($f3->get('DB'),'registrations'));
	$f3->get('rider')->load(array('RiderID=?',$f3->get('POST.RiderID')));
	$f3->get('rider')->copyFrom('POST');
	$f3->get('rider')->update(); 
	$f3->get('rider')->save();  
	//echo $db->log();
$f3->reroute('/home/3');
    }
	
	}
);


//NEW TRANSFER (STATUS 4)

$f3->route('POST|HEAD /transferrider',
function($f3) {

	$db = $f3->get('DB');
	$RiderID = $f3->get('POST.RiderID');

if($f3->exists('POST.RiderID'))
    {
	$f3->set('rider',new DB\SQL\Mapper($f3->get('DB'),'registrations'));
	$f3->get('rider')->load(array('RiderID=?',$f3->get('POST.RiderID')));
	$f3->get('rider')->copyFrom('POST');
	$f3->get('rider')->update(); 
	$f3->get('rider')->save();  
	//echo $db->log();
$f3->reroute('/home/3');
    }
	
	}
);


$f3->run();
