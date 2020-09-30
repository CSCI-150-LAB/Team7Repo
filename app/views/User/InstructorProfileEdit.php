<?php
    echo    "<form method = 'POST' action = '".$this->baseUrl('/Instructor/InstructorProfileEdit')."'>
            Department:
            <input type = 'text' name = 'department' value =".$user->department."><br>
	        <br>
            Preferred Title:
            <input type = 'radio' name = 'name' value = 'Dr.'> Dr.  ";
            if($user->name == 'Dr.') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Professor'> Professor  ";
            if($user->name == 'Professor') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Mr.'> Mr.  ";
            if($user->name == 'Mr.') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Mrs.'> Mrs.  ";
            if($user->name == 'Mrs.') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'name' value = 'Ms.'> Ms.";
            if($user->name == 'Ms.') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Visual Style Usage:
            <input type = 'radio' name = 'visual' value = 'Primarily'> Primarily  ";
            if($user->visual == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'visual' value = 'Somewhat'> Somewhat  ";
            if($user->visual == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'visual' value = 'Minimal'> Minimal  ";
            if($user->visual == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'visual' value = 'Not at all'> Not at all";
            if($user->visual == 'not at all') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Auditory Style Usage:
            <input type = 'radio' name = 'auditory' value = 'Primarily'> Primarily  ";
            if($user->auditory == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'auditory' value = 'Somewhat'> Somewhat  ";
            if($user->auditory == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'auditory' value = 'Minimal'> Minimal  ";
            if($user->visual == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'auditory' value = 'Not at all'> Not at all";
            if($user->auditory == 'not at all') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Reading and Writing Style Usage:
            <input type = 'radio' name = 'readwrite' value = 'Primarily'> Primarily  ";
            if($user->read_write == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'readwrite' value = 'Somewhat'> Somewhat  ";
            if($user->read_write == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'readwrite' value = 'Minimal'> Minimal  ";
            if($user->read_write == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'readwrite' value = 'Not at all'> Not at all";
            if($user->read_write == 'not at all') {
                echo "checked = 'checked'";
            }
    echo    "<br>
	        Kinesthetic Style Usage:
            <input type = 'radio' name = 'kines' value = 'Primarily'> Primarily  ";
            if($user->kines == 'primarily') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'kines' value = 'Somewhat'> Somewhat  ";
            if($user->kines == 'somewhat') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'kines' value = 'Minimal'> Minimal  ";
            if($user->kines == 'minimal') {
                echo "checked = 'checked'";
            }
    echo    "<input type = 'radio' name = 'kines' value = 'Not at all'> Not at all";
            if($user->kines == 'not at all') {
                echo "checked = 'checked'";
            }
	echo    "<br>
	        <input type = 'submit' name = 'save changes' value = 'Save Changes'>
        </form>";
?>