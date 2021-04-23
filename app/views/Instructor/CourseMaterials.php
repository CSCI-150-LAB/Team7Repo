<?php 
    $this->papgeTitle("CourseMaterials"); 
?>

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
    $statusMsg = 'Please select a file to upload.';
}

//display status message
echo $statusMsg;
?>



<!-- TODO: Update add file link --> 
<a class="btn btn-secondary float-right text-white" href= '<?php echo $this->baseUrl("/Instructor/AddFile/{$class->classid}")?>'>Add file</a> <br> </br>

<div class="table-responsive">
	<table class="table table-bordered tbl-background">
		<thead> 
			<tr> <!-- TODO: Fixed cell width --> 
				<th scope="col"> Name <i class="fas fa-sort-down"></th>
				<th scope="col"> Date Created <i class="fas fa-sort-down"></th>
				<th scope="col"> Modified By <i class="fas fa-sort-down"></th>
			</tr>
		</thead>
		<tbody>
				<tr> <!-- TODO: Link actual materials, loop through database --> 
					<td> <a href = ""> Ch1.pdf </a></td>
                    <td> 02/08/20</td>
                    <td> Alex Lui</td>
				</tr>
		</tbody>
	</table>
</div>



<!-- This shows the link to the file-->
<p> <a href="<?php echo $this->baseUrl("Instructor$fileName") ?>" target="_blank"><?php echo "$fileName"?></p>

