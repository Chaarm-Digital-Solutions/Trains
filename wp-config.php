<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Trains' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ijwvIqO5SQrngECtjCTkUE4OcP2PdwZ277V9GqgP3UCs95t3wJjFXaVYccsdBDBo' );
define( 'SECURE_AUTH_KEY',  'YQIawIuSkZpSv4yF7Tic2MmsASsaRYynhDF6sJI2MX4ouDkWjl4ZMR17NnhB2iCU' );
define( 'LOGGED_IN_KEY',    'uTZeCSSQES9BQoKDTc3Jtqe1amWcKRRH4kWZexJdLwSkKNVLqgOxzxLtITtTULNB' );
define( 'NONCE_KEY',        'PAPWGZ0PRsB5KBSCLod6rROHyFAdkMoAUs8gpo5kpyqhBfZDPckT7ZVJZUg5v5AI' );
define( 'AUTH_SALT',        'P0VSmZ9uuPLZaqrJF8inNGVY7uESWuAvdf5ReVi83FfXRhpbVNH3Bsw5zafzxq8V' );
define( 'SECURE_AUTH_SALT', 'yNSrdRwZlhXCjgncWc7awBzVvrFQYQ871dHka5XHI14LITZvAVZ75gXzNntfnpxA' );
define( 'LOGGED_IN_SALT',   'dM9Qgrd57rn4UFQqjsNdXM3by88E7NkfZcVLikd2oCOrIZOzmmYdIk1nwIslPWb1' );
define( 'NONCE_SALT',       'FwW2hcZpbZBnLy9fXTkv4NePMd6WyPevike7j5kn9aAn0cyEA3bdath2oRWcryu8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
