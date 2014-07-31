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

//DEFAULT SEARCH PAGE (HOME)
$f3->route('GET /',
	function($f3) {

	$db = $f3->get('DB');
	
$f3->set('totalriders',$db->exec('SELECT count(LastName) r FROM registrations'));
$f3->set('totalriderschecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber <> 0'));
	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('search.htm');
	echo $template->render('footer.htm');
	}
);

//SEARCH RESULTS PAGE
$f3->route('POST /results',
	function($f3) {
	
	//IF YOU WANT TO GET VALUES FROM SEF URL
	//$f3->route('GET /results/@id',
	//$search = $f3->get('PARAMS.id');
	
	//ASSIGN POST PARAMETERS TO SEARCH VAR
	$search = $f3->get('POST.id');
	
	$db = $f3->get('DB');
	
		//SET VAR VALUE
		$f3->set('name','world');
		//CREATE QUERY AND ASSIGN TO DATA SET
		$f3->set('result',$db->exec('SELECT FirstName, LastName, TicketType FROM registrations WHERE OrderNum LIKE "'.$search.'%" OR LastName LIKE "'.$search.'%" OR FirstName LIKE "'.$search.'%" ORDER BY TicketType, LastName ASC '));
		
		//BUILD DISPLAY TEMPLATES
		$template=new Template;
		echo $template->render('header.htm');
        echo $template->render('results.htm');
		echo $template->render('footer.htm');
	}
);



//STATS PAGE
$f3->route('GET /stats',
	function($f3) {

	$db = $f3->get('DB');
	
$f3->set('total10mi',$db->exec('SELECT count(LastName) c FROM registrations WHERE TicketType = "EP100 10 Mile"'));
$f3->set('total10michecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber <> 0 AND TicketType = "EP100 10 Mile"'));
$f3->set('total50mi',$db->exec('SELECT count(LastName) c FROM registrations WHERE TicketType = "EP100 50 Mile"'));
$f3->set('total50michecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber <> 0 AND TicketType = "EP100 50 Mile"'));
$f3->set('total100mi',$db->exec('SELECT count(LastName) c FROM registrations WHERE TicketType = "EP100 150K (93.2 miles)"'));
$f3->set('total100michecked',$db->exec('SELECT count(LastName) c FROM registrations WHERE BibNumber <> 0 AND TicketType = "EP100 150K (93.2 miles)"'));
	$template=new Template;
	echo $template->render('header.htm');
    echo $template->render('stats.htm');
	echo $template->render('footer.htm');
	}
);



$f3->run();
