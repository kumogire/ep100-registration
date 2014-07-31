	<h2>Rider Lookup</h2>
	<p>Search registrations by Confirmation Code, First Name, Last Name:</p>
	
<form name="form" action="results" method="POST">
<input type="text" name="id">
<input type="submit" value="Submit">
</form>
	<p><?php foreach (($m10checked?:array()) as $item): ?>
    <span>10 Milers - Checked In: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>

