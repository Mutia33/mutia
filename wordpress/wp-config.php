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
define( 'DB_NAME', 'db_wordpress' );

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
define( 'AUTH_KEY',         'S[kM6P@gL8;_,DtH>Q0B7H+4z}`oCR#1dek0|Q7<s;N<h,&1b<jVPpI3e@:588mD' );
define( 'SECURE_AUTH_KEY',  'zil 8=cTTg&xG$ch59.Bf1KvgWp:GQW65eKl V97MyAYx6Ep6z1j/d-<oKIhXe+k' );
define( 'LOGGED_IN_KEY',    'ObhBrZjnM|{L-#*E`1yvjK,*aw V-<h*L!}B%J}=4][N_RXDbdG*D[:^!f#v`k+%' );
define( 'NONCE_KEY',        '[Xfxb!&/.(ln^e!o]`Ze%;,zk_([I:,x6gE-k9,g#r=8z#CT)C`; g{t}:u8Qt;}' );
define( 'AUTH_SALT',        '5KZ6+3`K~=;}z-s2JMF@KR)l%#xEcQ>68ZY?M)}[ss9G~XXo`7^RI<C{~)*K{gVc' );
define( 'SECURE_AUTH_SALT', '(BlT8y*{wDIZi+qml_Y&FLrrB3v2Sm>9, M!!j8qYDpAN~DRS~@+l<l|4(/~UG6m' );
define( 'LOGGED_IN_SALT',   '8(Lt-wPR3|*4NCq[&X9GUBC5N]|#g05K*}rERbx:sL*C`gNz:zr5@f4 ;bio]oo>' );
define( 'NONCE_SALT',       's7^=|Q5nR+MqEC[0<oPR6dh|)2*U`=Vl6%peR!KEMMOA0^e]8;fH9eqi|b6ov6rz' );

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
