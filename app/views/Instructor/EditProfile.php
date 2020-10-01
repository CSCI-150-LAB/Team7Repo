<form method = 'POST' action = '<?php $this->baseUrl('/Instructor/ProfileEdit') ?>'>
    <!--Once submitted, save to database by sending to controller-->
    Department:
    <input type = 'text' name = 'department' value =".$profile->department.">
    <!--Input for user's department-->
    Preferred Title:
    <input type = 'radio' name = 'name' value = 'Dr.'> Dr.
    <!--Selection of user's preferred title, autoselects if previously chosen-->
    <?php   if($profile->name == 'Dr.') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'name' value = 'Professor'> Professor
    <?php   if($profile->name == 'Professor') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'name' value = 'Mr.'> Mr.
    <?php   if($profile->name == 'Mr.') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'name' value = 'Mrs.'> Mrs.
    <?php   if($profile->name == 'Mrs.') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'name' value = 'Ms.'> Ms.
    <?php   if($profile->name == 'Ms.') {
                echo "checked = 'checked'";
            } ?>
    <br>
	Visual Style Usage:
    <input type = 'radio' name = 'visual' value = 'Primarily'> Primarily
    <!--Selection of user's visual style usage, autoselects if previously chosen-->
    <?php   if($profile->visual == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'visual' value = 'Somewhat'> Somewhat
    <?php   if($profile->visual == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'visual' value = 'Minimal'> Minimal
    <?php   if($profile->visual == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'visual' value = 'Not at all'> Not at all
    <?php   if($profile->visual == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    <br>
	Auditory Style Usage:
    <input type = 'radio' name = 'auditory' value = 'Primarily'> Primarily
    <!--Selection of user's auditory style usage, autoselects if previously chosen-->
    <?php   if($profile->auditory == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'auditory' value = 'Somewhat'> Somewhat
    <?php   if($profile->auditory == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'auditory' value = 'Minimal'> Minimal
    <?php   if($profile->visual == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'auditory' value = 'Not at all'> Not at all
    <?php   if($profile->auditory == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    <br>
	Reading and Writing Style Usage:
    <input type = 'radio' name = 'readwrite' value = 'Primarily'> Primarily
    <!--Selection of user's reading/writing style usage, autoselects if previously chosen-->
    <?php   if($profile->readwrite == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'readwrite' value = 'Somewhat'> Somewhat
    <?php   if($profile->readwrite == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'readwrite' value = 'Minimal'> Minimal
    <?php   if($profile->readwrite == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'readwrite' value = 'Not at all'> Not at all
    <?php   if($profile->readwrite == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    <br>
	Kinesthetic Style Usage:
    <input type = 'radio' name = 'kines' value = 'Primarily'> Primarily  ";
    <!--Selection of user's kinesthetic style usage, autoselects if previously chosen-->
    <?php   if($profile->kines == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'kines' value = 'Somewhat'> Somewhat
    <?php   if($profile->kines == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'kines' value = 'Minimal'> Minimal
    <?php   if($profile->kines == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    <input type = 'radio' name = 'kines' value = 'Not at all'> Not at all
    <?php   if($profile->kines == 'not at all') {
                echo "checked = 'checked'";
            } ?>
	<br>
	<input type = 'submit' name = 'save changes' value = 'Save Changes'>
</form> <!--Submit button-->