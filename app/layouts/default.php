<html>
    <head>
        <title>Minimal MVC - By Daniel Flynn</title>
        <?php
            $this->styleEnqueue('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
            $this->styleEnqueue('style', $this->publicUrl('css/style.min.css'), ['bootstrap']);
            
            $this->scriptRegister('jquery-cdn', 'https://code.jquery.com/jquery-3.5.1.min.js');
            $this->scriptRegister('jquery', 'window.jQuery || document.write(\'<script src="' . $this->publicUrl('js/jquery-3.5.1.min.js') . '"><\/script>\')', ['jquery-cdn']);
            $this->scriptRegister('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery']);
            
            $this->scriptEnqueue('bootstrap');

            $this->outputStyles();
            $this->outputScripts();
        ?>
    </head>
    <body class="<?php echo $this->bodyClass(IS_LOCAL ? 'dev' : '') ?>">
        <header class="header">
            <nav class="navbar navbar-expand-lg" role="navigation">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo $this->baseUrl(); ?>">
                        <img src="<?php echo $this->publicUrl('images/logo.png') ?>" class="img-fluid" alt="Minimal MVC">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar icon-bar-x"></span>
                        <span class="icon-bar icon-bar-x icon-bar-sneaky"></span>
                        <span class="icon-bar"></span>
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <div class="collapse navbar-collapse" id="main-menu">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item <?php echo $this->isRouteActive('Index/Index') ? 'active' : '' ?>">
                                <a class="nav-link" href="<?php echo $this->baseUrl() ?>">Home</a>
                            </li>
                            <li class="nav-item <?php echo $this->isRouteActive('Index/DoesNotExist') ? 'active' : '' ?>">
                                <a class="nav-link" href="<?php echo $this->baseUrl('Index/DoesNotExist') ?>">Subpage That Doesn't Exist</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <?php echo $this->getContents() ?>

        <footer class="footer mt-3">
            <div class="container">
                <div class="copyright">This is where a copyright could go <a href="#">Team 7</a>.</div>
            </div>
        </footer>
        <?php $this->outputScripts('footer') ?>
    </body>
</html>