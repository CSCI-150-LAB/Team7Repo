<form method="POST">
	<?php if (count($errors)) : ?>
		<ul class="error-list">
		<?php foreach ($errors as $errorMsg) : ?>
			<li><?php echo $errorMsg ?></li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<!--Initialize form-->
	First Name: <br>
	<input type="text" name="first">
	<!--Input for first name is text entry stored as 'first'-->
	<span style="color:red">* <?php echo $firstError; ?> </span>
	<!--Output the appropriate error message (if there is one)-->
	<br>
	<br>
	Last Name: <br>
	<input type="text" name="last">
	<!--Input for last name is text entry stored as 'last'-->
	<span style="color:red">* <?php echo $lastError; ?> </span>
	<!--Output the appropriate error message (if there is one)-->
	<br>
	<br>
	Email: <br>
	<input type="text" name="email">
	<!--Input for email is text entry stored as 'email'-->
	<span style="color:red">* <?php echo $emailError; ?> </span>
	<!--Output the appropriate error message (if there is one)-->
	<br>
	<br>
	Password:<br>
	<!--Input for password is of type password stored as 'pass'-->
	<input type="password" name="pass">
	<!--Type password allows for the password to be hidden-->
	<span style="color:red">* <?php echo $passError; ?> </span>
	<!--Output the appropriate error message (if there is one)-->
	<br>
	<br>
	Role:
	<!--Input for role is a radio option stored as 'role'-->
	<input type="radio" name="role" value="student">Student
	<!--The first option is to set the role value to 'student'-->
	<input type="radio" name="role" value="professor">Professor
	<!--The second option is to set the role value to 'professor'-->
	<input type="radio" name="role" value="admin">Admin
	<!--The last option is to set the role value to 'admin'-->
	<span style="color:red">* <?php echo $roleError; ?> </span>
	<!--Output the appropriate error message (if there is one)-->
	<br>
	<br>
	<br>
	<input type="submit" name="submit" value="Submit">
	<!--Create a submit button to complete the form-->
</form>