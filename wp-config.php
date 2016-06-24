<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'client_nabawp');

/** Имя пользователя MySQL */
define('DB_USER', 'nabawp');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'kRsEKTtBeD');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' ]k:7UzWtHt<W_OwXN[LK+zAH_]Xl8xs%w3dTX88{vJdzZ3Aw7:6^^XbenvoG=[f');
define('SECURE_AUTH_KEY',  'uOV@1G> #Q~H(p;&TL,]NP(Glp9G$*{S <(|jcjdau^C/_>gcswT0T_<,Y|R+lGz');
define('LOGGED_IN_KEY',    'h+D2XcXQ#i_5@(<Q,x`Hg Ab0>m&?P{3ImRBVD,D2w8AjH.cx*lGAq[e?#j2]/|3');
define('NONCE_KEY',        '62JEs~?2gySdW-HH]6-4S|=cMU#c[J5>)(&hPanJp7I}eT@B,3sZej}C AUhdEK@');
define('AUTH_SALT',        'JOW 5z{-HPP>Kl>rBw6AzOJ*_1)SkH/Iwa}<n4M8x#$gQ.Ev?(=`?zP#Kz8vH[lz');
define('SECURE_AUTH_SALT', 'W${Vn0+eR-l=jA%~Mt=GDner~=&rbf6Cl%^iuk9Jt`dw%&CiC .|x)o{9^6d2[)b');
define('LOGGED_IN_SALT',   'Ua39XwnBfhYO~KIhbn=A(H=hkWk]37nD[t+PEWGWV>yrwK}PRARQ2D 5$vkkgVf6');
define('NONCE_SALT',       ' rZom@zuw.5,>HyfTVOJHhE`fLj$5Bga%tNuatA$gSafAE8Hsi3>oP6=.m~A56ql');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
