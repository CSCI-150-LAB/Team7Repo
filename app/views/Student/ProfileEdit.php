
<form method="POST">
	<h1>Edit your profile</h1>
    <input type="text" name="major" value="<?php echo $this->escapeHtml($profile->studentMajor) ?>">
    <label for="studentMajor">Enter your major</label>
    <br>
    <input type="text" name="learningStyle" value="<?php echo $this->escapeHtml($profile->learningStyle) ?>">
    <label for="studentMajor">Enter your preferred learning style</label>
   
    <br>
    <input type="range" name="visual" id="visual" min="1" max="10" value="<?php echo $profile->visual ?>">
    <label for="visual">How often do you prefer visual learning tools?</label> <b><span id="visualvalue" style="color:red;"></span></b>
    
    <br>
    <input type="range" name="audio" id="audio" min="1" max="10" value="<?php echo $profile->audio ?>">
    <label for="audio">How often do you prefer audio learning tools?</label> <b><span  id="audiovalue"style="color:red;"></span></b>
    <br>
    <input type="range" name="kinesthetic" id="kinesthetic" min="1" max="10" value="<?php echo $profile->kinesthetic ?>">
    <label for="kinesthetic">How often do you prefer kinesthetic learning tools?</label> <b><span  id="kinestheticvalue" style="color:red;"></span></b>
    <br>
    <input type="range" name="readingwriting" id="readingwriting" min="1" max="10" value="<?php echo $profile->reading_writing ?>">
    <label for="readingwriting">How often do you prefer reading/writing learning tools?</label> <b><span  id="readingwritingvalue" style="color:red;"></span></b>
    <br>

    
    
    <label for="visual-tools">Visual tools</label>
    <select name="visual-tools" id="visual-tools">
        <option value="Charts/Diagrams">Charts/Diagrams</option>
        <option value="Video-Presentation">Video Presentation </option>
        <option value="Powerpoint">Powerpoint </option>
        <option value="Visual-Demonstration">Visual Demonstrations </option>
    </select>
    <br>

    <label for="audio-tools">Audio tools</label>
    <select name="audio-tools" id="audio-tools">
        <option value="Lecture">Lecture in person</option>
        <option value="Storytelling">Recorded lectures / audio books </option>
    </select>
    <br>

    <label for="kinesthetic-tools">Kinesthetic tools</label>
    <select name="kinesthetic-tools" id="kinesthetic-tools">
        <option value="Projects/labs">Projects/Labs</option>
        <option value="Group-activities">Group Activities </option>
        <option value="Hands-on-activities">Hands on Activities </option>
        <option value="Physical-activities">Physical Activities </option>
    </select>
    <br>

    <label for="rw-tools">Reading/Writing tools</label>
    <select name="rw-tools" id="rw-tools">
        <option value="Articles-resources">Reading Articles and Resources</option>
        <option value="Textbook/notes">Reading textbook and Note Taking </option>
    </select>
    <br>
    

   

    
    <br>
	<button type="submit" class="btn btn-primary">Save Changes</button>
</form>

<script>

    document.querySelectorAll('input[type="range"]').forEach(function(input) {
        input.addEventListener("input", function() {
            document.querySelector("#" + input.id + "value").innerHTML = this.value;
        })
        document.querySelector("#" + input.id + "value").innerHTML = this.value;

    });

    
</script>