<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Localhost</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?= home_url( '/.localhost/assets/img/favicon.ico' ); ?>">
		<link rel="stylesheet" href="<?= home_url( '/.localhost/assets/css/bootstrap.min.css' ); ?>">
		<link rel="stylesheet" href="<?= home_url( '/.localhost/assets/css/ionicons.min.css' ); ?>">
		<link rel="stylesheet" href="<?= home_url( '/.localhost/assets/css/style.css' ); ?>">
	</head>
	<body>
		<nav class="navbar navbar-static-top navbar-dark bg-inverse m-b-1">
			<div class="container">
				<a class="navbar-brand text-uppercase" href="<?= home_url(); ?>">Localhost</a>

				<ul class="nav navbar-nav pull-xs-right">
					<?php if ( ! empty( $settings['phpmyadmin'] ) ) : ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= home_url( $settings['phpmyadmin'] ); ?>">PhpMyAdmin</a>
						</li>
					<?php endif; ?>

					<li class="nav-item">
						<a class="nav-link" href="https://github.com/andergtk/localhost-looking-good" target="_blank">
							<i class="icon ion-social-github"></i>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="modal" data-target="#settings">
							<i class="icon ion-android-settings"></i>
						</a>
					</li>
				</ul>
			</div><!-- .container -->
		</nav><!-- .navbar -->

		<div class="container">
			<?php $msg->display(); ?>
