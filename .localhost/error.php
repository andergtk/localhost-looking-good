<?php

$error = array(
	400 => 'Bad Request',
	401 => 'Unauthorized',
	403 => 'Forbidden',
	404 => 'Not Found',
	405 => 'Method Not Allowed',
	407 => 'Proxy Authentication Required',
	408 => 'Request Timeout',
	414 => 'URI Too Long',
	429 => 'Too Many Requests',
	500 => 'Internal Server Error',
	502 => 'Bad Gateway',
	503 => 'Service Unavailable',
	507 => 'Insufficient Storage',
	508 => 'Loop Detected',
);

$status = $_SERVER['REDIRECT_STATUS'];
$title = $error[ $status ];

require_once( 'config.php' );
require_once( 'header.php' );

?>

<div class="error-page">
	<p class="error-status"><?php echo $status; ?></p>
	<p class="error-title"><?php echo $title; ?></p>
</div><!-- .error-page -->

<?php require_once( 'footer.php' ); ?>
