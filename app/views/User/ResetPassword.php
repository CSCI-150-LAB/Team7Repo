<main>
	<div class="container">
		<div class="row">
			<div class="col col-sm-6">

				<?php if ($reset) : ?>
					
					Your account password has been updated. <a href="<?php echo $this->baseUrl('/User/Login') ?>">Click here to login</a>.

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
							<label for="pass">Password</label>
							<input type="password" class="form-control" id="pass" name="pass" aria-describedby="passHelp">
						</div>
						<div class="form-group">
							<label for="confirmPass">Confirm Password</label>
							<input type="password" class="form-control" id="confirmPass" name="confirm-pass" aria-describedby="confirmPassHelp">
							<small id="confirmPassHelp" class="form-text text-muted">This must match</small>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				<?php endif; ?>

			</div>
		</div>
	</div>
</main>