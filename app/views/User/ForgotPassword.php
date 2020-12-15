<?php
	$this->pageTitle('Forgot Password');
?>

<main>
	<div class="container">
		<div class="row">
			<div class="col col-sm-6">

				<?php if ($emailed) : ?>

					We have emailed you the link needed to reset your password

				<?php else : ?>

					<?php if (count($errors)) : ?>
						<ul>
							<?php foreach ($errors as $err) : ?>
								<li><?= $err ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<form method="POST">
						<div class="form-group">
							<label for="email">Email address</label>
							<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
							<small id="emailHelp" class="form-text text-muted">We'll send you an email with the information you need</small>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				<?php endif; ?>

			</div>
		</div>
	</div>
</main>