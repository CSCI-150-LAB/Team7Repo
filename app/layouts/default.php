<html>

<head>
	<title><?php echo $this->pageTitle('Minimal MVC', true) ?></title>
	<?php
	$this->styleEnqueue('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
	$this->styleEnqueue('style', $this->publicUrl('css/style.css'), ['bootstrap']);

	$this->scriptRegister('jquery-cdn', 'https://code.jquery.com/jquery-3.5.1.min.js');
	$this->scriptRegister('jquery', 'window.jQuery || document.write(\'<script src="' . $this->publicUrl('js/jquery-3.5.1.min.js') . '"><\/script>\')', ['jquery-cdn']);
	$this->scriptRegister('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery']);

	$this->scriptEnqueue('bootstrap');

	$this->outputStyles();
	$this->outputScripts();
	?>
	<link rel="canonical" href="<?php echo $this->getCanonical() ?>" />
</head>

<body class="<?php echo $this->bodyClass(IS_LOCAL ? 'dev' : '') ?>">
	<header class="header">
		<?php
			$currentUser = User::getCurrentUser();
		?>
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#">FeedbackLoop</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php if ($currentUser) : ?>
						<?php if ($currentUser->type == 'student') : ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Students
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<?php endif; ?>
						<?php if ($currentUser->type == 'instructor') : ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Instructors
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>

				<?php if ($currentUser) : ?>
					<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
				<?php endif; ?>

				<ul class="navbar-nav ml-3 user-login-logout">
					<?php if ($currentUser) : ?>
					<li class="nav-item">
						<span class="nav-link">Not <?php echo $currentUser->firstName ?>? <a href="<?php echo $this->baseUrl("/User/Logout") ?>">logout</a></span>
					</li>
					
					<?php else : ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $this->baseUrl('/User/Login') ?>">Login / Register</a>
					</li>
					<?php endif; ?>
				</ul>
			</div>
		</nav>
	</header>

	<div class="container my-5">
		<?php echo $this->getContents() ?>
	</div>

	<footer class="footer text-light bg-dark">
		<div class="container">
			<div class="copyright">This is where a copyright could go Team7.</div>
		</div>
	</footer>
	<?php $this->outputScripts('footer') ?>
</body>

</html>