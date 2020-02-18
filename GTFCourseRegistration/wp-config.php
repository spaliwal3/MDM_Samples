<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'georgiat_gtf');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5CedjKLaMV1CU-&XMSSDLk69UMTksa5b?Ql@V+NS!%ON!g{/Z2-%(&x{-A706<-N');
define('SECURE_AUTH_KEY',  'Qhqv!MAmMF9qY(-r&z/za+}gSn@.dA:<~^TJ16LF8V`+N{-VPl3#QJ!-L+,b1%Zq');
define('LOGGED_IN_KEY',    '$#F;yTHg^p(r-Ar*%Z;Vyg-8<X*3q &6Q@u@3NLa?x~%<8o@vdUK{K-VX6g3]aQI');
define('NONCE_KEY',        'P;/uwb@X/W_|iTa&q*X-`)Uq|y_e~{>|?.e*OTtM-Yq# 8KKH[hp0<SD_U}<$K|^');
define('AUTH_SALT',        '}11 MTZLhMOWSez]b$z3,|JfUj]K`O5SmM:O=Ecy.b|uFGe3c.*J(T`&d!f02t2B');
define('SECURE_AUTH_SALT', '1Ir9HnQwnTPbcCjz~!,|u.WM,l,-4J|k_QZx}DeD]i3rA(gTn;>;|:,IJ-@+(,;A');
define('LOGGED_IN_SALT',   'zZ#!K|rvAI.)}@!ly`iCWBDis-;+<PioqM;7J%%TD}9dfnO*3[lp0~j!>_XuH!n|');
define('NONCE_SALT',       'v{BVmlh$TUnmYOZf?x:AaA1|z~L|_-$q/5m-&[{U@r(FmWI%zq(IV zIc/n[L9TQ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
// define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
