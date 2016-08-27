<?php

define( 'PATH', realpath( '../..' ) );

require_once '../inc/init.php';
require_once '../layout/header.php';

?>

<div class="error-page">
	<h1 class="title">Something went wrong...</h1>
	<p class="message">
		The server encountered an internal error or misconfiguration<br>
		and was unable to complete your request.
	</p>
</div>

<?php

require_once '../layout/settings.php';
require_once '../layout/footer.php';
