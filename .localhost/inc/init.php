<?php

session_start();

header( 'Content-Type: text/html; charset=UTF-8' );

require_once 'functions.php';
require_once PATH . '/.localhost/lib/FlashMessages.php';

define( 'SUBDIR', ! empty( $_SERVER['REQUEST_URI'] ) ? trailingslashit( urldecode( trim( $_SERVER['REQUEST_URI'] ) ) ) : '/' );

$msg = new \Plasticbrain\FlashMessages\FlashMessages();

$settings         = array();
$settings_file    = PATH . '/.localhost/settings.json';
$settings_default = array(
	'home_url'     => "http://{$_SERVER['HTTP_HOST']}",
	'phpmyadmin'   => '',
	'show_hidden'  => false,
	'ignore_files' => array(),
	'theme_option' => 'default',

	'nginx' => array(
		'enabled'      => false,
		'path'         => '/etc/nginx',
		'ignore_sites' => array()
	),

	'apache' => array(
		'enabled'      => false,
		'path'         => '/etc/apache2',
		'ignore_sites' => array()
	)
);


if ( file_exists( $settings_file ) ) {
	$settings = file_get_contents( $settings_file );
	$settings = json_decode( $settings, true );
	$settings = is_array( $settings ) ? $settings : array();
	$settings = array_intersect_key(
		array_merge( $settings_default, $settings ),
		$settings_default
	);
} else {
	$settings = $settings_default;
}


if ( ! in_array( $settings['theme_option'], array_flip( get_theme_options() ) ) ) {
	$settings['theme_option'] = $settings_default['theme_option'];
}


if ( ! empty( $_POST['settings'] ) && is_array( $_POST['settings'] ) ) {
	$new =& $_POST['settings'];

	$settings['home_url'] = isset( $new['home_url'] )
		? untrailingslashit( $new['home_url'] )
		: untrailingslashit( $settings['home_url'] );

	$settings['phpmyadmin'] = isset( $new['phpmyadmin'] )
		? $new['phpmyadmin']
		: $settings['phpmyadmin'];

	$settings['show_hidden'] = isset( $new['show_hidden'] ) ? true : false;

	$settings['ignore_files'] = isset( $new['ignore_files'] )
		? explode( "\n", str_replace( "\r", '', $new['ignore_files'] ) )
		: $settings['ignore_files'];

	$settings['theme_option'] = isset( $new['theme_option'] ) && in_array( $new['theme_option'], array_flip( get_theme_options() ) )
		? $new['theme_option']
		: 'default';


	$settings['nginx']['enabled'] = isset( $new['nginx']['enabled'] ) ? true : false;

	$settings['nginx']['path'] = isset( $new['nginx']['path'] )
		? untrailingslashit( $new['nginx']['path'] )
		: untrailingslashit( $settings['nginx']['path'] );

	$settings['nginx']['ignore_sites'] = isset( $new['nginx']['ignore_sites'] )
		? explode( "\n", str_replace( "\r", '', $new['nginx']['ignore_sites'] ) )
		: $settings['nginx']['ignore_sites'];


	$settings['apache']['enabled'] = isset( $new['apache']['enabled'] ) ? true : false;

	$settings['apache']['path'] = isset( $new['apache']['path'] )
		? untrailingslashit( $new['apache']['path'] )
		: untrailingslashit( $settings['apache']['path'] );

	$settings['apache']['ignore_sites'] = isset( $new['apache']['ignore_sites'] )
		? explode( "\n", str_replace( "\r", '', $new['apache']['ignore_sites'] ) )
		: $settings['apache']['ignore_sites'];


	if ( empty( $settings['home_url'] ) ) {
		$settings['home_url'] = $settings_default['home_url'];
		$msg->warning( 'The Home URL can not be empty. A default value was set.' );
	}


	if ( $settings['nginx']['enabled'] ) {
		if ( empty( $settings['nginx']['path'] ) ) {
			$settings['nginx']['enabled'] = false;
			$msg->error( 'The Nginx path can not be empty.' );
		} elseif ( ! file_exists( $settings['nginx']['path'] ) ) {
			$settings['nginx']['enabled'] = false;
			$msg->error( "The Nginx path \"{$settings['nginx']['path']}\" does not exists." );
		}
	}


	if ( $settings['apache']['enabled'] ) {
		if ( empty( $settings['apache']['path'] ) ) {
			$settings['apache']['enabled'] = false;
			$msg->error( 'The Apache path can not be empty.' );
		} elseif ( ! file_exists( $settings['apache']['path'] ) ) {
			$settings['apache']['enabled'] = false;
			$msg->error( "The Apache path \"{$settings['apache']['path']}\" does not exists." );
		}
	}


	if ( ! $msg->hasErrors() )
		$msg->success( 'The changes have been saved.' );

	if ( ! file_put_contents( $settings_file, json_encode( $settings, JSON_PRETTY_PRINT ) ) )
		exit( 'Error to save settings in the file. Check the file access permissions.' );

	header( 'Refresh: 0' );
	exit();
}
