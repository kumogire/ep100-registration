

<form class="customform" action="updaterider" method="POST">
<?php foreach (($rider?:array()) as $item): ?>

<h2>Rider Details - <?php echo $item['LastName']; ?>, <?php echo $item['FirstName']; ?> 
<?php if ($item['TransferFrom'] != ''): ?> *Transfer*<?php endif; ?>
<?php if ($item['TransferTo'] != ''): ?> *Ticket Transfered*<?php endif; ?></h2>
<?php if ($item['CheckinDate'] <> '0000-00-00 00:00:00'): ?>
<div class="line left">
	<div class="margin-bottom">
		<div class="s-12 l-4 left"><strong>Check In Date/Time: <?php echo $item['CheckinDate']; ?></strong></div>
	</div>
</div>
<?php endif; ?>
<?php if ($item['LastUpdate'] <> ''): ?>
<div class="line left">
	<div class="margin-bottom">
		<div class="s-12 l-4 left"><strong>Last Updated: <?php echo $item['LastUpdate']; ?></strong></div>
	</div>
</div>
<?php endif; ?>
<?php if ($item['NewRider'] == 'Yes'): ?>
<div class="line left">
	<div class="margin-bottom">
		<div class="s-12 l-4 left"><strong>NEW RIDER REGISTRATION (On-site)</strong></div>
	</div>
</div>
<?php endif; ?>
<div class="line">
<input type="hidden" name="RiderID" value="<?php echo $item['RiderID']; ?>">
<table>
<tbody>
<tr>
<td><strong>Confirmation</strong></td><td colspan="3"><?php echo $item['OrderNum']; ?></td>
</tr>
<tr>
<td><strong>First Name</strong></td><td><input type="text" name="FirstName" value="<?php echo $item['FirstName']; ?>"></td>
<td><strong>Route</strong></td><td><?php echo $item['TicketType']; ?></td>
</tr>
<tr>
<td><strong>Last Name</strong></td><td><input type="text" name="LastName" value="<?php echo $item['LastName']; ?>"></td>
<td><strong>Bib #</strong></td><td><input type="text" name="BibNumber" value="<?php echo $item['BibNumber']; ?>"></td>
</tr>
<tr>
<td><strong>Email</strong></td><td><input type="text" name="Email" value="<?php echo $item['Email']; ?>"></td>
<td><strong>Cell Phone</strong></td><td><?php echo $item['CellPhone']; ?></td>
</tr>
<tr>
<td><strong>Emergency Contact</strong></td><td><input type="text" name="EmergencyContact" value="<?php echo $item['EmergencyContact']; ?>"></td>
<td><strong>Cycle Level</strong></td><td><?php echo $item['CycleLevel']; ?></td>
</tr>
<tr>
<td><strong>Emergency Number</strong></td><td><input type="text" name="EmergencyNumber" value="<?php echo $item['EmergencyNumber']; ?>"></td>
<td><strong>Rotarian?</strong></td><td><?php echo $item['Rotarian']; ?></td>
</tr>
<tr>
<td><strong>Waiver</strong></td><td><?php echo $item['Waiver']; ?></td>



<td><strong>Past Rides</strong></td><td>
<?php if ($item['2011Rider'] == 'No'): ?>
    
        <?php echo $item['2011Rider'] = ''; ?>
    
    <?php else: ?>
        <?php echo $item['2011Rider'] = '2011'; ?>
    
<?php endif; ?>
<?php if ($item['2012Rider'] == 'No'): ?>
    
        <?php echo $item['2012Rider'] = ''; ?>
    
    <?php else: ?>
        <?php echo $item['2012Rider'] = '2012'; ?>
    
<?php endif; ?>
<?php if ($item['2013Rider'] == 'No'): ?>
    
        <?php echo $item['2013Rider'] = ''; ?>
    
    <?php else: ?>
        <?php echo $item['2013Rider'] = '2013'; ?>
    
<?php endif; ?>

</td>
</tr>
<tr>
<td><strong>Transferred?</strong></td>
<?php if ($item['TransferTo'] != ''): ?>
    
<td><a href="details/<?php echo $item['TransferTo']; ?>">Ticket Transferred To -></a></td>
    
	<?php else: ?>
<td>&nbsp;</td>
    
<?php endif; ?>
<td><strong>Transferee?</strong></td>
<?php if ($item['TransferFrom'] != ''): ?>
    
 <td><a href="details/<?php echo $item['TransferFrom']; ?>">Ticket Transferred From -></a></td>
    
    <?php else: ?>
<td>&nbsp;</td>
    
<?php endif; ?>
</tr>
<tr>

<td><strong>Notes</strong></td><td colspan="3"><textarea name="RiderNotes"></textarea></td>
</tr>
</tbody>
</table>
</div>
<?php endforeach; ?>
<div class="s-12 l-4 right "><button type="submit">Update Rider Information</button></div>

</form>
