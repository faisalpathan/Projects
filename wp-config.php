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
define('DB_NAME', 'dbitmumbai');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8037');

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
define('AUTH_KEY',         'dU!(f.a@#2(zU[F|nm$k_;A~bPPQ}J)Q$<yKX);Gxb~}zz|xg9?TJ~W349bgH#n7');
define('SECURE_AUTH_KEY',  'jFjW1b@uTRp64xWWWxLrdqf%r9i :,a}pQEQAuWUa,FO~VA?w>B!kK&rmmL$v/a4');
define('LOGGED_IN_KEY',    '[$}*C-Cj7oZ^,_wuCz4VLBX$t wxh@nFh%8ZpP~bP!{Rc0X?F1D=<eh1FE{Y+3_R');
define('NONCE_KEY',        'P/K(t5fgga2)FHIT`q%^kT~7r&ys{#Kbgs[UGIQ<f`0i.8W}&U4d-yGU<(PwGkK>');
define('AUTH_SALT',        'Y@69yQh9PmF0[#n}1hQolHU2,L5T-Ie!4He=zrv~Ypp%M{~O?QV5UsgacbM{|7l>');
define('SECURE_AUTH_SALT', ';~ 7e=-{/xA4E?@.&r]ZVg$]d3oR[7Y8njyjxKs?+-QDRjX]kHkg) ;TK9OAW^&x');
define('LOGGED_IN_SALT',   'oLxyTI-o>trF]Udk}YxXRS+~*kY^rIy:.v>Y%2wKCt+`s8SZ{z+P Z,<@G[ >5^i');
define('NONCE_SALT',       '5N%ZtdH#1bnnE9Q7 Q3P@+_f~^Kx lm&2~P^vDpf-wLFLE6T0H]d1kEmO|8M58_o');

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
