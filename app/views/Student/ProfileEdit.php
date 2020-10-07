<form method="POST">
	<h1>Student edit page</h1>
    <input type="text" name="major" value="<?php echo $this->escapeHtml($profile->studentMajor) ?>">
    <label for="studentMajor">Enter your major</label>
    <br>
    <input type="text" name="learningStyle">
    <label for="studentMajor">Enter your preferred learning style</label>
    <br>
	<button type="submit" class="btn btn-primary">Save Changes</button>
</form>