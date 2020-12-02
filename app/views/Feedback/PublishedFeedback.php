<?php

$user = User::getCurrentUser();

?>

<div class="mb-3 bg-blue p-5 text-white">
	<h1 class="mb-0">Feedback Sessions <?php echo $class->class ?></h1>
</div>

<?php if($user->type == "student"): ?>
	<a class = 'btn btn-secondary float-left text-white mr-3' href = '<?=  $this->baseUrl('/Student/AllResponses') ?>'> My Responses</a>
<?php endif ?>

<?php if ($viewAll) : ?>
	<a class="btn btn-primary" href="<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>">View Active Only</a>
<?php else : ?>
	<a class="btn btn-primary" href="<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}/all") ?>">View All Sessions</a>
<?php endif; ?>

<div class="table-responsive my-3">
	<table class="table table-bordered bg-white"> 
		<thead>
			<tr>
				<th scope="col"> Title </th>
				<th scope="col"> Student responses </th>
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
</div>
