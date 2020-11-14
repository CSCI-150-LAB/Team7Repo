<?php

$user = User::getCurrentUser();

?>

<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Feedback Sessions <?php echo $class->class ?></h1>

<?php
    if($user->type == "student") {
        echo "<a class = 'btn btn-secondary float-left' style = 'color: #ffffff;' href = '" . $this->baseUrl('/Student/AllResponses') . "' > My Responses</a>";
    }

   
?>

<?php if ($viewAll) : ?>
	<a class="btn btn-primary" href="<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>">View Active Only</a>
<?php else : ?>
	<a class="btn btn-primary" href="<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}/all") ?>">View All Sessions</a>
<?php endif; ?>

<table class="table table-bordered"> 
	<thead>
		<tr>
			<th scope="col"> Title </th>
			<th scope="col"> Description </th>
		</tr>
	</thead>
	<tbody>  
<?php foreach($feedbackSessions as $feedback):?>
	<?php 
        
        //$exists = ResponseModel::getByKey($feedback->feedbackid);
		$exists = FeedbackResponse::findOne("student_id =:0: AND feedback_session_id =:1:", $user->id, $feedback->id);
		$feedbackResultCount = FeedbackResponse::count('feedback_session_id = :0:', $feedback->id);
		
		$url = '';

        if($user->type == "instructor") {
            $url = "Feedback/InstructorResult/{$feedback->id}";
		}
		else {
			if($exists) {
				$url = "Student/AllResponses";
			}
	
			else {
				$url = "Feedback/Response/{$feedback->id}"; //Go to text feedback page
			}
		}
        
                    
           
        
    ?> 
           
                    <tr>                                                             
                        <td> <a href='<?php echo $this->baseUrl($url)?>'><?php echo $feedback->title ?></a></td> 
                        <td> <?php echo $feedbackResultCount ?> Response<?php echo $feedbackResultCount == 1 ? '' : 's' ?></td>
                        
                    </tr>
                
<?php endforeach;?>
	</tbody>
</table>
