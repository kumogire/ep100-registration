<h2>Search Results for "<?php echo $search; ?>"</h2>
<h4><?php echo $count; ?> records returned</h4>
<form class="customform" action="updategroup" method="POST">

<div class="line">
<div class="s-12 l-4 right "><button type="submit">Check In Guests</button></div>
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
<td><input type="text" name="BibNumber[]" value="<?php echo $item['BibNumber']; ?>"><input type="hidden" name="RiderID[]" value="<?php echo $item['RiderID']; ?>"></td>
<td><a href="details/<?php echo $item['RiderID']; ?>"><?php echo $item['OrderNum']; ?></a></td>
<td><?php echo $item['TicketType']; ?></td>
<td><?php echo $item['LastName']; ?></td>
<td><?php echo $item['FirstName']; ?></td>
<td><input type="text" name="Email[]" value="<?php echo $item['Email']; ?>"></td>
<td>
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
<td><a href="transfer/<?php echo $item['RiderID']; ?>"><i class="icon-random icon2x right padding" alt="Transfer"></i></a></td>
<td><a href="details/<?php echo $item['RiderID']; ?>"><i class="icon-share icon2x right padding" alt="Edit Rider"></i></a></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>
</form>
