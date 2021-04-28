<?php 
    $this->pageTitle("CourseMaterials"); 
?>

<!--
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

<div class="table-responsive">
	<table class="table table-bordered tbl-background">
		<thead> 
			<tr>
				<th scope="col"> Name <i class="fas fa-sort-down"></th>
				<th scope="col"> Date Created <i class="fas fa-sort-down"></th>
				<th scope="col"> Modified By <i class="fas fa-sort-down"></th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($files as $file):?> 
				<tr>
                <?php if(true) {?>
					<td> <a href='<?php echo $this->baseUrl("/File/Load/{$file->id}") ?>'><?php echo $file->name?></a></td>
                    <td> <?php echo $file->updatedAt?></td>
                    <td><?php echo $file->authorId?></td>
				</tr>
                <?php } ?>
        <?php endforeach; ?>
		</tbody>
	</table>
</div>



<!-- This shows the link to the file-->
<!-- <p> <a href="<?php //echo $this->baseUrl("Instructor$fileName") ?>" target="_blank"><?php //echo "$fileName"?></p> -->