<?php
    session_start(); 
    error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));
    include 'globalfunction/koneksi.php';
    include 'globalfunction/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="instingdigital : www.instingdigital.net" />
    <title>Sistem Reservasi :: Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="maincontent/main_js.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
            <?php 
               include 'maincontent/main_content.php';
            ?>
            <div class="footer">Sistem Reservasi SOKA Restaurant</div>
		</div>
	</div>
</div>
</body>
</html>
