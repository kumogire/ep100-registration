	<h2>Search Results</h2>
	<p><?php foreach (($result?:array()) as $item): ?>
    <span><?php echo $item['LastName']; ?>, <?php echo $item['FirstName']; ?> - <?php echo $item['TicketType']; ?></span><br />
	<?php endforeach; ?>
	</p>

