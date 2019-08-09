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
define('DB_NAME', 'include5');

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

/** File method direct for adding plugin */
define('FS_METHOD', 'direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'r}U@&KA_C;*>+_Z#_f+X!s$wYVBWgc~$=d(E#W^0!=zUf4qwjx{!B[g,N%]Y,}3Y');
define('SECURE_AUTH_KEY',  'SgGu>/#+iy;5%vl%rD~xn4$Ps 2NiWim-W%cnA~|o!r h2cJE]|MB^Iqc2B39[?N');
define('LOGGED_IN_KEY',    'k:f?cXDlGq. }~ m6c-)9+@u;m_2&gYV*jm[m44PkDpk(B`1~q3tBc/vl7ySQs1R');
define('NONCE_KEY',        'nzPmyF2AT?n(;>AP0[yWkqN;L?ttf1MLq5k?eDFRLhTZTup&.]bCxZQ?FOelm!mq');
define('AUTH_SALT',        'fM%ll3Lb>@XE_@t!c-J`DRjEW!>$3u1R,Fiti6uf)YYQ4<#jJ9@]dXk{#@#C/(u!');
define('SECURE_AUTH_SALT', '.{OfWf[eyC9imNgRf*`1?R43af]U,Z5Fug$d@lA}D9}tA8], Xo:j@jSc`8AZGzE');
define('LOGGED_IN_SALT',   'B.GMp4.=Mt#@O<J:(e9eF#c%%Kzm+n u3o1S)Y;O[[$$xa]2G+>t&i[n&(LAfT8n');
define('NONCE_SALT',       'Otq7cI8r2%^wGWhqDJ`qUU2#{`:ik<{TLO!JG`3:s Zc20$r.aoQ1~oDrF%G2c-z');

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
