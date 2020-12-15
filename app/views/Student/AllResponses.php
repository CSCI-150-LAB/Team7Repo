<?php
	/** @var FeedbackResponse[] $myResponses */
	$this->pageTitle('View Your Responses');
?>

<div class="bg-blue p-5 text-white mb-3">
	<h1 class="mb-0">Your Responses</h1>
</div>

<?php foreach ($myResponses as $response) : ?>
	<?php $response->printResponse() ?>
<?php endforeach; ?>