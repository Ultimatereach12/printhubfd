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
define('DB_NAME', 'printhub');

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
set_time_limit (600);
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'tn6nbC=|!q`![_[3E5@_*vPwv7Rg,!jnL;IS0w$#l1/a9$JPmc*9,vr3@7( r,^T');
define('SECURE_AUTH_KEY',  ',m2, TM;4WHeOVX.kf9T)LF5 q_TMHJl;>#<1/m%<=Q94T1m*B65[>Rq{+x;hVs&');
define('LOGGED_IN_KEY',    'WbAEe}E<R8KofFr;{GBFBKNX-iH3Dq?!pIm)]qA}D*^X*)n0,4z_eE6[8 !uV&?|');
define('NONCE_KEY',        't5g.R- ~gTNb{0TV%DZ:)X.#f?}i>4;xaD3x?tiN4VXV:_CuMunVVF5aL4|y+G-z');
define('AUTH_SALT',        'lA%:}e|qDzN]tzoPkIlo+#iNYSD)Z]O.GvG_T?k*#m~8@%@3lug_~9VYX*RKLC$Q');
define('SECURE_AUTH_SALT', '*K^sp$FX##JQ8_xU>tRTTL6XqET:i3-j$HRR$Q,aqH470|#5FVio?CExt^E$%sd7');
define('LOGGED_IN_SALT',   'nJs=<fYqbX*WNO,xNgZlr RX77=}(pOte1d4]#q1IxOnrP]|29CVZT_7P-`JgQn<');
define('NONCE_SALT',       'S7M`T7.:+ZP]k-I8ZlX>n=A~?RnhcL(e^_42ny_(sv|U)!.xoQ9).,Tx>Zjq{[P&');

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
