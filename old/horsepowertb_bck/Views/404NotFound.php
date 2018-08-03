<?php
require_once (__DIR__ . '/../Config/conf_dev.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
</head>
<body>
<h1>Page Not Found</h1>
<div>
    The required page does not exist.
    <br>
    You will be redirect to the homepage in <span id="timeFor404"></span>sec
    <br>
    <em>Click <a href="<?php echo $baseUrl; ?>">here</a> if nothing happen</em>
</div>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="application/javascript" src="<?php echo 'http://' . $_SERVER['HTTP_HOST']  ?>/Public/JavaScript/script.js"></script>
<script type="application/javascript">
    decountFor404NotFound(<?php echo '"'.$baseUrl.'"'; ?>);
</script>
</body>
</html>