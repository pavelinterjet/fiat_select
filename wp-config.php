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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fiat_new' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '6L:xC<&)R%]bSPxzKY0QFCd &OKa@ob_x M[6;g[w@NOqr0zPRpv52y$)M=+:kYf' );
define( 'SECURE_AUTH_KEY',  '{[1~er_|jGLhPVk/+QnKTR1;*M2 rNl!4}}@Xz QP{KQI@RsO#HL+{J4Bu_qAbTO' );
define( 'LOGGED_IN_KEY',    'm#!El$.W%s1itDLE*`Hcp*JUY`P ~)<`LjV]=Jpns/MQ+Qwt&#OlGk>[I#,UFAiQ' );
define( 'NONCE_KEY',        'RkI_q.=sXj{1S@2su[J+H?w5>o~RFpRa{sj3PnNy}Egb@VuUL9Tby~f6+db=Lr* ' );
define( 'AUTH_SALT',        'O{*X;%O>t5`?ra1v.}:P*Z$FN$AiZIO!W)8S/G]SHmxx7pL5Utm4a_(fEHMkBpa`' );
define( 'SECURE_AUTH_SALT', '|V$3+paoS$l]=u~.H^6zo{ydt1XAWo9(PHy-xIS;|iS#SPtQ?HwvyH_90?60H!%^' );
define( 'LOGGED_IN_SALT',   '#FUM7Uf h+<9e.aQfs6g:|`d5L,vPjd <#hW@=v-]|.- 3k.X6yByoS?<V<oZ^>L' );
define( 'NONCE_SALT',       '|4l7XXPphs]3>LF.#!a7Izju J~8%q<&Zm+M;pU9^kyb)gyP8PP9[RkJ=FlNap!_' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
