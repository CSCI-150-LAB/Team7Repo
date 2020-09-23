<?php
    if(htmlspecialchars($_GET["id"]) != $user->id) {
        return $this->redirect($this->viewHelpers->baseUrl("/User/InstructorProfileEdit/{$currentUser->id}?error={permissiondenied}"));
    }
?>
<form method = 'POST'>
    Department: <br>
	<input type = 'text' name = 'department' value = '$user->department'><br>
	<br>
	<br>
	Preferred Title: <br>
    <input type = 'radio' name = 'name' value = 'Dr.'>
    <?php
        if ($user->name == 'Dr.') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'name' value = 'Professor'>
    <?php        
        if ($user->name == 'Professor') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'name' value = 'Mr.'>
    <?php
        if ($user->name == 'Mr.') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'name' value = 'Mrs.'>
    <?php        
        if ($user->name == 'Mrs.') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'name' value = 'Ms.'>
    <?php
        if ($user->name == 'Ms.') {
            echo "checked = 'checked'";
        }
    ?>
    <br>
	<br>
	Visual Style Usage: <br>
    <input type = 'radio' name = 'visual' value = 'Primarily'>
    <?php
        if ($user->visual == 'primarily') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'visual' value = 'Somewhat'>
    <?php
        if ($user->visual == 'somewhat') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'visual' value = 'Minimal'>
    <?php
        if ($user->visual == 'minimal') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'visual' value = 'Not at all'>
    <?php
        if ($user->visual == 'not at all') {
            echo "checked = 'checked'";
        }
    ?>
    <br>
	<br>
	Auditory Style Usage: <br>
    <input type = 'radio' name = 'auditory' value = 'Primarily'>
    <?php
        if ($user->auditory == 'primarily') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'auditory' value = 'Somewhat'>
    <?php
        if ($user->auditory == 'somewhat') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'auditory' value = 'Minimal'>
    <?php
        if ($user->visual == 'minimal') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'auditory' value = 'Not at all'>
    <?php
        if ($user->auditory == 'not at all') {
            echo "checked = 'checked'";
        }
    ?>
    <br>
	<br>
	Reading and Writing Style Usage: <br>
    <input type = 'radio' name = 'readwrite' value = 'Primarily'>
    <?php
        if ($user->read_write == 'primarily') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'readwrite' value = 'Somewhat'>
    <?php
        if ($user->read_write == 'somewhat') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'readwrite' value = 'Minimal'>
    <?php
        if ($user->read_write == 'minimal') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'readwrite' value = 'Not at all'>
    <?php
        if ($user->read_write == 'not at all') {
            echo "checked = 'checked'";
        }
    ?>
    <br>
	<br>
	Kinesthetic Style Usage: <br>
    <input type = 'radio' name = 'kines' value = 'Primarily'>
    <?php
        if ($user->kines == 'primarily') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'kines' value = 'Somewhat'>
    <?php
        if ($user->kines == 'somewhat') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'kines' value = 'Minimal'>
    <?php
        if ($user->kines == 'minimal') {
            echo "checked = 'checked'";
        }
    ?>
    <input type = 'radio' name = 'kines' value = 'Not at all'>
    <?php
        if ($user->kines == 'not at all') {
            echo "checked = 'checked'";
        }
    ?>
	<br>
	<br>
	<br>
	<input type = 'submit' name = 'save changes' value = 'Save Changes'>
    </form>