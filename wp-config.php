<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('FS_METHOD', 'direct');


define( 'DB_NAME', 'production' );

/** Database username */
define( 'DB_USER', 'user_atlantic_db' );

/** Database password */
define( 'DB_PASSWORD', '^v07X4DevbI?' );

/** Database hostname */
define( 'DB_HOST', 'dbproduction-instance-1.cr1kuwmr3ntp.us-east-2.rds.amazonaws.com:6969' );


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
define( 'AUTH_KEY',         'TW!Uc05st;JH^|81^Du*Xdf7xPs^`=- zN23?A)T{-h0#_]_E>#TZp!7&UGOs8.X' );
define( 'SECURE_AUTH_KEY',  'F37jf!I3W}#uCuf*nJJ);W/uDR@w=1ns/eK<;j%cuuxQ&YleRz9;-gvK:9OC>`#W' );
define( 'LOGGED_IN_KEY',    '9-gBZX7y4Epw(s2]{go}oDrTl{ZubBOYC@[ojw kNtb?FQZ&_*9xj|1 j^4*{]lW' );
define( 'NONCE_KEY',        ',??ft2xzPC! 2=5Pcke{3#@|2UtkdQAYBwYcm9R2V*:MC_}.8fu5WX5>Gi)j/-0|' );
define( 'AUTH_SALT',        'Z+[@&&H3fdA%Qw)H*),c*U-5}7VMrvyQ<ahS~Gc(i{+c4tZ}W+}CuMqW}Akx)^&J' );
define( 'SECURE_AUTH_SALT', 'qDhL63G@kH7T_x?u67V+7L22wqo]q6W#3?<9k^(+J5268%+LZH^*vvO>Zd2xLDPp' );
define( 'LOGGED_IN_SALT',   'nS-KXpqmvAA*$fjEsPou+$cS7lh<=FGk `;OUG~E{n!60KxNq6%N_f*Pq=vyjG.l' );
define( 'NONCE_SALT',       '$#CC}wX3p8kU:dc@Ako?rifp{=Z?>Nh9qIqE-?&I!+*hc%Z0J0cy 5.bSL1OAZ3E' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'at_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
