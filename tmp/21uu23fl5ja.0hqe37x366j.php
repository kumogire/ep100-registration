	<h2>Rider Check-in</h2>
	<div class="line">
	<div class="margin-bottom">	
	</div>
	</div>
<div class="line">	
<div class="margin-bottom">	
	<div class="s-12 l-8 center"><h4>Search registrations by Confirmation Code, First Name, Last Name:</h4></div>
</div>
</div>
<form class="customform" action="results" method="POST">
<div class="line">
<div class="center margin-bottom">
<div class="s-12 l-8 center margin-bottom">
<div class="s-8 l-8 left"><input type="text" name="id" autofocus></div>
<div class="s-4 l-4 right"><button type="submit">Search</button></div>
</div>
</div>
</div>

</form>
<div class="line">
<?php if ($message): ?>
	<div class="line center">
		<div class="margin-bottom">
			<div class="s-12 l-4 center"><strong><?php echo $message; ?></strong></div>
		</div>
	</div>
<?php endif; ?>
<div class="margin-bottom">
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


