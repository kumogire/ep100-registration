	<h2>Rider Stats</h2>
	
	<p><?php foreach (($total10mi?:array()) as $item): ?>
    <span>10 milers - Total Registrations: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><?php foreach (($total10michecked?:array()) as $item): ?>
    <span>10 milers - Total Check-Ins: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><?php foreach (($total50mi?:array()) as $item): ?>
    <span>50 milers - Total Registrations: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><?php foreach (($total50michecked?:array()) as $item): ?>
    <span>50 milers - Total Check-Ins: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><?php foreach (($total100mi?:array()) as $item): ?>
    <span>100 milers - Total Registrations: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><?php foreach (($total100michecked?:array()) as $item): ?>
    <span>100 milers - Total Check-Ins: <?php echo $item['c']; ?></span><br />
	<?php endforeach; ?>
	</p>
	<p><a href="search">Back to Home</a></p>

