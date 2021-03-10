<?php
	$this->pageTitle('Edit Profile');
?>
<!-- <a class = 'btn btn-secondary float-md-right text-white' onclick = 'editStudProfTut()')>Help</a><br><br>-->
<form method="POST">
	<h1>Edit your profile</h1>
    <input type="text" name="major" value="<?php echo $this->escapeHtml($profile->studentMajor) ?>">
    <label for="studentMajor">Enter your major</label>
    <br>
    <input type="text" name="learningStyle" value="<?php echo $this->escapeHtml($profile->learningStyle) ?>">
    <label for="studentMajor">Enter your preferred learning style</label>
   
    <br>
    <input type="range" name="visual" id="visual" min="1" max="10" value="<?php echo $profile->visual ?>">
    <label for="visual">How often do you prefer visual learning tools?</label> 
    
    <br>
    <input type="range" name="kinesthetic" id="kinesthetic" min="1" max="10" value="<?php echo $profile->kinesthetic ?>">
    <label for="kinesthetic">How often do you prefer kinesthetic learning tools?</label> 
    <br>

    <input type="range" name="audio" id="audio" min="1" max="10" value="<?php echo $profile->audio ?>">
    <label for="audio">How often do you prefer audio learning tools?</label> 
    <br>

    
    <input type="range" name="readingwriting" id="readingwriting" min="1" max="10" value="<?php echo $profile->reading_writing ?>">
    <label for="readingwriting">How often do you prefer reading/writing learning tools?</label> 
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
        <option value="Recorded-Lectures/Audio-Books">Recorded lectures / audio books </option>
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
	<button type="submit" class="btn btn-cardinalred" style = >Save Changes</button>
</form>
<!--
<script>
	function editStudProfTut(){
		// Declare the tour
		var studentProfileTutorial = new Tour({
			name: "student tour",
			container: "body",
			smartPlacement: true,
			backdrop: true,
			backdropPadding: 5,
			duration: 10000,
			storage: false,
            steps: [
            {
                element: ".studentprofile",
                title: "Your Profile",
				next: 1,
				prev:-1,
                content: "This is your student profile, here is some basic information about you."
            },
            {
                element: ".studentemail",
                title: "Email Address",
				next: 2,
				prev: 0,
                content: "Your student email is listed here."
            },
			{
                element: ".preferredlearningstyle",
                title: "Preferred Learning Style",
				next: 3,
				prev: 1,
                content: "Your preferred learning style is listed here."
            },
			{
                element: ".learningstyles",
                title: "Learning Styles",
				next: 4,
				prev: 2,
                content: "This section shows how comfortable you are with all learning styles."
            },
			{
                element: ".learningtools",
                title: "Learning Tools",
				next: 5,
				prev: 3,
                content: "This section lists the tools you are most comfortable with for each learning style."
            },
			{
                element: ".editprofile",
                title: "Edit Profile",
				prev: 4,
                content: "All of the previously mentioned information can be updated by clicking here."
            },]
        });
	  
		// Initialize the tour
		studentProfileTutorial.init();
	  
		// Start the tour
		studentProfileTutorial.restart();
	  
	};
</script> -->
