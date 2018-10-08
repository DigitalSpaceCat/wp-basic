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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '90p#V2F%<oH7 `D?U[ng0cOJinW[{h^WrsrfR<va?W(hH?%-<DzFm2BA~rFsS`,G');
define('SECURE_AUTH_KEY',  '~/7GQ-MM0(sz%&H(p-D?#(amGHq_RDh^xtu%rrgM.qnKw#dYwtlKkq]rUyJ@v!8p');
define('LOGGED_IN_KEY',    '0eanZ1In9hly6W)n?s-XNbG$n``4IFpxsSO:KGjQ ?gx]VNJ2Xm#R|4$z[/;z1ol');
define('NONCE_KEY',        ']MXe/2_8;f_[3CJ Art.itE00_&fLrA1,[S8v3[tbu{FX;!u_dv/_=|7s=Tb2PI+');
define('AUTH_SALT',        'p?zKfud1DoL]$eUljzH1)Uf#V|350xwteus}@I-}vqCQU$*Myo&;d7drKmEb>=iV');
define('SECURE_AUTH_SALT', '.f8{Wxw)xskvu,?sr3`Q=xE(3mzM::D7d3qc!s+pPd9dS9.GFB<n-y: Ih]PQ1w~');
define('LOGGED_IN_SALT',   'JF:<pOY@vACkPau=0lzfBqJHTkhT}`HK3W|6Ay<I:D,OnT=!d6KbJfmf B;oaV}a');
define('NONCE_SALT',       '4BFmRuO~vU5Sn3;KUfrIybn3nLX6Uc3;89v[#6?f%%)_exGkFZUwDb0+F983m`Rn');

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
