<?php echo var_dump($errors) ?>
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
    <input type = 'radio' name = 'Mon' value = 1> Monday
    <input type = 'radio' name = 'Tue' value = 1> Tuesday
    <input type = 'radio' name = 'Wed' value = 1> Wednesday
    <input type = 'radio' name = 'Thur' value = 1> Thursday
    <input type = 'radio' name = 'Fri' value = 1> Friday
    <input type = 'radio' name = 'Sat' value = 1> Saturday
    <input type = 'radio' name = 'Sun' value = 1> Sunday
    <br>
    Class Start Time:
    <select type = 'text' name = 'starthour'>
        <option value = '01'>1</option>
        <option value = '02'>2</option>
        <option value = '03'>3</option>
        <option value = '04'>4</option>
        <option value = '05'>5</option>
        <option value = '06'>6</option>
        <option value = '07'>7</option>
        <option value = '08'>8</option>
        <option value = '09'>9</option>
        <option value = '10'>10</option>
        <option value = '11'>11</option>
        <option value = '12'>12</option>
    </select>:  
    <input type = 'text' name = 'startminute'>
    <input type = 'radio' name = 'start' value = 'AM'> AM
    <input type = 'radio' name = 'start' value = 'PM'> PM
    <!--Input for new class's start time-->
    <br>
    Class Finish Time:
    <select type = 'text' name = 'finhour'>
        <option value = '01'>1</option>
        <option value = '02'>2</option>
        <option value = '03'>3</option>
        <option value = '04'>4</option>
        <option value = '05'>5</option>
        <option value = '06'>6</option>
        <option value = '07'>7</option>
        <option value = '08'>8</option>
        <option value = '09'>9</option>
        <option value = '10'>10</option>
        <option value = '11'>11</option>
        <option value = '12'>12</option>
    </select>: 
    <input type = 'text' name = 'finminute'>
    <input type = 'radio' name = 'fin' value = 'AM'> AM
    <input type = 'radio' name = 'fin' value = 'PM'> PM
    <!--Input for new class's start time-->
    <br>
	<input type = 'submit' name = 'save class' value = 'Save Class'>
</form> <!--Submit button-->