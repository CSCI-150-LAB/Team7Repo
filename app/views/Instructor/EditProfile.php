<form method = 'POST'>
    <!--Once submitted, save to database by sending to controller-->
    Department:
    <input type = 'text' name = 'department' value = <?php $profile->department ?>>
    <br>
    <!--Input for user's department-->
    Preferred Title:
    <!--Selection of user's preferred title, autoselects if previously chosen-->
    <input type = 'radio' name = 'name' value = 'Dr.'
    <?php   if($profile->name == 'Dr.') {
                echo "checked = 'checked'";
            } ?>
    > Dr.
    <input type = 'radio' name = 'name' value = 'Professor'
    <?php   if($profile->name == 'Professor') {
                echo "checked = 'checked'";
            } ?>
    > Professor
    <input type = 'radio' name = 'name' value = 'Mr.'
    <?php   if($profile->name == 'Mr.') {
                echo "checked = 'checked'";
            } ?>
    > Mr.
    <input type = 'radio' name = 'name' value = 'Mrs.'
    <?php   if($profile->name == 'Mrs.') {
                echo "checked = 'checked'";
            } ?>
    > Mrs.
    <input type = 'radio' name = 'name' value = 'Ms.'
    <?php   if($profile->name == 'Ms.') {
                echo "checked = 'checked'";
            } ?>
    > Ms.
    <br>
	Visual Style Usage:
    <!--Selection of user's visual style usage, autoselects if previously chosen-->
    <input type = 'radio' name = 'visual' value = 'Primarily'
    <?php   if($profile->visual == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    > Primarily
    <input type = 'radio' name = 'visual' value = 'Somewhat'
    <?php   if($profile->visual == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    > Somewhat
    <input type = 'radio' name = 'visual' value = 'Minimal'
    <?php   if($profile->visual == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    > Minimal
    <input type = 'radio' name = 'visual' value = 'Not at all'
    <?php   if($profile->visual == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    > Not at all
    <br>
	Auditory Style Usage:
    <!--Selection of user's auditory style usage, autoselects if previously chosen-->
    <input type = 'radio' name = 'auditory' value = 'Primarily'
    <?php   if($profile->auditory == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    > Primarily
    <input type = 'radio' name = 'auditory' value = 'Somewhat'
    <?php   if($profile->auditory == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    > Somewhat
    <input type = 'radio' name = 'auditory' value = 'Minimal'
    <?php   if($profile->visual == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    > Minimal
    <input type = 'radio' name = 'auditory' value = 'Not at all'
    <?php   if($profile->auditory == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    > Not at all
    <br>
	Reading and Writing Style Usage:
    <!--Selection of user's reading/writing style usage, autoselects if previously chosen-->
    <input type = 'radio' name = 'readwrite' value = 'Primarily'
    <?php   if($profile->readwrite == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    > Primarily
    <input type = 'radio' name = 'readwrite' value = 'Somewhat'
    <?php   if($profile->readwrite == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    > Somewhat
    <input type = 'radio' name = 'readwrite' value = 'Minimal'
    <?php   if($profile->readwrite == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    > Minimal
    <input type = 'radio' name = 'readwrite' value = 'Not at all'
    <?php   if($profile->readwrite == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    > Not at all
    <br>
    Kinesthetic Style Usage:
    <!--Selection of user's kinesthetic style usage, autoselects if previously chosen-->
    <input type = 'radio' name = 'kines' value = 'Primarily'
    <?php   if($profile->kines == 'primarily') {
                echo "checked = 'checked'";
            } ?>
    > Primarily
    <input type = 'radio' name = 'kines' value = 'Somewhat'
    <?php   if($profile->kines == 'somewhat') {
                echo "checked = 'checked'";
            } ?>
    > Somewhat
    <input type = 'radio' name = 'kines' value = 'Minimal'
    <?php   if($profile->kines == 'minimal') {
                echo "checked = 'checked'";
            } ?>
    > Minimal
    <input type = 'radio' name = 'kines' value = 'Not at all'
    <?php   if($profile->kines == 'not at all') {
                echo "checked = 'checked'";
            } ?>
    > Not at all
	<br>
	<input type = 'submit' name = 'save changes' value = 'Save Changes'>
</form> <!--Submit button-->