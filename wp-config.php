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
define('DB_NAME', 'wp_shop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ' ]e.fs3`ggN7v{3u]=>h_TL=5*1JYn`|R-Z~7F;dN}]ciA?MS2RYXj|o>R )dIC*');
define('SECURE_AUTH_KEY',  ';S~4$x3Iz.y[-,[9{+{xHc8)uqz<e9?s2:xPthKq$Q?HD>YLiynU1#_v=`mT7uOh');
define('LOGGED_IN_KEY',    'Lw(oFOp/JaPN]{|&?M<4A>RNY<==_RIL)QOIb[LJw pX ?eqi#zJp<A*&f<htBr]');
define('NONCE_KEY',        '9h5|%?q9ZtTK/r=<PmGQ>9D W}SwBA7x mJx`7?1Pmu<tL!EH>sTU=($t]sR<1}K');
define('AUTH_SALT',        '.lQ1~gV9kiOo}o.A3z,MA&xlPNo|.+N lU_Yu?$5P7*@%mCS<a=^1fdTStbFSaww');
define('SECURE_AUTH_SALT', '=*8Af,s>}mZ0ISP;kz09Qk|X]TXlD!bJRx@k:xj@`FFUy5X0MC-=95}S>M{XIK2{');
define('LOGGED_IN_SALT',   '9_3cEcYxY2-%tl@$S[oa,!5 zL8bLKm c#~8]Ji%*K#MKhrZq`|Sv>k^=^aWM$i,');
define('NONCE_SALT',       'KLEGkp}sB:7(x[MVe6SaECT*N,sMvZE}RZ~{V wzA^a4[&!nhbu4G$U97Z=16!4u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
