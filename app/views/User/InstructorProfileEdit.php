<?php
    echo    "<form method = 'POST' action = '".$this->baseUrl('/Instructor/InstructorProfileEdit')."'>
            Department:
            <input type = 'text' name = 'department' value =".$profile->department."><br>
	        <br>
            Preferred Title:
            <input type = 'radio' name = 'name' value = 'Dr.'> Dr.  ";
            if($profile->name == 'Dr.') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Professor'> Professor  ";
            if($profile->name == 'Professor') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Mr.'> Mr.  ";
            if($profile->name == 'Mr.') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Mrs.'> Mrs.  ";
            if($profile->name == 'Mrs.') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Ms.'> Ms.";
            if($profile->name == 'Ms.') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Visual Style Usage:
            <input type = 'radio' name = 'visual' value = 'Primarily'> Primarily  ";
            if($profile->visual == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'visual' value = 'Somewhat'> Somewhat  ";
            if($profile->visual == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'visual' value = 'Minimal'> Minimal  ";
            if($profile->visual == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'visual' value = 'Not at all'> Not at all";
            if($profile->visual == 'not at all') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Auditory Style Usage:
            <input type = 'radio' name = 'auditory' value = 'Primarily'> Primarily  ";
            if($profile->auditory == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'auditory' value = 'Somewhat'> Somewhat  ";
            if($profile->auditory == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'auditory' value = 'Minimal'> Minimal  ";
            if($profile->visual == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'auditory' value = 'Not at all'> Not at all";
            if($profile->auditory == 'not at all') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Reading and Writing Style Usage:
            <input type = 'radio' name = 'readwrite' value = 'Primarily'> Primarily  ";
            if($profile->read_write == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'readwrite' value = 'Somewhat'> Somewhat  ";
            if($profile->read_write == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'readwrite' value = 'Minimal'> Minimal  ";
            if($profile->read_write == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'readwrite' value = 'Not at all'> Not at all";
            if($profile->read_write == 'not at all') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Kinesthetic Style Usage:
            <input type = 'radio' name = 'kines' value = 'Primarily'> Primarily  ";
            if($profile->kines == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'kines' value = 'Somewhat'> Somewhat  ";
            if($profile->kines == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'kines' value = 'Minimal'> Minimal  ";
            if($profile->kines == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'kines' value = 'Not at all'> Not at all";
            if($profile->kines == 'not at all') {
                echo "checked = 'checked'";
            }
	echo    "<br>
	        <input type = 'submit' name = 'save changes' value = 'Save Changes'>
        </form>";
?>