<?php
/**
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro contém as seguintes configurações:
 *
 * * Configurações de  MySQL
 * * Chaves secretas
 * * Prefixo das tabelas da base de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define( 'DB_NAME', 'baizik' );

/** O nome do utilizador de MySQL */
define( 'DB_USER', 'root' );

/** A password do utilizador de MySQL  */
define( 'DB_PASSWORD', '' );

/** O nome do serviddor de  MySQL  */
define( 'DB_HOST', 'localhost' );

/** O "Database Charset" a usar na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O "Database Collate type". Se tem dúvidas não mude. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '-U8*<U^=^k-%t=U4}FIk3*7C>{z.;?xCVvciAA~j9m#88B3MtrPa}n?{qQ4!Asr@' );
define( 'SECURE_AUTH_KEY',  '+t|$O!(Vn|eYgfWs6{eUkXyvUua9u#$:-vblW3q,V`p ]y-#Utc]sJ7)wCvy> [W' );
define( 'LOGGED_IN_KEY',    'D63(5Z~L42tL0JjfIiZ~r-g+2k,sa<;%$EaI}e&h|*T>&dt4JsPNDy_Mr=PI.T=m' );
define( 'NONCE_KEY',        'V*XR[jA!WES}.ZzDe~w|7~4H}6e5u,[CjUA7Q*1?vby?~~@{h>7%~_:]|l)LUPk+' );
define( 'AUTH_SALT',        'PHi.E+rmA?*!J04}nC.d9M,GR->*4FX]3S([K1}@ec`1RqPoDGf7-lGo=YS{~,Bh' );
define( 'SECURE_AUTH_SALT', ']<B.`WDpr&~0NQZx5S]MJFGz[rr/T*djjkp1`a%7s<1<+4fRSK!X)lNo, (+Zq`K' );
define( 'LOGGED_IN_SALT',   '~-oCG!TTIj.LB]UuJkQ~B&Wz~3<]0il5k]#uks/-B^.HaFl+LgK46r9o&D6>q{gL' );
define( 'NONCE_SALT',       '-Cd&!oq0-gr7QNzXeF2*x<+m=(gzEV*ti*fnk:}~57?8fG)t>%pNjP?$wQfi8{$R' );

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix = 'bz_';

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 *
 * Para mais informações sobre outras constantes que pode usar para debugging,
 * visite o Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once(ABSPATH . 'wp-settings.php');
