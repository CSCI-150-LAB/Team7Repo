<form method="POST">
	<h1>Student edit page</h1>
    <input type="text" id="major" name="major" value="<?php echo $this->escapeHtml($profile->studentMajor) ?>">
    <label for="studentMajor">Enter your major</label>
    <br>
	<button type="submit" class="btn btn-primary">Save Student</button>
</form>