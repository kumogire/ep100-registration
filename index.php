<?php

$f3=require('lib/base.php');
$f3->set('DEBUG',1);
$f3->config('config.ini');



$f3->route('GET /',
	function($f3) {
	$db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=ep100',
    'root',
    ''
);
$f3->set('name','world');
		$f3->set('result',$db->exec('SELECT FirstName, LastName FROM registrations WHERE Rotarian = "Yes"'));
		//$f3->set('content', 'home.html');
		//echo View::instance()->render('test.htm');
		$template=new Template;
        echo $template->render('test.htm');
	}
);


$f3->route('GET /search',
	function($f3) {
		$f3->set('content','search.html');
		echo View::instance()->render('layout.htm');
	}
);

$f3->run();
