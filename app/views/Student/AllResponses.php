<div class="card p-3">
	<div class="card-body">
		<h4 class="card-title" style="text-align: center">Your Responses</h4>
	</div>
</div>

<?php foreach ($myResponses as $response) : ?>
	<?php $response->printResponse() ?>
<?php endforeach; ?>