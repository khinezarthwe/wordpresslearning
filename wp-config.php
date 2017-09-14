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
define('DB_NAME', 'wordpresstest');

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
define('AUTH_KEY',         'z{EfwxkQLLz8+yKH<>s!G]PpZv*P&fWwePN~6(a%!&Y$MqS!(pW^^Hb;3k}6j?jx');
define('SECURE_AUTH_KEY',  'M%NVgMHW4:~nbw@v0L/cM/u aY)?5f|U~9)4<?U7q{_`,z5^~:gZ0FUl?`%ki[y+');
define('LOGGED_IN_KEY',    'mcwa+Z5Kn_3E]>)!mg/msbbFh!20WyOPn^WHmPh>}Qyg5?|HOFl2 Sl/OVq2lLs?');
define('NONCE_KEY',        'fXp;v}f1KQ:8 5#sA)vSP$hd/46tZ$I$D .R+B%qajw]O.qe73|a?bLL6etxN{?L');
define('AUTH_SALT',        'QBQCs*Hl&jL4|Ay|e3&LWuAr:ga0Yp7A_pKw;Yd/{w0/Mj5/{}mrVDrup-@2WC=W');
define('SECURE_AUTH_SALT', '-C,.GxsQH$]YSMN0p/+4`4n/+0F;vt@lgA?U93W()V<=qAXNl2K?_SLYP=cWkbbd');
define('LOGGED_IN_SALT',   '}ETX;_CN2+%c=>P-{|%V#|;Hpd&*g{@=TjralY2pPy/fc(`??X12{tbA,wEN*r (');
define('NONCE_SALT',       '$^eO4mr70Ybp_=_1Nr:q(1W~iW/2~q_/g+D*)DXizf_yKYz3h6U&_CucX0!fO7W2');

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
