<?php
$statusMsg = 'Nice! We got your file.';

//file upload path
$targetDir = "./Instructor";
$fileName = basename($_FILES["course-file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["course-file"]["name"])) {
    //allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        //upload file to server
        if(move_uploaded_file($_FILES["course-file"]["tmp_name"], $targetFilePath)){
        
            $statusMsg = "The file ".$fileName. " has been uploaded.";
        }else{
            $statusMsg = "Im so sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Oh no. Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload, we did not get anything.';
}

//display status message
echo $statusMsg;
?>
<br></br>
<h1>Your File Uploads</h1>

<!-- This shows the link to the file-->
<p> <a href="<?php echo $this->baseUrl("Instructor$fileName") ?>" target="_blank"><?php echo "$fileName"?></p>

<form action="<?php echo $this->baseUrl("/Instructor/CourseMaterials") ?>" class ="addingcoursefile" method="POST" enctype="multipart/form-data">
  
    <input type="file" name="course-file" id="course-file">
    <input type="submit" value="Submit Upload Please" name="submit">
</form>

<a class="btn btn-primary" href="<?php echo $this->baseUrl("/Instructor/AddFile") ?>"" role="button">Link</a>