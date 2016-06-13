<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if ( isset( $subdir ) && '/' !== $subdir ) : ?>
			<title><?php echo ucfirst( basename( $subdir ) ) . ' - Localhost'; ?></title>
		<?php elseif ( ! empty( $status ) ) : ?>
			<title><?php echo "{$status} - Localhost"; ?></title>
		<?php else : ?>
			<title>Localhost</title>
		<?php endif; ?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo HOME_URL . '/.localhost/favicon.ico'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL . '/.localhost/style.css'; ?>">
	</head>
	<body>
		<nav class="navbar">
			<div class="container">
				<div class="brand">
					<h1><a href="<?php echo HOME_URL; ?>">Localhost</a></h1>
				</div><!-- .brand -->

				<ul class="menu">
					<li class="menu-item"><a href="<?php echo HOME_URL . '/phpmyadmin'; ?>">PhpMyAdmin</a></li>
					<li class="menu-item">
						<a class="github-link" href="https://github.com/andergtk/localhost-looking-good" target="_blank">
							<img src="<?php echo HOME_URL . '/.localhost/github.png'; ?>" title="See this project on GitHub" alt="GitHub">
						</a>
					</li>
				</ul><!-- .menu -->
			</div><!-- .container -->
		</nav><!-- .navbar -->

		<div class="container">
