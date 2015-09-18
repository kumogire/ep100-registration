<?php

$f3=require('lib/base.php');
$f3->set('DEBUG',1);
$f3->config('config.ini');

// MySql settings
$f3->set('DB', new DB\SQL(
   'mysql:host=localhost;port=3306;dbname=ep100',
    'checkinadmin',
    'getRdon3!'
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
	
$f3->set('totalriders',$db->exec('SELECT count(LastName) r FROM registrations WHERE TransferFrom IS NULL'));
$f3->set('totalriderschecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber IS NOT NULL AND BibNumber <>""'));
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

		$onum = substr($search,0,9);
		//echo $onum;
		
		//CREATE QUERY AND ASSIGN TO DATA SET		
		$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');
		$filter = '  OrderNum LIKE "'.$onum.'%" OR LastName LIKE "'.$search.'%" OR FirstName LIKE "'.$search.'%" ';
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



//SEARCH BY BIB NUMBER VIEW

$f3->route('GET /bibsearch',
	function($f3) {

	$db = $f3->get('DB');

	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('bibsearch.htm');
	echo $template->render('footer.htm');
	}
);



//BIB SEARCH RESULTS VIEW

$f3->route('POST /bibresults',
	function($f3) {
	
	
	//ASSIGN POST PARAMETERS TO SEARCH VAR
	$search = $f3->get('POST.id');

		$db = $f3->get('DB');
	
		//CREATE QUERY AND ASSIGN TO DATA SET		
		$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');
		$filter = '  BibNumber = "'.$search.'" ';
		//CAN ADD LIMIT PARAM TO OPTION ARRAY, REMEMBER COMMA AFTER ORDER LINE
		$option = array(
            'order' => 'TicketType, LastName ASC'
		);   
		$resultset=$riders->find($filter,$option);
		
		//SET QUERY VAR
		$f3->set('search',$search);
		$f3->set('result',$resultset);		
		
		//BUILD DISPLAY TEMPLATES
		$template=new Template;
		echo $template->render('header.htm');
        echo $template->render('bibresults.htm');
		echo $template->render('footer.htm');
	}
);



//CURRENT RIDE CHECKIN STATS VIEW

$f3->route('GET /stats',
	function($f3) {

	$db = $f3->get('DB');

//10 miler stats
$rows=$db->exec('SELECT LastName FROM registrations WHERE TicketType LIKE "EP100 10 Mile%"');
$t10m = count($rows);
$rows=$db->exec('SELECT LastName FROM registrations WHERE BibNumber IS NOT NULL AND TicketType LIKE "EP100 10 Mile%"');
$t10mcheck = count($rows);
$percent10m = round(($t10mcheck/$t10m)*100)." %";

//50 miler stats
$rows=$db->exec('SELECT LastName FROM registrations WHERE TicketType LIKE "EP100 50 Mile%"');
$t50m = count($rows);
$rows=$db->exec('SELECT LastName FROM registrations WHERE BibNumber IS NOT NULL AND TicketType LIKE "EP100 50 Mile%"');
$t50mcheck = count($rows);
$percent50m = round(($t50mcheck/$t50m)*100)." %";

//100 miler stats
$rows=$db->exec('SELECT LastName FROM registrations WHERE TicketType LIKE "EP100 150K (93.2 miles)%"');
$t100m = count($rows);
$rows=$db->exec('SELECT LastName FROM registrations WHERE BibNumber IS NOT NULL AND TicketType LIKE "EP100 150K (93.2 miles)%"');
$t100mcheck = count($rows);
$percent100m = round(($t100mcheck/$t100m)*100)." %";

//Riders Checked In Before Checkin Dates
$rows=$db->exec('SELECT LastName FROM registrations WHERE DATE_FORMAT(CheckinDate,"%c-%e-%y") <= "9-17-15" and (BibNumber IS NOT NULL AND BibNumber <> "") ');
$totalbefore = count($rows);

//Riders Checked In on Friday
$rows=$db->exec('SELECT LastName FROM registrations WHERE DATE_FORMAT(CheckinDate,"%c-%e-%y") = "9-18-15" and BibNumber IS NOT NULL');
$totalfri = count($rows);

//Riders Checked In on Saturday
$rows=$db->exec('SELECT LastName FROM registrations WHERE DATE_FORMAT(CheckinDate,"%c-%e-%y") = "9-19-15" and BibNumber IS NOT NULL ');
$totalsat = count($rows);

//Riders Checked In on Sunday
$rows=$db->exec('SELECT LastName FROM registrations WHERE DATE_FORMAT(CheckinDate,"%c-%e-%y") = "9-20-15" and BibNumber IS NOT NULL ');
$totalsun = count($rows);


		//SET QUERY VAR
		$f3->set('p10',$percent10m);
		$f3->set('p50',$percent50m);
		$f3->set('p100',$percent100m);
		$f3->set('r10r',$t10m);
		$f3->set('r50r',$t50m);
		$f3->set('r100r',$t100m);
		$f3->set('r10c',$t10mcheck);
		$f3->set('r50c',$t50mcheck);
		$f3->set('r100c',$t100mcheck);
		$f3->set('tbe',$totalbefore);
		$f3->set('tfri',$totalfri);
		$f3->set('tsat',$totalsat);
		$f3->set('tsun',$totalsun);
		

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
$filter = ' RiderID = "'.$RiderID.'"';
    
$rider=$redit->find($filter);
$f3->set('rider',$rider);

	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('details.htm');
	echo $template->render('footer.htm');
	}
);




//RIDER TRANSFER VIEW

$f3->route('GET /transfer/@RiderID',

	function($f3) {

	$db = $f3->get('DB');
	$RiderID = $f3->get('PARAMS.RiderID');

$redit=new DB\SQL\Mapper($f3->get('DB'),'registrations');
$filter = ' RiderID = "'.$RiderID.'"';
    
$rider=$redit->find($filter);
$f3->set('rider',$rider);

	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('transfer.htm');
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
//CHECK TO SEE IF THEY HAVE BEEN CHECKED IN ALREADY
$rows=$db->exec('SELECT BibNumber FROM registrations WHERE BibNumber = "'.$B[$i].'"');
$exists = count($rows);
if($exists == 0){
$db->exec('UPDATE registrations SET BibNumber = "'.$B[$i].'", Email = "'.$E[$i].'", CheckInDate = now() WHERE RiderID = "'.$value.'"');
}
}
$i++;
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
	$lastInsertedID = $f3->get('rider')->get('_id');

$BibNumber = $f3->get('POST.BibNumber');
if($BibNumber != ""){
$db->exec('UPDATE registrations SET BibNumber = "'.$BibNumber.'", CheckInDate = now() WHERE RiderID = "'.$lastInsertedID.'"');
}else{
$db->exec('UPDATE registrations SET BibNumber = NULL WHERE RiderID = "'.$lastInsertedID.'"');
}
	
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
	$OLDRiderID = $f3->get('POST.TransferFrom');
	
	//CREATE NEW RECORD
	
	$f3->set('rider',new DB\SQL\Mapper($f3->get('DB'),'registrations'));
	$f3->get('rider')->copyFrom('POST');
	$f3->get('rider')->save(); 
	$lastInsertedID = $f3->get('rider')->get('_id');
	
$BibNumber = $f3->get('POST.BibNumber');
if($BibNumber != ""){
$db->exec('UPDATE registrations SET BibNumber = "'.$BibNumber.'", CheckInDate = now() WHERE RiderID = "'.$lastInsertedID.'"');
}else{
$db->exec('UPDATE registrations SET LastUpdate = now() WHERE RiderID = "'.$lastInsertedID.'"');
}
	
	//UPDATE OLD RECORD

if($f3->exists('POST.TransferFrom'))
    {
	$db->exec('UPDATE registrations SET TransferTo = "'.$lastInsertedID.'" WHERE RiderID = "'.$OLDRiderID.'"');  
	//echo $db->log();
$f3->reroute('/home/4');
    }
	
	}
);


//ROUTE FOR CHECKING IF RIDER HAS RIDEN IN THE 2011 EP100

$f3->route('GET /2011rider',
function($f3) {

	$db = $f3->get('DB');
	$i = 0;
	
//GET LIST OF 2011 RIDERS
$pastrider=new \DB\SQL\Mapper($db,'mc-2011riders');
$pastrider->load('');
while(!$pastrider->dry()) {

$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');
$filter = '  LastName = "'.str_replace('"', "", $pastrider->LastName).'" AND FirstName = "'.str_replace('"', "", $pastrider->FirstName).'" ';
//$resultset=$riders->find($filter);
$matches=$riders->find($filter);

foreach($matches as $match)
$db->exec('UPDATE registrations SET 2011Rider = "Yes" WHERE RiderID = "'.$match->RiderID.'"');
  //echo $i.". ".$match->FirstName." ".$match->LastName."<br>";//db mapper
  
  $pastrider->next();
}

 
	
	}
);



//ROUTE FOR CHECKING IF RIDER HAS RIDEN IN THE 2012 EP100

$f3->route('GET /2012rider',
function($f3) {

	$db = $f3->get('DB');
	$i = 0;
	
//GET LIST OF 2012 RIDERS
$pastrider=new \DB\SQL\Mapper($db,'mc-2012riders');
$pastrider->load('');
while(!$pastrider->dry()) {

$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');
$filter = '  LastName = "'.str_replace('"', "", $pastrider->LastName).'" AND FirstName = "'.str_replace('"', "", $pastrider->FirstName).'" ';
//$resultset=$riders->find($filter);
$matches=$riders->find($filter);

foreach($matches as $match)
$db->exec('UPDATE registrations SET 2012Rider = "Yes" WHERE RiderID = "'.$match->RiderID.'"');
  //echo $i.". ".$match->FirstName." ".$match->LastName."<br>";//db mapper
  
  $pastrider->next();
}

 
	
	}
);



//ROUTE FOR CHECKING IF RIDER HAS RIDEN IN THE 2013 EP100

$f3->route('GET /2013rider',
function($f3) {

	$db = $f3->get('DB');
	$i = 0;
	
//GET LIST OF 2013 RIDERS
$pastrider=new \DB\SQL\Mapper($db,'mc-2013riders');
$pastrider->load('');
while(!$pastrider->dry()) {

$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');
$filter = '  LastName = "'.str_replace('"', "", $pastrider->LastName).'" AND FirstName = "'.str_replace('"', "", $pastrider->FirstName).'" ';
//$resultset=$riders->find($filter);
$matches=$riders->find($filter);

foreach($matches as $match)
$db->exec('UPDATE registrations SET 2013Rider = "Yes" WHERE RiderID = "'.$match->RiderID.'"');
  //echo $i.". ".$match->FirstName." ".$match->LastName."<br>";//db mapper
  
  $pastrider->next();
}

 
	
	}
);//ROUTE FOR CHECKING IF RIDER HAS RIDEN IN THE 2014 EP100$f3->route('GET /2014rider',function($f3) {	$db = $f3->get('DB');	$i = 0;//GET LIST OF 2013 RIDERS$pastrider=new \DB\SQL\Mapper($db,'mc-2014riders');$pastrider->load('');while(!$pastrider->dry()) {$riders=new DB\SQL\Mapper($f3->get('DB'),'registrations');$filter = '  LastName = "'.str_replace('"', "", $pastrider->LastName).'" AND FirstName = "'.str_replace('"', "", $pastrider->FirstName).'" ';//$resultset=$riders->find($filter);$matches=$riders->find($filter);foreach($matches as $match)$db->exec('UPDATE registrations SET 2014Rider = "Yes" WHERE RiderID = "'.$match->RiderID.'"');  //echo $i.". ".$match->FirstName." ".$match->LastName."<br>";//db mapper  $pastrider->next();}	});

$f3->run();
