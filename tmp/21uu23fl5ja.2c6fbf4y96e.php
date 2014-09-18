<h2>Add New Rider</h2>

<form class="customform" action="addrider" method="POST">
<input type="hidden" name="NewRider" value="Yes">
<div class="line">
<table>
<tbody>
<tr>
<td><strong>First Name</strong></td><td><input type="text" name="FirstName" value=""></td>
<td><strong>Route</strong></td>
<td>
<select name="TicketType">
<option value="EP100 150K (93.2 miles)">EP100 150K (93.2 miles)</option>
<option value="EP100 50 Mile">EP100 50 Mile</option>
<option value="EP100 10 Mile">EP100 10 Mile</option>
<option value="EP100 10 Mile - Child Under 10 Years Old">EP100 10 Mile - Child Under 10 Years Old</option>
<option value="EP100 10 Mile - Child Under 5 Years Old">EP100 10 Mile - Child Under 5 Years Old</option>
</select>
</td>
</tr>
<tr>
<td><strong>Last Name</strong></td><td><input type="text" name="LastName" value=""></td>
<td><strong>Bib #</strong></td><td><input type="text" name="BibNumber" value=""></td>
</tr>
<tr>
<td><strong>Email</strong></td><td><input type="text" name="Email" value=""></td>
<td><strong>Cell Phone</strong></td>
<td><input type="text" name="CellPhone" value=""></td>
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
<td colspan="3">
<select name="Waiver">
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
</tr>
<tr>
<td><strong>Notes</strong></td><td colspan="3"><textarea name="RiderNotes"></textarea></td>
</tr>
</tbody>
</table>
</div>

<div class="s-12 l-4 right "><button type="submit">Add Rider </button></div>

</form>
