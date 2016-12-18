<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'plugins');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'X*O?*x{1~m1)jna[bxpmFRWfDpp?kkr8K+<Z1o-6qon}z9Ng+lKi/3PF72A-FGbO');
define('SECURE_AUTH_KEY', 'aHGf7,oJ[w$fCRR_Gt7N-|uS31lk47)TJ98QFh:Y;aRW:#KZm5zBrcq*3dzoj?;R');
define('LOGGED_IN_KEY', '%tbfuhI_*mI3#5g^>2P9CpAqVDfDWPr)X NsdZ>;b7}:)Y&DH)GilGp[[Lp`GsV#');
define('NONCE_KEY', 'l?(Ik}W_C*@C%kQIT>6Awh8 +.q@g=Z8-C3D:yK_$aPGvP1- ?{yu!5[ Q<)~}Yc');
define('AUTH_SALT', '@<G&pIg<%S}U1.yh^ksiTXTJF1l_!DqRJkKB;{zP:|u;M~[836QXwg;IE<Lkg5@g');
define('SECURE_AUTH_SALT', '<]aT$aK`sp;f56ZjN+KE Zo<Mx$-_mR_-CElO+}*G^jp0+9VCx}n~LC&WkPW%l`n');
define('LOGGED_IN_SALT', '*|1nkLTho&{~}zS4S3;L30kz!UHCNg2Pu)/yMtaok$CueO^I>w7,eP:rIPkYF:kh');
define('NONCE_SALT', 'p&([4j40.-:RutcyRp}~MxL?@-HN8CFVkKP9ipO8?LH2&D6w5{KpdKjdFY-eb0t`');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'plugins_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);
define( 'WP_MEMORY_LIMIT', '256M' );

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

