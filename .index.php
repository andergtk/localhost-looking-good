<?php

define( 'PATH', realpath( '.' ) );

require_once '.localhost/inc/init.php';


$subdir = empty( $_SERVER['REQUEST_URI'] )
	? '/'
	: trailingslashit( urldecode( trim( $_SERVER['REQUEST_URI'] ) ) );

$files = get_files( PATH . $subdir, $settings['ignore_files'] );

if ( $settings['nginx']['enabled'] ) {
	$nginx_sites_available = get_files(
		$settings['nginx']['path'] . '/sites-available',
		$settings['nginx']['ignore_sites']
	);

	$nginx_sites_enabled = get_files( $settings['nginx']['path'] . '/sites-enabled' );
}

if ( $settings['apache']['enabled'] ) {
	$apache_sites_available = get_files(
		$settings['apache']['path'] . '/sites-available',
		$settings['apache']['ignore_sites']
	);

	$apache_sites_enabled = get_files( $settings['apache']['path'] . '/sites-enabled' );
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
						<?php if ( is_dir( $file ) ) : ?>
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
							<?php if ( empty( $nginx_sites_available ) ) : ?>
								<span class="list-group-item">No sites</span>
							<?php else : ?>
								<?php foreach ( $nginx_sites_available as $site ) : ?>
									<?php

									/** Reads entire file into an array. */
									$site_file = file( $settings['nginx']['path'] . "/sites-available/{$site}" );
									foreach ( $site_file as $line ) {

										/** Search for the line with the ServerName. */
										preg_match( "/server_name\s+(.*);\n/", $line, $server_name);

										if ( isset( $server_name[1] ) ) {
											$url = "http://{$server_name[1]}";
											break;
										}
									}

									/** If there is no server_name, set a common URL. */
									$url = isset( $url )
										? $url
										: home_url( "/{$site}" );

									/** Check whether the virtual host is enabled and set set a label. */
									$status = in_array( $site, $nginx_sites_enabled )
										? 'success'
										: 'danger';

									?>
									<a class="list-group-item" href="<?= $url; ?>">
										<span class="status status-<?= $status ?>"></span>
										<span class="filename"><?= $site; ?></span>
										<span class="url"><?= $url; ?></span>
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
							<?php if ( empty( $apache_sites_available ) ) : ?>
								<span class="list-group-item">No sites</span>
							<?php else : ?>
								<?php foreach ( $apache_sites_available as $site ) : ?>
									<?php

									/** Reads entire file into an array. */
									$site_file = file( $settings['apache']['path'] . "/sites-available/{$site}" );
									foreach ( $site_file as $line ) {

										/** Search for the line with the ServerName. */
										preg_match( "/ServerName\s+(.*)\n/", $line, $server_name);

										if ( isset( $server_name[1] ) ) {
											$url = "http://{$server_name[1]}";
											break;
										}
									}

									/** If there is no server_name, set a common URL. */
									$url = isset( $url )
										? $url
										: home_url( "/{$site}" );

									/** Check whether the virtual host is enabled and set set a label. */
									$status = in_array( $site, $apache_sites_enabled )
										? 'success'
										: 'danger';

									?>
									<a class="list-group-item" href="<?= $url; ?>">
										<span class="text"><?= $site; ?></span>
										<span class="status status-<?= $status ?>"></span>
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
