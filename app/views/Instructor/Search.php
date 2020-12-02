<?php
	/** @var User[] $results */
	$this->pageTitle('Search Instructors');
?>

<h1>Instructor Search</h1>

<form class="instructor-search" method="GET" action="<?php echo $this->baseUrl('/Instructor/Search') ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" placeholder="Search Text" id="search-txt" name="search" aria-label="Search Text" value="<?php echo $this->escapeHtml($search) ?>">
		<div class="input-group-append">
			<button class="btn btn-cardinalred" type="submit">Search</button>
		</div>
	</div>
</form>

<?php if ($search !== '') : ?>
	<h2>Search Results</h2>
	<?php if (count($results)) : ?>
		<?php foreach ($results as $instructorUser) : ?>
			<?php
				$profile = $instructorUser->getProfileModel();
			?>
			<div class="instructor-listing my-4 px-3 py-2 border tbl-background">
				<div class="d-flex align-items-center justify-content-between">
					<h3><a href="<?php echo $instructorUser->getProfileUrl() ?>"><?php echo $profile->name . ' ' . $instructorUser->getFullName() ?></a></h3>
					<p class="text-right">
						<?php echo $instructorUser->email ?><br><?php echo $profile->department ?>
					</p>
				</div>

				<table class="table table-sm table-striped pl-5 tbl-background">
					<thead>
						<tr>
							<th>Class</th>
							<th>Description</th>
							<th>Days/Times</th>
							<th>Student Enrollment</th>
						</tr>
					</thead>
					<tbody>
						<?php $instructorClasses = InstructorClasses::find('instructorid = :0:', $instructorUser->id); ?>
						<?php foreach ($instructorClasses as $class) : ?>
							<tr>
								<td><?php echo $class->class ?></td>
								<td><?php echo $class->description ?></td>
								<td><?php echo $class->getClassTimeString() ?></td>
								<td><?php $students = studentClasses::find("classId =:0:", $class->classid); echo count($students) ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endforeach; ?>
	<?php else : ?>
		No results found. Please try a different search.
	<?php endif; ?>
<?php endif; ?>