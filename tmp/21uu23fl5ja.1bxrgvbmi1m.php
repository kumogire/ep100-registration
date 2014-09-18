<h2>Rider Results for "<?php echo $search; ?>"</h2>

<div class="line">

<table>
<thead>
<tr>
<th width="100">Bib #</th>
<th>Confirmation</th>
<th>Route</th>
<th>Last Name</th>
<th>First Name</th>
<th width="200">Cell Phone</th>
<th>Emergency Contact</th>
<th>Emergency Number</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php foreach (($result?:array()) as $item): ?>

<tr>
<td><?php echo $item['BibNumber']; ?></td>
<td><a href="details/<?php echo $item['RiderID']; ?>"><?php echo $item['OrderNum']; ?></a></td>
<td><?php echo $item['TicketType']; ?></td>
<td><?php echo $item['LastName']; ?></td>
<td><?php echo $item['FirstName']; ?></td>
<td><?php echo $item['CellPhone']; ?></td>
<td><?php echo $item['EmergencyContact']; ?></td>
<td><?php echo $item['EmergencyNumber']; ?></td>
<td><a href="details/<?php echo $item['RiderID']; ?>"><i class="icon-share icon2x right padding" alt="Edit Rider"></i></a></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>

