<?php

namespace CNPTemplateLibrary;

class Autoloader {
	public static function load( $dir = null ) {
		if ( ! empty( $dir ) ) {
			self::load_directory( $dir );
		}
	}

	private static function load_directory( $dir ) {
		if ( $handle = opendir( $dir ) ) {
			while ( false !== ( $entry = readdir( $handle ) ) ) {
				if ( '.' === $entry || '..' === $entry ) {
					continue;
				}

				if ( is_dir( $dir . '/' . $entry ) ) {
					self::load_directory( $dir . '/' . $entry );
					continue;
				}

				try {
					$fileinfo = pathinfo( $dir . '/' . $entry );
					if ( 'php' === $fileinfo['extension'] ) {
						include( $dir . '/' . $entry );
					}
				} catch ( \Exception $e ) {
					error_log( 'The following PHP file could not be auotloaded:' . $dir . '/' . $entry );
				}
			}
			closedir( $handle );
		}
	}
}