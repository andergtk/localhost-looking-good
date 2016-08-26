<?php

/**
 * Appends a trailing slash.
 */
function trailingslashit( $string ) {
	return untrailingslashit( $string ) . '/';
}


/**
 * Removes trailing forward slashes and backslashes if they exist.
 */
function untrailingslashit( $string ) {
	return rtrim( $string, '/\\' );
}


/**
 * Returns the "home_url" option.
 */
function home_url( $path = '' ) {
	global $settings;

	return $settings['home_url'] . $path;
}


/**
 * Returns the files in a directory.
 */
function get_files( $path, $ignore = array(), $from_sites = false ) {
	global $settings;

	if ( ! file_exists( $path ) )
		return array();

	$directories = array();
	$files       = array();
	$pattern     = $settings['show_hidden'] ? '{,.}*' : '*';

	foreach ( glob( trailingslashit( $path ) . $pattern, GLOB_BRACE ) as $file_path ) {
		$file_name = basename( $file_path );

		if ( preg_match( "/^\.{1,2}$/", $file_name) )
			continue;

		foreach ( $ignore as $pattern ) {
			if ( empty( $pattern ) )
				continue;
			elseif ( $from_sites && fnmatch( $pattern, $file_name ) )
				continue 2;
			elseif ( fnmatch( '/' . $pattern, SUBDIR . $file_name ) )
				continue 2;
		}

		if ( is_dir( $file_path ) )
			$directories[] = $file_name;
		else
			$files[] = $file_name;
	}

	sort( $directories );
	sort( $files );

	return array_merge( $directories, $files );
}


/**
 * Returns the sites.
 */
function get_sites( $availables_path, $enableds_path, $pattern, $ignore = array() ) {
	$sites = array();

	$available_sites = get_files( $availables_path, $ignore, true );
	$enabled_sites   = get_files( $enableds_path, array(), true );

	foreach ( $available_sites as $site ) {
		$file = file( $availables_path . "/{$site}" );

		foreach ( $file as $line ) {
			preg_match( $pattern, $line, $server_name);

			if ( isset( $server_name[1] ) ) {
				$url = "http://{$server_name[1]}";
				break;
			}
		}

		$url = ! empty( $url ) ? $url : '#';
		$status = in_array( $site, $enabled_sites ) ? 'success' : 'danger';

		$sites[] = array(
			'filename' => $site,
			'status'   => $status,
			'url'      => $url
		);
	}

	return $sites;
}


/**
 * Returns the theme options values.
 */
function get_theme_options() {
	return array(
		'pomegranate'   => 'Pomegranate',
		'pumpkin'       => 'Pumpkin',
		'sunflower'     => 'Sunflower',
		'emerald'       => 'Emerald',
		'default'       => 'Default',
		'peter-river'   => 'Peter River',
		'azalea'        => 'Azalea',
		'amethyst'      => 'Amethyst',
		'midnight-blue' => 'Midnight Blue'
	);
}


/**
 * http://php.net/manual/en/function.fnmatch.php
 */
if ( ! function_exists( 'fnmatch' ) ) {
	function fnmatch( $pattern, $string ) {
		$delimiters = array(
			'\*' => '.*',
			'\?' => '.'
		);

		return preg_match( "#^" . strtr( preg_quote( $pattern, '#' ), $delimiter ) . "$#i", $string );
	}
}
