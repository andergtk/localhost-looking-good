<?php

require_once( 'config.php' );

/**
 * Initialize variables with an empty array
 */
$files           = array();
$directories     = array();
$sites_available = array();
$sites_enabled   = array();

/**
 * Checks whether the request is from a subdirectory
 */
if ( empty( $_SERVER['REQUEST_URI'] ) ) {
	$subdir = '/';
} else {
	$subdir = trim( $_SERVER['REQUEST_URI'] );
}

/**
 * Pattern to don't store hidden things
 */
$pattern = '/^\./';

/**
 * Stores the name of the files
 */
foreach ( glob( PROJECTS_DIR . $subdir . '*' ) as $file_path ) {
	$file_name = basename( $file_path );
	if ( ! in_array( $file_name, $ignore ) ) {
		if ( is_dir( $file_path ) ) {
			$directories[] = $file_name;
		} else {
			$files[] = $file_name;
		}
	}
}

/** sort and merge them */
sort( $files );
sort( $directories );
$files = array_merge( $directories, $files );

/** Stores the sites available */
foreach ( glob( APACHE_DIR . '/sites-available/*' ) as $conf_file ) {
	$file_name = basename( $conf_file );
	if ( ! in_array( $file_name, $ignore ) ) {
		$sites_available[] = $file_name;
	}
}

/** Stores the sites enabled */
foreach( glob( APACHE_DIR . '/sites-enabled/*' ) as $conf_file ) {
	$file_name = basename( $conf_file );
	if ( ! in_array( $file_name, $ignore ) ) {
		$sites_enabled[] = $file_name;
	}
}

require_once( 'header.php' );

?>

<div class="column">
	<div class="panel">
		<div class="panel-heading">
			<?php if ( '/' !== $subdir ) : ?>
				<a class="btn-back" href="<?php echo HOME_URL . dirname( $subdir ); ?>" title="Go Back"></a>
				<h3><?php echo ucfirst( basename( $subdir ) ); ?></h3>
			<?php else : ?>
				<h3>Projects</h3>
			<?php endif; ?>
		</div><!-- .panel-heading -->
		<div class="panel-body">
			<div class="list-group">
				<?php if ( empty( $files ) ) : ?>
					<p class="list-group-item empty">No Files</p>
				<?php else : ?>
					<?php foreach ( $files as $file ) : ?>
						<?php if ( in_array( $file, $directories ) ) : ?>
							<a class="list-group-item is-dir" href="<?php echo HOME_URL . $subdir . $file; ?>">
								<h4><?php echo $file; ?></h4>
							</a>
						<?php else : ?>
							<a class="list-group-item is-file" href="<?php echo HOME_URL . $subdir . $file; ?>">
								<h4><?php echo $file; ?></h4>
							</a>
						<?php endif; ?>
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
					<p class="list-group-item empty">No Virtual Hosts</p>
				<?php else : ?>
					<?php foreach ( $sites_available as $site ) : ?>
						<?php

						/**
						 * Reads entire file into an array
						 */
						$virtual_host = file( APACHE_DIR . "/sites-available/{$site}" );
						foreach ( $virtual_host as $line ) {

							/**
							 * Search for the line with the ServerName
							 */
							preg_match( '/ServerName\s+(.*)\n/', $line, $server_name);
							if ( isset( $server_name[1] ) ) {
								$url = "http://{$server_name[1]}";
								break;
							}
						}

						/**
						 * If there is no ServerName, set a common URL
						 */
						$url = ( isset( $url ) ) ? $url : HOME_URL . "/{$site}";

						/**
						 * Check whether the virtual host is enabled and set set
						 * a label
						 */
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

<?php require_once( 'footer.php' ); ?>
