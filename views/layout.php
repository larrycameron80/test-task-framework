<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>MVC 3000</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body class="container">
<div class="row">
    <div class="col-md-12">
        <?php $flashError = \classes\App::getInstance()->getFlashError(); ?>
        <?php if (!empty($flashError)): ?>
            <div class="alert alert-<?php echo $flashError['type']; ?>">
                <?php echo $flashError['message']; ?>
            </div>
        <?php endif; ?>
        <?php echo $content; ?>
    </div>
</div>
</body>
</html>