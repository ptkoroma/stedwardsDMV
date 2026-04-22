<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * #ddev-generated: Automatically generated WordPress settings file.
 * ddev manages this file and may delete or overwrite the file unless this comment is removed.
 * It is recommended that you leave this file alone.
 *
 * @package ddevapp
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pkoroma_nvbt1' );

/** Database username */
define( 'DB_USER', 'pkoroma_nvbt1' );

/** Database password */
define( 'DB_PASSWORD', 'E.iYnz5sfkdqYnTVmmx23' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Authentication Unique Keys and Salts. */
define( 'AUTH_KEY', 'mjZLYDTiqHHoNxSiziIRRhDQxSYlDHQQKglxWlqGMppoDIOowopAvfxDqTlMhCLa' );
define( 'SECURE_AUTH_KEY', 'uoiXWAdWzRuPhVjpkpVECmstYzSGczhBSSCbGVzHoqlxctwSDyHHAQKbdkCMbuil' );
define( 'LOGGED_IN_KEY', 'slKBBOyNEIcQTfBjnKmHeAktzoRVCWRTYuPoVamSIFKCfUKOJBTdYCGInrnkaTiO' );
define( 'NONCE_KEY', 'mBjjGRoOUFavPiMCkRFGRuKfPwAWpAgbosnzOYjxYbyzNROoWIxQbBvffZfNfEcd' );
define( 'AUTH_SALT', 'jvKqWaGojFxbKyFnAiVlXaefkzHjeFDjOWIEMSZIAVBePFLOkBftqqmRazyaqNob' );
define( 'SECURE_AUTH_SALT', 'KtyyjOmIdfzavbrPUNhqcJmCnNQBesEgJmMplBpogKtKQIhtlXiLPQDTdjDVydJK' );
define( 'LOGGED_IN_SALT', 'fMRhnFoiZrLijDKoBNyFulFcuWAScyEqZuMjyQrtlHbBdaLyqlntOARltzNvElCa' );
define( 'NONCE_SALT', 'udefJsmjLMkSxGfOSUJBFFbWvZfBlQHulpypWNoRardKNgYYjEcQGmHzYWOrAlgh' );

/**
 * Other customizations.
 */
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'rg5x_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
