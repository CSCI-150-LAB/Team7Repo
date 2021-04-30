<?php 
    $this->pageTitle("CourseMaterials"); 
?>

<div class="col mb-3 p-5 text-white bg-blue"> 
	<div class = "row">
		<h1 class="mb-3 text-white"> <?php echo $class->class?> Course Materials</h1>
	</div>
</div>

<!-- CODE TO UPLOAD FILE LOCALLY

$statusMsg = 'Nice! We got your file.';

//file upload path
$targetDir = "./Instructor";
$fileName = basename($_FILES["course-file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["course-file"]["name"])) {
    //allow certain file formats
    $allowTypes = array('gif', 'jpg', 'jpeg', 'png' ,'jpg','jpeg','png','doc','docx','txt','pdf','png','pptx','ppt','mov','wav','mpg','mpeg','mp4','mp3','bmp','pdf');
    if(in_array($fileType, $allowTypes)){
        //upload file to server
        if(move_uploaded_file($_FILES["course-file"]["tmp_name"], $targetFilePath)){
        
            $statusMsg = "The file ".$fileName. " has been uploaded.";
        }else{
            $statusMsg = "Im so sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Oh no. Sorry, only .jpg,.jpeg,.png,.doc,.docx,.txt,.pdf,.png, .pptx,.ppt,.mov,.wav,.mpg,.mpeg,.mp4,.mp3,.bmp, and .pdf files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

//display status message
echo $statusMsg;
?> -->



<a class="btn btn-secondary float-right text-white" href= '<?php echo $this->baseUrl("/Instructor/AddFile/{$class->classid}")?>'>Add file</a> <br> </br>

<?php $files = ClassFiles::find("classId =:0:", $class->classid);?>
<!-- connect to the class_files linked to the files table in the database -->

<div class="table-responsive">
	<table class="table table-bordered tbl-background">
		<thead> 
			<tr>
				<th scope="col"> File Name </th>
				<th scope="col"> Date & Time Created </th>
				<th scope="col"> Uploaded By </th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($files as $file):
            $f = File::findOne("id =:0:", $file->fileId); ?>
                <tr>
					<td> <a href='<?php echo $this->baseUrl("/File/Load/{$f->id}/{$f->name}") ?>' target='_blank'><?php echo $f->name?></a></td>
                    <td> <?php echo $f->updatedAt?></td>
                    <td><?php echo $f->getAuthor()->getFullName()?></td>
				</tr>
        <?php endforeach; ?>
		</tbody>
	</table>
</div>



<!-- This shows the link to the file-->
<!-- <p> <a href="<?php //echo $this->baseUrl("Instructor$fileName") ?>" target="_blank"><?php //echo "$fileName"?></p> -->