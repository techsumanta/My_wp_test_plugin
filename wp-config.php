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
define( 'DB_NAME', 'my-plugin-test' );

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
define( 'AUTH_KEY',         ':>]!Buk3%J?{IV?*%h;>lh&b{l?PrH4NLSs&rIN6P#f@N?0wf(L:cYnjv|WT4b2|' );
define( 'SECURE_AUTH_KEY',  'ykVKE#):ka,r[{`7Wf,&9[#}F[Uz-4~h0Q^(b!T^O}]Ja^{EJ;{b6dT2&JOJsQ!n' );
define( 'LOGGED_IN_KEY',    '-XLrNeJu^9b=&Fw31lTY(mc>*D5jk[$7{8?:sK=VR&FJw8/iQaY%A7WOx+GhzAx*' );
define( 'NONCE_KEY',        '2aZ94N.&7s1lk3Oz/[KM^w!N,k)#kyd58b&0V|*Ux$P<O]60%d/siY;O~Xs3YTd^' );
define( 'AUTH_SALT',        '~HzsBcxP!FR]d8hO);)eKYKc?J@@,71f~pc7>1<V:``PE0yP/bA6b:u6m#F6?mJ,' );
define( 'SECURE_AUTH_SALT', 'GdOa8or5)np{|vanGL!bZT-n.O$xuTq8HKWuz93feW=j[IJkn~$$-4AFK=Jz6ilg' );
define( 'LOGGED_IN_SALT',   '35Bg-+6/Q,1Cq~9n*mo[PEeT/{E@tIfNGyc_A7tZE|o~M%`l/l$0iZ*<2bTW7x/,' );
define( 'NONCE_SALT',       '_^>&B<I77D8RdD~R~(1|G$VF?.{Ck@d8DD$%}lQJbOdGq^O^->&p},#pGaNS52pG' );

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
