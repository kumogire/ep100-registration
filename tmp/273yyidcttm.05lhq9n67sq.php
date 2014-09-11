

<form class="customform" action="transferrider" method="POST">
<?php foreach (($rider?:array()) as $item): ?>

<h2>Tranfer Rider - <?php echo $item['LastName']; ?>, <?php echo $item['FirstName']; ?> </h2>
<h3>To New Rider:</h3>
<div class="line">
<input type="hidden" name="TransferFrom" value="<?php echo $item['RiderID']; ?>">
<table>
<tbody>
<tr>
<td><strong>First Name</strong></td><td><input type="text" name="FirstName" value=""></td>
<td><strong>Route</strong></td><td><?php echo $item['TicketType']; ?> <input type="hidden" name="TicketType" value="<?php echo $item['TicketType']; ?>"></td>
</tr>
<tr>
<td><strong>Last Name</strong></td><td><input type="text" name="LastName" value=""></td>
<td><strong>Bib #</strong></td><td><input type="text" name="BibNumber" value=""></td>
</tr>
<tr>
<td><strong>Email</strong></td><td><input type="text" name="Email" value=""></td>
<td><strong>Confirmation</strong></td><td><?php echo $item['OrderNum']; ?></td>
<input type="hidden" name="OrderNum" value="<?php echo $item['OrderNum']; ?>">
</tr>
<tr>
<td><strong>Emergency Contact</strong></td><td><input type="text" name="EmergencyContact" value=""></td>
<td><strong>Cycle Level</strong></td>
<td>
<select name="CycleLevel">
<option value="Beginner">Beginner</option>
<option value="Intermediate">Intermediate</option>
<option value="Advanced">Advanced</option>
</select>
</td>
</tr>
<tr>
<td><strong>Emergency Number</strong></td><td><input type="text" name="EmergencyNumber" value=""></td>
<td><strong>Rotarian?</strong></td>
<td>
<select name="Rotarian">
<option value="No">No</option>
<option value="Yes">Yes</option>
</select>
</td>
</tr>
<tr>
<td><strong>Waiver</strong></td>
<td>
<select name="Waiver">
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
<td><strong>Notes</strong></td><td colspan="3"><textarea name="RiderNotes"></textarea></td>
</tr>
</tbody>
</table>
</div>
<?php endforeach; ?>
<div class="s-12 l-4 right "><button type="submit">Create Transfer</button></div>

</form>
