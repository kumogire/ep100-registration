<h2>Volunteer Groups</h2>
<h4><?php echo $count; ?> records returned</h4>
<form class="customform" action="updategroup" method="POST">

<div class="line">
<table>
<thead>
<tr>

<td> Volunteer Group Name</td>
<td> Volunteers</td>
<td> Volunteers Checked In</td>
<td> % Checked In</td>
<!--
<th width="100">Bib #</th>
<th>Confirmation</th>
<th>Route</th>
<th>Last Name</th>
<th>First Name</th>
<th width="200">Email</th>
<th>Past Rides</th>
<th>Transfer</th>
<th>Edit</th>
-->
</tr>
</thead>
<tbody>
<?php foreach (($result?:array()) as $item): ?>

<tr>

<td><?php echo $item['VolGroup']; ?></td>
<td><?php echo @$volnum['']; ?></td>
<td></td>
<td></td>

<?php endforeach; ?>

</tbody>
</table>

</div>
</form>
