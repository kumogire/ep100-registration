<h2>Rider Details</h2>

<form class="customform" action="updaterider" method="POST">
<?php foreach (($rider?:array()) as $item): ?>
<div class="line">
<input type="hidden" name="RiderID" value="<?php echo $item['RiderID']; ?>">
<table>
<tbody>
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
<td><strong>Confirmation</strong></td><td><?php echo $item['OrderNum']; ?></td>
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
<td><strong>Past Rides</strong></td><td><?php echo $item['2011Rider']; ?>  <?php echo $item['2012Rider']; ?>  <?php echo $item['2013Rider']; ?></td>
</tr>
<tr>
<td><strong>Transferred?</strong></td><td><?php echo $item['TransferTo']; ?></td>
<td><strong>Transferee?</strong></td><td><?php echo $item['TransferFrom']; ?></td>
</tr>
<tr>
<td><strong>Check In Date</strong></td><td><?php echo $item['CheckinDate']; ?></td>
<td><strong>Last Updated?</strong></td><td><?php echo $item['LastUpdate']; ?></td>
</tr>
<tr>
<td><strong>Notes</strong></td><td><textarea name="RiderNotes"><?php echo $item['RiderNotes']; ?></textarea></td>
<td><strong>New Registration?</strong></td><td><?php echo $item['NewRider']; ?></td>
</tr>
</tbody>
</table>
</div>
<?php endforeach; ?>
<div class="s-12 l-4 right "><button type="submit">Update Rider Information</button></div>

</form>
