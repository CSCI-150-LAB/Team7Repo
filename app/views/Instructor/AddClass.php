<?php  ?>
<h1>Add a New Class</h1>

<form method="POST">
	<div class="form-group">
		<label for="class">Class Title</label>
		<input type="text" class="form-control <?php echo !empty($errors['class']) ? 'is-invalid' : '' ?>" id="class" name="class" placeholder="Math 76">
		<?php if (!empty($errors['class'])) : ?>
			<div class="invalid-feedback">
				<?php echo $errors['class'] ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="form-group">
		<label for="description">Class Description</label>
		<input type="text" class="form-control <?php echo !empty($errors['description']) ? 'is-invalid' : '' ?>" id="description" name="description" placeholder="2nd semester calculus">
		<?php if (!empty($errors['description'])) : ?>
			<div class="invalid-feedback">
				<?php echo $errors['description'] ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="form-group checkbox-group">
		<label class="d-block">Days Class Meets</label>
		<?php $i = -1; foreach (InstructorClasses::dayMap as $field => $_) : $i++; ?>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="<?php echo $field ?>" name="<?php echo $field ?>" value="1">
			<label class="form-check-label" for="<?php echo $field ?>"><?php echo $field ?></label>
		</div>
		<?php endforeach; ?>
		<?php if (!empty($errors['days'])) : ?>
			<div class="invalid-feedback">
				<?php echo $errors['days'] ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="starttime">Class Start Time</label>
			<input type="time" class="form-control <?php echo !empty($errors['starttime']) ? 'is-invalid' : '' ?>" id="starttime" name="starttime">
			<?php if (!empty($errors['starttime'])) : ?>
				<div class="invalid-feedback">
					<?php echo $errors['starttime'] ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="form-group col-md-6">
			<label for="endtime">Class Finish Time</label>
			<input type="time" class="form-control <?php echo !empty($errors['endtime']) ? 'is-invalid' : '' ?>" id="endtime" name="endtime">
			<?php if (!empty($errors['endtime'])) : ?>
				<div class="invalid-feedback">
					<?php echo $errors['endtime'] ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Save Class</button>
</form>