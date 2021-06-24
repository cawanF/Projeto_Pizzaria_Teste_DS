<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo TITLE;?> 404</title>
  <link href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://<?php echo APP_HOST; ?>/public/css/error.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="error"><?php echo $varMessage ?></h1>
  </div>
</body>
</html>