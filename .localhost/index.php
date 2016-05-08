<?php

/** Change it if needed */
define( 'HOME_URL',   'http://' . $_SERVER['HTTP_HOST'] );
define( 'HOME_DIR',   '/var/www' ); // projects directory
define( 'APACHE_DIR', '/etc/apache2' );


/** Add here the name of the virtual hosts files to be ignored */
$sites_ignore    = array(
	'000-default.conf',
	'default-ssl.conf'
);

$projects        = array();
$sites_available = array();
$sites_enabled   = array();


/** To ignore hidden things */
$pattern = '/^\./';


/** Stores the folder name of the projects */
$dir = opendir( HOME_DIR );
while ( $folder_name = readdir( $dir ) )
	if ( ! preg_match( $pattern, $folder_name ) )
		$projects[] = $folder_name;
closedir( $dir );


/** Stores the sites available */
$dir = opendir( APACHE_DIR . '/sites-available' );
while ( $conf_file = readdir( $dir ) )
	if ( ! preg_match( $pattern, $conf_file ) && ! in_array( $conf_file, $sites_ignore ) )
		$sites_available[] = $conf_file;
closedir( $dir );


/** Stores the sites enabled */
$dir = opendir( APACHE_DIR . '/sites-enabled' );
while ( $conf_file = readdir( $dir ) )
	if ( ! preg_match( $pattern, $conf_file ) )
		$sites_enabled[] = $conf_file;
closedir( $dir );

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Localhost</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo HOME_URL . '/.localhost/favicon.ico'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL . '/.localhost/style.css'; ?>">
	</head>
	<body>
		<nav class="navbar">
			<div class="container">
				<div class="branding">
					<h1><a href="<?php echo HOME_URL; ?>">Localhost</a></h1>
				</div><!-- .branding -->

				<ul class="menu">
					<li><a href="<?php echo HOME_URL . '/phpmyadmin'; ?>">PhpMyAdmin</a></li>
					<li>
						<a class="github-link" href="https://github.com/andergtk/localhost-looking-good" target="_blank">
							<img src="<?php echo HOME_URL . '/.localhost/github.png'; ?>" title="See this project on GitHub" alt="GitHub">
						</a>
					</li>
				</ul><!-- .menu -->
			</div><!-- .container -->
		</nav><!-- .navbar -->

		<div class="container">
			<div class="column">
				<div class="panel">
					<div class="panel-heading">
						<h3>Projects</h3>
					</div><!-- .panel-heading -->

					<div class="panel-body">
						<div class="list-group">

							<?php if ( empty( $projects ) ) : ?>

								<p class="list-group-item">No Projects</p>

							<?php else : ?>

								<?php foreach ( $projects as $project ) : ?>
									<a class="list-group-item" href="<?php echo HOME_URL . "/{$project}"; ?>">
										<h4><?php echo $project; ?></h4>
									</a>
								<?php endforeach; ?>

							<?php endif; ?>

						</div><!-- .list-group -->
					</div><!-- .panel-body -->
				</div><!-- .panel -->
			</div><!-- .column -->

			<div class="column">
				<div class="panel">
					<div class="panel-heading">
						<h3>Virtual Hosts</h3>
					</div><!-- .panel-heading -->

					<div class="panel-body">
						<div class="list-group">

							<?php if ( empty( $sites_available ) ) : ?>

								<p class="list-group-item">No Virtual Hosts</p>

							<?php else : ?>

								<?php foreach ( $sites_available as $site ) : ?>
									<?php

									/** Reads entire file into an array */
									$file = file( APACHE_DIR . "/sites-available/{$site}" );
									foreach ( $file as $line ) {

										/** Search for the line with the ServerName */
										preg_match( '/ServerName\s+(.*)\n/', $line, $server_name);
										if ( isset( $server_name[1] ) ) {
											$url = "http://{$server_name[1]}";
											break;
										}
									}

									/** If there's no ServerName, set a common URL */
									if ( ! isset( $url ) )
										$url = HOME_URL . "/{$site}";

									/** Verify if the virtual host configuration is enabled */
									$label_type = ( in_array( $site, $sites_enabled ) ) ? 'success' : 'danger';

									?>
									<a class="list-group-item" href="<?php echo $url; ?>">
										<h4><?php echo $site; ?></h4>
										<span class="label <?php echo "label-{$label_type}"; ?>"></span>
										<p><?php echo $url; ?></p>
									</a><!-- .list-group-item -->
								<?php endforeach; ?>

							<?php endif; ?>

						</div><!-- .list-group -->
					</div><!-- .panel-body -->
				</div><!-- .panel -->
			</div><!-- .column -->
		</div><!-- .container -->
	</body>
</html>
