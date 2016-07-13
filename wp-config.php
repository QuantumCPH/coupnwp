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
define('DB_NAME', 'couponwp');

/** MySQL database username */
define('DB_USER', 'homestead');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

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
define('AUTH_KEY',         '>{$WTrt&5fqKj9sf-%tb1btbcWKbO6Lfq^MNVpSeQ^#?K*Lq,7fNQ)6JM8CTps:W');
define('SECURE_AUTH_KEY',  '(]zVX&N?LGKoIX{~HM(qgRQ#Ab)F+P)n~;`6b$m0a`XfysN(K;RFIh^noq~LuL3|');
define('LOGGED_IN_KEY',    '!+J$iTq=f4Y}:msIZp{b_bI8q Fk33lFl8YkHA{`]8_dw yp60fb&5I>{,zsK>Gn');
define('NONCE_KEY',        '(f6q`A+RZ>_P2zjkBit(-H$*Fs`1~C(o%Jmbjis4#AVR>]Y>!Y;IH>F$q!Z.R1eN');
define('AUTH_SALT',        '4^h:00kn{4}*45VBCxvZLh_nj}7rgt fsl:_*.rm(=6cbO$7#0B:u=x[;#WBlCR+');
define('SECURE_AUTH_SALT', '.E=</$d<N~U(XC}BrHKuEu~=h$>!N;?76Bz<YJB}irf]I}c#<j^x(0(I&,A7Hc7e');
define('LOGGED_IN_SALT',   'Yf@{F|AL@-kk#Dt9X3iYGnk3F&rF*SX{Znyl}@D&i@[ t_O@aw*m%6.l7LPyiNT.');
define('NONCE_SALT',       '4@_AM-%DSQW<&]PER.gZRiUc0A1z#;{Zp*}Q]MCwv~6!OR>YafXf7H4woDcxN=vr');

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

require_once(ABSPATH.'vendor/autoload.php');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
