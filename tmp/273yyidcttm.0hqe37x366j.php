	<h2>Rider Lookup</h2>
	<p>Search registrations by Confirmation Code, First Name, Last Name:</p>
	
<form name="form" action="results" method="POST">
<input type="text" name="id" autofocus>
<input type="submit" value="Submit">
</form>
	<p><?php foreach (($totalriders?:array()) as $item): ?>
    <span>Total Registrations: <?php echo $item['r']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><?php foreach (($totalriderschecked?:array()) as $item): ?>
    <span>Total Check-Ins: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><a href="stats">All Stats</a></p>

