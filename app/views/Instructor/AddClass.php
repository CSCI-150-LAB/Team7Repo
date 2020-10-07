<h1>Add a New Class</h1>
<form method = 'POST'>
    <!--Once submitted, save to database by sending to controller-->
    Class Title:
    <input type = 'text' name = 'class'>
    <br>
    <!--Input for new class's title-->
    Class Description:
    <input type = 'text' name = 'description'>
    <!--Input for new class's description, optional-->
    <br>
    Days Class Meets:
    <!--Selection of the days that the class meets-->
    <input type = 'checkbox' name = 'Mon' value = 1> Monday
    <input type = 'checkbox' name = 'Tue' value = 1> Tuesday
    <input type = 'checkbox' name = 'Wed' value = 1> Wednesday
    <input type = 'checkbox' name = 'Thur' value = 1> Thursday
    <input type = 'checkbox' name = 'Fri' value = 1> Friday
    <input type = 'checkbox' name = 'Sat' value = 1> Saturday
    <input type = 'checkbox' name = 'Sun' value = 1> Sunday
    <br>
    Class Start Time:
    <input type='time' name = 'starttime'>
    <!--Input for new class's start time-->
    <br>
    Class Finish Time:
    <input type='time' name = 'endtime'>
    <!--Input for new class's start time-->
    <br>
	<input type = 'submit' name = 'save class' value = 'Save Class'>
</form> <!--Submit button-->