<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="viewport" content="width=device-width" />
  <base href="<?php echo $SCHEME.'://'.$HOST.':'.$PORT.$BASE.'/'; ?>" />
  <title>2014 Edible Pedal 100 Check In</title>
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/responsee.css">  
  <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="owl-carousel/owl.theme.css">
  
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.7.0/jquery-ui.min.js"></script>    
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script type="text/javascript" src="js/responsee.js"></script>
  
  <!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body class="size-960">
 <!-- HEADER -->
  <header>
	<div class="line">
	  <div class="box">
	  2014 Edible Pedal 100 Check In
		</div>
</div>
  </header> 
<section>
<div class="line">
<div class="margin">
		<div class="box">
<p>Hello, <?php echo $name; ?></p>
<?php foreach (($result?:array()) as $item): ?>
    <span><?php echo $item['LastName']; ?>, <?php echo $item['FirstName']; ?></span><br />
	<?php endforeach; ?>
		</div>
</div>
</div>
</section>
<!-- FOOTER -->
  <footer class="line">
	<div class="box">
	  <div class="s-12 l-6">
		<p>© 2014 Edible Pedal 100, All Rights Reserved</p>
	  </div>
	  <div class="s-12 l-6">
		<p class="right">Design and coding by TrinityApplied Internet</p>
	  </div>
	</div>    
  </footer>
  </body>
</html>