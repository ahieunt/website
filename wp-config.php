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
define( 'DB_NAME', 'website' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'IL!_23;+rtn8peyt0RXi31Or$$:I}K$uIsmEp5$^aadWJ|vq@(fngT/VOWJ>B1sX' );
define( 'SECURE_AUTH_KEY',  's{9u0k[WJhq65QQ/G@M3QWQFh[S7wizCO#wl+6n.b]z[^b*Vu!(MK!KbcQz 5T-z' );
define( 'LOGGED_IN_KEY',    'MX^[QJoS!Z&<=DV4S[$w228J[!vmq[kfNPy|5G%*T^Te:1on|Pnm9&Q c<;;~Yf$' );
define( 'NONCE_KEY',        '`7J$PZ8xGS[[ ;;57n&{-<5O*D`m2QQGvC%A X@(rVR|?,!]qj~d)R n@~hVx~V[' );
define( 'AUTH_SALT',        '#4tn&wFXsLner%k.>gCTIqy]PAdyf81(#^!W4S@CE2$q4?},?IdnYp+!rE?dL[hu' );
define( 'SECURE_AUTH_SALT', '8&8MJJiv7q;#f4DaSw*^NEQ>_b];]@OoXTc*bObK)i^<e1z}QyY_p)KU*LSq1R-H' );
define( 'LOGGED_IN_SALT',   '/r]nOB2kcFFUX7Ifw(svf;;FN8-0&qa tA,r4TeVH?VG4JkZLE^k)_JF_?B,z*=h' );
define( 'NONCE_SALT',       'h*.u.4(Pq.$}q]-;ess^Jen_f}KJNjl$mP41X#(p$|+t-p6$8^4Mp4=4U^zJtyez' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
