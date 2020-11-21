<form method="POST">
	<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputfirst">First Name</label>
	  <span style="color:red">* <?php echo $firstError; ?> </span>
	  <input type="text" name = "first" class="form-control" id="inputfirst" placeholder="First">
    </div>
    <div class="form-group col-md-6">
      <label for="inputlast">Last Name</label>
	  <span style="color:red">* <?php echo $lastError; ?> </span>
	  <input type="text" name = "last" class="form-control" id="inputlast" placeholder="Last">
    </div>
  </div>
  <div class="form-group">
    <label for="inputemail">Email</label>
	<span style="color:red">* <?php echo $emailError; ?> </span>
    <input type="text" name = "email" class="form-control" id="inputemail" placeholder="user@csufresno.edu">
  </div>
  <div class="form-group">
    <label for="inputpass">Password</label>
	<span style="color:red">* <?php echo $passError; ?> </span>
	<input type="password" name = "pass" class="form-control" id="inputpass">
  </div>		

	<br>
	Role
	<span style="color:red">* <?php echo $roleError; ?> </span>
	<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="student">
	<label class="form-check-label" for="inlineRadio1">Student</label>

    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="instructor">
	<label class="form-check-label" for="inlineRadio2">Instructor</label>

    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="role" id="inlineRadio3" value="admin">
	<label class="form-check-label" for="inlineRadio3">Admin</label>

    </div>

	<br>
	<br>
	<br>
	<input type="submit" name="submit" value="Submit">

</form>

