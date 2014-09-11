<h2>Search Results for "<?php echo $search; ?>"</h2>
<form class="customform" action="updategroup" method="POST">

<div class="line">

<table>
<thead>
<tr>
<th width="100">Bib #</th>
<th>Confirmation</th>
<th>Route</th>
<th>Last Name</th>
<th>First Name</th>
<th width="200">Email</th>
<th>Past Rides</th>
<th>Transfer</th>
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
<td><?php echo $item['Email']; ?></td>
<td><?php echo $item['2011Rider']; ?>  <?php echo $item['2012Rider']; ?>  <?php echo $item['2013Rider']; ?></td>
<td><a href="transfer/<?php echo $item['RiderID']; ?>"><i class="icon-random icon2x right padding" alt="Transfer"></i></a></td>
<td><a href="details/<?php echo $item['RiderID']; ?>"><i class="icon-share icon2x right padding" alt="Edit Rider"></i></a></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>
</form>
