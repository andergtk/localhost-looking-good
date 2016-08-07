<?php

define( 'PATH', realpath( '.' ) );

require_once '.localhost/inc/init.php';


$subdir = empty( $_SERVER['REQUEST_URI'] )
	? '/'
	: trailingslashit( urldecode( trim( $_SERVER['REQUEST_URI'] ) ) );

$files = get_files( PATH . $subdir, $settings['ignore_files'] );

if ( $settings['nginx']['enabled'] ) {
	$nginx_sites = get_sites(
		$settings['nginx']['path'] . '/sites-available',
		$settings['nginx']['path'] . '/sites-enabled',
		"/^\s*server_name\s+(.+);/",
		$settings['nginx']['ignore_sites']
	);
}

if ( $settings['apache']['enabled'] ) {
	$apache_sites = get_sites(
		$settings['apache']['path'] . '/sites-available',
		$settings['apache']['path'] . '/sites-enabled',
		"/^\s*ServerName\s+(.+)/",
		$settings['apache']['ignore_sites']
	);
}


require_once '.localhost/layout/header.php';

?>

<div class="row">
	<div class="<?= $settings['nginx']['enabled'] || $settings['apache']['enabled'] ? 'col-md-6' : 'col-md-12'; ?>">
		<div class="card">
			<div class="card-header">
				<?php if ( '/' !== $subdir ) : ?>
					<a class="btn btn-default btn-go-back" href="<?= home_url( dirname( $subdir ) ); ?>" title="Go Back">
						<i class="icon ion-android-arrow-back"></i>
					</a>

					<h3 class="title"><?= basename( $subdir ); ?></h3>
				<?php else : ?>
					<h3 class="title">Projects</h3>
				<?php endif; ?>
			</div><!-- .card-header -->

			<div class="list-group">
				<?php if ( empty( $files ) ) : ?>
					<span class="list-group-item empty">Empty</span>
				<?php else : ?>
					<?php foreach ( $files as $file ) : ?>
						<?php if ( is_dir( PATH . $subdir . $file ) ) : ?>
							<a class="list-group-item is-dir" href="<?= home_url( $subdir . $file ); ?>">
								<span class="text"><?php echo $file; ?></span>
								<i class="icon ion-android-arrow-forward"></i>
							</a>
						<?php else : ?>
							<a class="list-group-item is-file" href="<?= home_url( $subdir . $file ); ?>">
								<span class="text"><?php echo $file; ?></span>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="row">
			<?php if ( $settings['nginx']['enabled'] ) : ?>
				<div class="col-md-12 m-b-1">
					<div class="card">
						<div class="card-header">
							<h3 class="title">Nginx</a></h3>
						</div><!-- .card-header -->

						<div class="list-group sites">
							<?php if ( empty( $nginx_sites ) ) : ?>
								<span class="list-group-item empty">No sites</span>
							<?php else : ?>
								<?php foreach ( $nginx_sites as $site ) : ?>
									<a class="list-group-item" href="<?= $site['url']; ?>">
										<span class="status status-<?= $site['status']; ?>"></span>
										<span class="filename"><?= $site['filename']; ?></span>
										<span class="url"><?= '#' === $site['url'] ? 'Server name not found' : $site['url']; ?></span>
									</a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $settings['apache']['enabled'] ) : ?>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="title">Apache</h3>
						</div><!-- .card-header -->

						<div class="list-group sites">
							<?php if ( empty( $apache_sites ) ) : ?>
								<span class="list-group-item empty">No sites</span>
							<?php else : ?>
								<?php foreach ( $apache_sites as $site ) : ?>
									<a class="list-group-item" href="<?= $site['url']; ?>">
										<span class="status status-<?= $site['status']; ?>"></span>
										<span class="filename"><?= $site['filename']; ?></span>
										<span class="url"><?= '#' === $site['url'] ? 'Server name not found' : $site['url']; ?></span>
									</a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php

require_once '.localhost/layout/settings.php';
require_once '.localhost/layout/footer.php';
