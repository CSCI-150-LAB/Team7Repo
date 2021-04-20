<?php 
    $this->papgeTitle("Add File"); 
?>

<h2> Add a file to course materials</h2>

<form class ="addingcoursefile" method="POST" enctype="multipart/form-data">
    <label for="course-file">Upload New File</label>
    <input type="file" name="course-file" id="course-file" accept=".jpg,.jpeg,.png,.doc,.docx,.txt,.pdf,.png,pptx,.ppt,.mov,.wav,.mpg,.mpeg,.mp4,.mp3,.bmp,.pdf">
    <input type="submit" value="Submit Upload" name="submit">
</form>