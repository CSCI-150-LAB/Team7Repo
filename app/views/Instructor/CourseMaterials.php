<?php 
    $this->papgeTitle("CourseMaterials"); 
?>
<!-- TODO: Update add file link --> 
<a class="btn btn-secondary float-right text-white" href= "">Add file</a> <br> </br>

<div class="table-responsive">
	<table class="table table-bordered tbl-background">
		<thead> 
			<tr> <!-- TODO: Fixed cell width --> 
				<th scope="col"> Name <i class="fas fa-sort-down"></th>
				<th scope="col"> Date Created <i class="fas fa-sort-down"></th>
				<th scope="col"> Modified By <i class="fas fa-sort-down"></th>
			</tr>
		</thead>
		<tbody>
				<tr> <!-- TODO: Link actual materials, loop through database --> 
					<td> <a href = ""> Ch1.pdf </a></td>
                    <td> 02/08/20</td>
                    <td> Alex Lui</td>
				</tr>
		</tbody>
	</table>
</div>