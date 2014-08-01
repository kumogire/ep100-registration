	<h2>Rider Lookup</h2>
	
	<h4>Search registrations by Confirmation Code, First Name, Last Name:</h4>

<form class="customform" action="results" method="POST">
<div class="line">
<div class="margin">
<div class="s-12 l-4">
<div class="s-8"><input type="text" name="id" autofocus></div>
<div class="s-8 l-4 right margin"><button type="submit">Search</button></div>
</div>
</div>
</div>

</form>
<div class="line">
<div class="margin">
<div class="s-12 l-4">
	<?php foreach (($totalriders?:array()) as $item): ?>
    <span>Total Registrations: <?php echo $item['r']; ?></span><br />
	<?php endforeach; ?>
</div>
</div>
</div>
<div class="line">
<div class="margin">
<div class="s-12 l-4">
	<?php foreach (($totalriderschecked?:array()) as $item): ?>
    <span>Total Check-Ins: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
</div>
</div>
</div>
<p><a href="stats">All Stats</a></p>

