<?php

define( 'PATH', realpath( '../..' ) );

require_once '../inc/init.php';
require_once '../layout/header.php';

?>

<div class="error-page">
	<h1 class="status">400</h1>
	<p class="message">
		Bad request! The server cannot or will not process<br>
		the request due to an apparent client error.
	</p>
</div>

<?php

require_once '../layout/settings.php';
require_once '../layout/footer.php';
