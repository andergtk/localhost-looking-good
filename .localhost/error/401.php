<?php

define( 'PATH', realpath( '../..' ) );

require_once '../inc/init.php';
require_once '../layout/header.php';

?>

<div class="error-page">
	<h1 class="status">401</h1>
	<p class="message">
		Unauthorized! Authentication is required<br>
		and has failed or has not yet been provided.
	</p>
</div>

<?php

require_once '../layout/settings.php';
require_once '../layout/footer.php';
