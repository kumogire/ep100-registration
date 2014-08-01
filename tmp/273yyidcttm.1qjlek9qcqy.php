<h2>Search Results</h2>

<form class="customform" action="updaterider" method="POST">
<?php foreach (($result?:array()) as $item): ?>
<div class="line">
<input type="hidden" name="RiderID[]" value="<?php echo $item['RiderID']; ?>">
<table>
<tbody>
<tr>
<td><strong>First Name</strong></td><td><?php echo $item['FirstName']; ?></td>
<td><strong>Route</strong></td><td><?php echo $item['TicketType']; ?></td>
</tr>
<tr>
<td><strong>Last Name</strong></td><td><?php echo $item['LastName']; ?></td>
<td><strong>Bib #</strong></td><td><input type="text" name="BibNumber" value="<?php echo $item['BibNumber']; ?>"></td>
</tr>
<tr>
<td><strong>Email</strong></td><td><input type="text" name="Email[]" value="<?php echo $item['Email']; ?>"></td>
<td><strong>Confirmation</strong></td><td><?php echo $item['OrderNum']; ?></td>
</tr>
</tbody>
</table>
</div>
<?php endforeach; ?>
<div class="s-12 l-4 right "><button type="submit">Update Rider Information</button></div>

</form>
