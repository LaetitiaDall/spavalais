<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dev' );

/** MySQL database username */
define( 'DB_USER', 'dev' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dev2019dll' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ' $Ou>tYJ:<WX}z6b>IZJ*rKE`-JDZpf8m5kEnPXniwfz?POrP(D}5Xwziv#2jFni' );
define( 'SECURE_AUTH_KEY',  'ZK_vI4!0<p~k!IvH4fmI$%&uR0_5&~qRPh}CQK1V#Ox/$G1pvif6j.{g&lfB[Y!R' );
define( 'LOGGED_IN_KEY',    ')}6@1~*g3AC>xSCINEb)mOp?){8.yXyJ7 v}+v#<r:n2!-%8x7tkwO:Hg-C_Zw&{' );
define( 'NONCE_KEY',        'j&6o#Vg~oqF?a~ORkWeDfQ55JQ:.:t*x8r;o@P)9W6AS0:3?Hmg{=an~,~3ILRv]' );
define( 'AUTH_SALT',        '=yWgFDO,{-_!BugvU%@wlL!%tCzFL%n ;b OF}]jsIf&[X6IR.LBnq.G,#NBL*wZ' );
define( 'SECURE_AUTH_SALT', 'xewafUg3*}C(K[xC4&dpO6bqOB*er+]FT@iYf8AFUf-QQg]# G2ZyYY9]:9GX6be' );
define( 'LOGGED_IN_SALT',   '#KwL]If._oc*d<[WP|gi<=@fg~(jj3f]xf@d!7n,FiTQbyg3]~BV)#^UDh3u~A=1' );
define( 'NONCE_SALT',       '2,@h&Yk&G{p#X=JkgnbDjHR|EDu)@^ezhSWer>Z>RrZz@>6h5NJ!9;6,kjT*IOm2' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_spavalais_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
