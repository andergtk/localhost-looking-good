<?php

define( 'PATH', realpath( '../..' ) );

require_once '../inc/init.php';
require_once '../layout/header.php';

?>

<div class="error-page">
	<h1 class="status">403</h1>
	<p class="message">
		Forbidden!<br>
		You don't have permission to access this.
	</p>
</div>

<?php

require_once '../layout/settings.php';
require_once '../layout/footer.php';
