<?php
	$this->pageTitle('Edit Profile');
?>

<?php if (count($errors)) : ?>
	<ul class="form-errors">
		<li><?= implode('</li><li>', $errors) ?></li>
	</ul>
<?php endif; ?>

<button class = 'btn btn-secondary float-md-right text-white' data-start-tour="Student Edit Profile Tour">Help</button><br><br>
<h1><b>Edit your profile</b></h1>
<form class = "studenteditprofile" method="POST" enctype="multipart/form-data">

	<div class="form-row">
		<div class="form-group col-sm-4">
			<img id="profile-preview" src="<?= $student->getProfileImageSrc() ?>" data-src="<?= $student->getProfileImageSrc() ?>" class="img-fluid">
			<div class="mt-1">
				Current Profile Image
			</div>
		</div>
		<div class="form-group col-sm-8">
			<label for="profile-image">Upload New Profile Image</label>
			<input name="profile-image" type="file" class="form-control-file has-img-preview" data-target="#profile-preview" id="profile-image" accept=".gif,.jpg,.jpeg,.png">
			<button type="button" class="btn btn-danger btn-reset-file-input mt-3" data-target="#profile-image">Clear</button>
		</div>
	</div>

    <input class = "studentsmajor" type="text" name="major" value="<?php echo $this->escapeHtml($profile->studentMajor) ?>">
    <label for="studentMajor">Enter your major</label>
    <br>

    <input class = "studentlspref" type="text" name="learningStyle" value="<?php echo $this->escapeHtml($profile->learningStyle) ?>">
    <label for="studentMajor">Enter your preferred learning style</label>
    <br>

    <div class = "learningstylecomfort">
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
    <br></div>

    
    <div class = "learningtoolspref">
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
    <br></div>
    

   

    
    <br>
	<button type="submit" class="btn btn-cardinalred saveedits" style = >Save Changes</button>
</form>

