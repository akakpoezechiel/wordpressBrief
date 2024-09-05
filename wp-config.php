<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressBrief' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '{1UWR3EZz.;*>p6wG~TfKP+g$@L G,$IQc!j@k [n<(0m-iL?CQ~?=%EO&[xUfiX' );
define( 'SECURE_AUTH_KEY',  'E+~_:H|7rdZ`xcKBlFd9*^^)|&A #G981&}D/A28mh8r+@f$/Ct`Now}41Z7$YDh' );
define( 'LOGGED_IN_KEY',    'c@*5cSy?5v4x9${P:D4ob6,l6afBagII$L+t&`<v/}~*o<13Zoqm*%RvZAZdNk)R' );
define( 'NONCE_KEY',        ' Ui<_;Q=(qWuWrlTWU_nQ[|!po[x<SBs,Q)_>OIMU4bt?w|Jd[gYJoKm5/N|%0`1' );
define( 'AUTH_SALT',        'j#i1R0$X&y)x/W]55xnQB,067a>5Oz0qgq~ztdcaz`Zt9{&_J]G{HA*Pyw.Jr|dO' );
define( 'SECURE_AUTH_SALT', '5[,7.Z^/;9~nSH3S<KPIJMsw=dKxB8hY%dj*G.P/3$l}eXG*-bxu/dKaF_q_QyqH' );
define( 'LOGGED_IN_SALT',   'R[fN(+_)a7fVAwwduMrAbL;aTiJ-P{:xtSNVC+h&aDv90%lx|XI+7iY{&|Ao%>to' );
define( 'NONCE_SALT',       'ae?JQU3>,`X<O,&!nrk-UU61l&`ely[MzjwLf=s~9=S HpV/PZQrB*vvSPQy9P$m' );

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
