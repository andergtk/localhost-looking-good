<?php

/** Change it if needed */
define( 'HOME_URL',     'http://' . $_SERVER['HTTP_HOST'] );
define( 'APACHE_DIR',   '/etc/apache2' );
define( 'PROJECTS_DIR', realpath( '..' ) );

/** Add here the name of the virtual hosts files to be ignored */
$ignore    = array(
	'000-default.conf',
	'default-ssl.conf'
);
