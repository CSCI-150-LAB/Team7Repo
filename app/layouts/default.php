<html>

<head>
	<title><?php echo $this->pageTitle('FeedbackLoop', true) ?></title>
	<?php
	$this->styleEnqueue('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
	$this->styleEnqueue('style', $this->publicUrl('css/style.css?t=' . filemtime(APP_ROOT . '/public/css/style.css')), ['bootstrap']);

	$this->scriptEnqueue(
		'docReady',
		"
		function docReady(fn) {
			if (document.readyState != 'loading'){
				fn();
			} else {
				document.addEventListener('DOMContentLoaded', fn);
			}
		}
		"
	);
	$this->scriptRegister('jquery-cdn', 'https://code.jquery.com/jquery-3.5.1.min.js');
	$this->scriptRegister('jquery', 'window.jQuery || document.write(\'<script src="' . $this->publicUrl('js/jquery-3.5.1.min.js') . '"><\/script>\')', ['jquery-cdn']);
	$this->scriptRegister('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery']);
	$this->scriptEnqueue('main', $this->publicUrl('js/main.js?t=' . filemtime(APP_ROOT . '/public/js/main.js')), ['bootstrap'], false);

	$this->outputStyles();
	$this->outputScripts();
	
	/** @var IRequest */
	$request = DI::getDefault()->get('Request');
	$this->bodyClass(strtolower($request->getControllerName()) . '-c');
	$this->bodyClass(strtolower($request->getActionName()) . '-a');
    
    $currentUser = User::getCurrentUser();
	?>
	<link rel="canonical" href="<?php echo $this->getCanonical() ?>" />
	<script>
		var BASEURL = '<?php echo $this->baseUrl() ?>';
	</script>
</head>

<body class="<?php echo $this->bodyClass(IS_LOCAL ? 'dev' : '') ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-red">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li>
                <img src="<?php echo $this->publicUrl('images/fl.png')?>" width="40" height="40">
            </li>
            <?php if ($currentUser) : ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $currentUser->getDashboardUrl() ?>"> My Dashboard </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="javascript:void(0)"> My Ratings </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="javascript:void(0)"> Resources </a>
            </li>
            <?php endif; ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $this->baseUrl('/Instructor/Search') ?>"> Search Instructors</a>
            </li>

        </ul>
        <?php if ($currentUser) : ?>
        <div class="dropdown form-inline my-2 my-lg-0 current-user-dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $currentUser->firstName ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo $currentUser->getProfileUrl() ?>">View Profile</a>
                <a class="dropdown-item" href="<?php echo $this->baseUrl('/User/Logout') ?>">Log Out</a>
            </div>
        </div>
        <?php else : ?>
            <ul class="navbar-nav ml-3 user-login-logout">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $this->baseUrl('/User/Login') ?>">Login / Register</a>
                </li>
            </ul>
        <?php endif; ?>
    </nav>

    <div class="container my-3">
		<?php foreach (SimpleAlert::getAndClearAlerts() as $alert) : ?>
			<div class="alert alert-<?php echo $alert['type'] ?>" role="alert">
				<?php echo $alert['html'] ? $alert['message'] : $this->escapeHtml($alert['message']) ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endforeach; ?>
        <?php echo $this->getContents() ?>
    </div>

	<?php $this->outputScripts(false) ?>
</body>

</html>