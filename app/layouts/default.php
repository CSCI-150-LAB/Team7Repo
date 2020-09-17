<html>
    <head>
        <title>Minimal MVC - By Daniel Flynn</title>
        <?php
            $this->styleEnqueue('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
            
            $this->scriptRegister('jquery-cdn', 'https://code.jquery.com/jquery-3.5.1.min.jsx');
            $this->scriptRegister('jquery', 'window.jQuery || document.write(\'<script src="' . $this->publicUrl('/js/jquery-3.5.1.min.js') . '"><\/script>\')', ['jquery-cdn']);

            $this->outputStyles();
            $this->outputScripts();
        ?>
    </head>
    <body class="<?php echo $this->bodyClass() ?>">
        <header>
            <div class="container">
                <?php $request = DI::getDefault()->get('Request'); ?>
                <h1><?php echo $request->getControllerName() ?> - <?php echo $request->getActionName() ?></h1>
            </div>
        </header>
        <?php echo $this->getContents() ?>
        <?php $this->outputScripts('footer') ?>
    </body>
</html>