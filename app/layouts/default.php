<?php
	$currentUser = User::getCurrentUser();
	$authInfo = false;
	if ($currentUser) {
		$authInfo = [
			'userId' => $currentUser->id,
			'authToken' => $currentUser->getAuthToken(),
			'firstName' => $currentUser->firstName,
			'lastName' => $currentUser->lastName,
			'fullName' => $currentUser->getFullName()
		];
	}
?><html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
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

		var BASEURL = '{$this->baseUrl()}';
		var AUTH_INFO = " . json_encode($authInfo) . ";
		"
	);

	$this->scriptEnqueue('standard-vue-mixin', $this->publicUrl('js/standard-vue-mixin.js?t=' . filemtime(APP_ROOT . '/public/js/standard-vue-mixin.js')));
	$this->scriptEnqueue('websockets', $this->publicUrl('js/websockets-init.js?t=' . filemtime(APP_ROOT . '/public/js/websockets-init.js')));

	$this->scriptRegister('jquery-cdn', 'https://code.jquery.com/jquery-3.5.1.min.js');
	$this->scriptRegister('jquery', 'window.jQuery || document.write(\'<script src="' . $this->publicUrl('js/jquery-3.5.1.min.js') . '"><\/script>\')', ['jquery-cdn']);
	$this->scriptRegister('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery']);
	$this->scriptRegister('bootstrap-select', $this->publicUrl('js/bootstrap-select.min.js'), ['jquery', 'bootstrap']);
	$this->scriptRegister('bootstrap-tour', $this->publicUrl('js/bootstrap-tour.min.js'), ['jquery', 'bootstrap']);
	$this->scriptEnqueue('main', $this->publicUrl('js/main.js?t=' . filemtime(APP_ROOT . '/public/js/main.js')), ['bootstrap', 'bootstrap-select', 'bootstrap-tour'], false);
	$this->scriptEnqueue('tutorials', $this->publicUrl('js/tutorials.js?t=' . filemtime(APP_ROOT . '/public/js/tutorials.js')), ['main'], false);

	$this->outputStyles();
	$this->outputScripts();
	
	/** @var IRequest */
	$request = DI::getDefault()->get('Request');
	$this->bodyClass(strtolower($request->getControllerName()) . '-c');
	$this->bodyClass(strtolower($request->getActionName()) . '-a');
	?>
	<link rel="canonical" href="<?php echo $this->getCanonical() ?>" />
</head>

<body class="<?php echo $this->bodyClass(IS_LOCAL ? 'dev' : '') ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-red">

	<div class="navbar-brand"> <a class="nav-link" href="<?php echo $this->baseUrl() ?>"><img src="<?php echo $this->publicUrl('images/fl.png')?>" width="40" height="40"></a></div>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if ($currentUser) : ?>
                <?php if (!($currentUser->isAdmin())) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $currentUser->getDashboardUrl() ?>"> My Dashboard </a>
            </li>
            <?php endif; ?>
			<?php if ($currentUser->isInstructor()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $this->baseUrl("/Instructor/ViewReviews/{$currentUser->id}") ?>"> My Ratings </a>
            </li>
			<?php endif; ?>
			<?php if ($currentUser->isAdmin()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $this->baseUrl("/Admin/Panel/{$currentUser->id}") ?>"> My Panel </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"> Search Students </a>
            </li> -->
			<?php endif; ?>
            <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"> Resources </a>
            </li> -->
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $this->baseUrl('/Instructor/Search') ?>"> Search Instructors</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="<?php echo $this->baseUrl('/Index/Messaging') ?>"> Messages</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="<?php echo $this->baseUrl('/Index/Help') ?>"> Help Menu</a>
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
	<?php if (DEBUG): ?>
	<script>
		console.groupCollapsed('Queries ran');
		var _queries = <?= json_encode(DI::getDefault()->get('Db')->getAllQueries()) ?>;
		_queries.forEach((r, i) => {
			console.group(`Query ${i + 1}`);
			r.files.forEach(f => {
				console.log(`%c${f.file} %c${f.line}`, 'color: #f5b942', 'color: #b02c2c');
			});
			console.log(`%c${r.sql}`, 'background-color: #000000; color: #fff; padding: 5px');
			console.groupEnd();
		});
		console.groupEnd();
	</script>
	<?php endif; ?>
</body>
</html>