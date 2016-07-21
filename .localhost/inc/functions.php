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
function get_files( $path, $ignore = array() ) {
	global $settings;

	if ( ! file_exists( $path ) )
		return array();

	$files       = array();
	$directories = array();

	$pattern = $settings['show_hidden']
		? '{,.}*'
		: '*';

	foreach ( glob( trailingslashit( $path ) . $pattern, GLOB_BRACE ) as $file_path ) {
		$file_name = basename( $file_path );

		if ( preg_match( "/^\.{1,2}$/", $file_name) )
			continue;

		if ( ! in_array( $file_name, $ignore ) ) {
			if ( is_dir( $file_path ) ) {
				$directories[] = $file_name;
			} else {
				$files[] = $file_name;
			}
		}
	}

	sort( $files );
	sort( $directories );

	return array_merge( $directories, $files );
}
