<?php

define( 'PATH', realpath( '../..' ) );

require_once '../inc/init.php';
require_once '../layout/header.php';

?>

<div class="error-page">
	<h1 class="status">404</h1>
	<p class="message">Oops! Page not found</p>
</div>

<?php

require_once '../layout/settings.php';
require_once '../layout/footer.php';
