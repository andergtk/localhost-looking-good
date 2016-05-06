<?php

define( 'HOME_URL',   'http://localhost/localhost-looking-good' );
define( 'HOME_DIR',   '/var/www' ); // directory of the projects
define( 'APACHE_DIR', '/etc/apache2' );

$projects        = array();
$sites_availalbe = array();
$sites_enabled   = array();
$sites_ignore    = array(
	'000-default.conf',
	'default-ssl.conf',
	'www.conf'
);

$pattern = '/^\./'; // used to ignore hidden things

// stores the folder name of the projects
$dir = opendir( HOME_DIR );

while ( $folder_name = readdir( $dir ) )
	if ( ! preg_match( $pattern, $folder_name ) )
		$projects[] = $folder_name;

closedir( $dir );

// stores the sites available
$dir = opendir( APACHE_DIR . '/sites-available' );

while ( $conf_file = readdir( $dir ) )
	if ( ! preg_match( $pattern, $conf_file ) && ! in_array( $conf_file, $sites_ignore ) )
		$sites_availalbe[] = $conf_file;

closedir( $dir );

// stores the sites enabled
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
							<?php foreach ( $projects as $project ) : ?>
								<a class="list-group-item" href="<?php echo HOME_URL . "/{$project}"; ?>">
									<h4><?php echo $project; ?></h4>
								</a>
							<?php endforeach; ?>
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
							<?php foreach ( $sites_availalbe as $site ) : ?>
								<?php

								$file = file( APACHE_DIR . "/sites-available/{$site}" );

								foreach ( $file as $line ) {
									preg_match( '/ServerName\s+(.*)\n/', $line, $server_name);

									if ( isset( $server_name[1] ) ) {
										$url = "http://{$server_name[1]}";
										break;
									} else {
										$url = HOME_URL . "/{$site}";
									}
								}

								$label = ( in_array( $site, $sites_enabled ) ) ? 'success' : 'danger';

								?>
								<a class="list-group-item" href="<?php echo $url; ?>">
									<h4><?php echo $site; ?></h4>
									<span class="label label-<?php echo $label; ?>"></span>
									<p><?php echo $url; ?></p>
								</a><!-- .list-group-item -->

							<?php endforeach; ?>
						</div><!-- .list-group -->
					</div><!-- .panel-body -->
				</div><!-- .panel -->
			</div><!-- .column -->
		</div><!-- .container -->
	</body>
</html>
