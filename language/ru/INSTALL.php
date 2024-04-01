<?php

/**
*  ultimateXnova
*  based on 2moons by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package ultimateXnova
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2022 Koray Karakuş <koraykarakus@yahoo.com>
 * @copyright 2024 Pfahli (https://github.com/Pfahli)
 * @licence MIT
 * @version 1.8.x Koray Karakuş <koraykarakus@yahoo.com>
 * @link https://github.com/ultimateXnova/ultimateXnova
 */

// Translation into Russian - Copyright © 2010-2013 InquisitorEA <support@moon-hunt.ru>

$LNG['back']                  = 'Назад';
$LNG['continue']              = 'Дальше';
$LNG['continueUpgrade']       = 'Обновить';
$LNG['login']                 = 'Войти в панель администратора';

$LNG['menu_intro']            = 'Описание';
$LNG['menu_install']          = 'Установка';
$LNG['menu_license']          = 'Лицензия';
$LNG['menu_upgrade']          = 'Обновление';

$LNG['title_install']         = 'Установщик';

$LNG['intro_lang']            = 'Язык';
$LNG['intro_install']         = 'Установить';
$LNG['intro_welcome']         = 'Добро пожаловать в ultimateXnova!';
$LNG['intro_text']            = 'ultimateXnova является самым стабильным и развивающимся движком из всех подобных XNova на данный момент. Мы надеемся, что ultimateXnova будет лучше, чем Вы ожидаете.<br><br>Если у Вас будут вопросы, консультируйтесь с нами.<br><br>ultimateXnova является проектом с открытым кодом и распространяется под лицензией GNU GPL v3, ознакомиться с которой Вы можете в разделе Лицензия.<br><br>Перед установкой будет запущен небольшой тест на соответствие минимальным требованиям.';
$LNG['intro_upgrade_head']    = 'ultimateXnova уже установлена';
$LNG['intro_upgrade_text']    = '<p>Вы уже установили ultimateXnova и просто хотите её обновить?</p><p>Здесь вы можете обновить старую базу данных с помощью нескольких кликов.</p>';

$LNG['upgrade_success']       = 'База данных успешно обновлена до ревизии %s.';
$LNG['upgrade_nothingtodo']   = 'Никаких действий не требуется, база данных имеет состояние ревизии %s.';
$LNG['upgrade_back']          = 'Назад';
$LNG['upgrade_intro_welcome'] = 'Мастер обновления базы данных';
$LNG['upgrade_available']     = 'Обновление доступно. База данных может быть обновлена с текущей ревизии %s до ревизии %s.';
$LNG['upgrade_notavailable']  = 'Используется самая последняя ревизия %s для базы данных.';
$LNG['upgrade_required_rev']  = 'Мастер обновления базы данных доступен с ревизии r2579 (ultimateXnova v1.7).';

$LNG['licence_head']          = 'Лицензионное соглашение';
$LNG['licence_desc']          = 'Пожалуйста, прочитайте лицензионное соглашение. Используйте полосу прокрутки для просмотра всего документа.';
$LNG['licence_accept']        = 'Вы согласны со всеми условиями лицензионного соглашения? Вы можете установить программное обеспечение, только если Вы принимаете условия лицензионного соглашения.';
$LNG['licence_need_accept']   = 'Для того, чтобы приступить к установке, Вы должны принять условия лицензионного соглашения.';

$LNG['req_head']              = 'Необходимые модули';
$LNG['req_desc']              = 'Перед продолжением установки ultimateXnova выполнит проверку файлов конфигурации Вашего сервера на соответствие необходимым требованиям использования ultimateXnova. Пожалуйста, прочитайте внимательно результаты и не продолжайте установку, пока проверка не будет пройдена по всем пунктам. Если Вы хотите использовать любую из функций перечисленных ниже модулей, Вы должны убедиться, что проверка пройдена.';
$LNG['reg_yes']               = 'Да';
$LNG['reg_no']                = 'Нет';
$LNG['reg_found']             = 'Да';
$LNG['reg_not_found']         = 'Нет';
$LNG['reg_writable']          = '(CHMOD 777)';
$LNG['reg_not_writable']      = 'Не установлены права на запись';
$LNG['reg_file']              = 'Файл &raquo;%s&laquo; доступен для записи?';
$LNG['reg_dir']               = 'Папка &raquo;%s&laquo; доступна для записи?';
$LNG['req_php_need']          = 'Установленная версия &raquo;PHP&laquo;';
$LNG['req_php_need_desc']     = '<strong>Требование</strong> — PHP является серверным языком, на котором написана игра. ultimateXnova работает без ограничений, используя версию PHP 5.2.5 и выше.';
$LNG['reg_gd_need']           = 'Установленная версия графической библиотеки &raquo;gdlib&laquo;';
$LNG['reg_gd_desc']           = '<strong>Рекомендуемо</strong> — Графическая библиотека &raquo;gdlib&laquo; отвечает за динамическую генерацию изображений. Без этой библиотеки не будет возможна работа некоторых функциональных возможностей программного обеспечения.';
$LNG['reg_pdo_active']        = 'Поддержка расширения &raquo;PDO&laquo;';
$LNG['reg_pdo_desc']          = '<strong>Требование</strong> — Вы должны предоставить поддержку PDO в PHP.';
$LNG['reg_json_need']         = 'Расширение &raquo;JSON&laquo; доступно?';
$LNG['reg_iniset_need']       = 'Функция PHP &raquo;ini_set&laquo; активна?';
$LNG['reg_global_need']       = 'Параметр &raquo;register_globals&laquo; отключён?';
$LNG['reg_global_desc']       = 'ultimateXnova будет корректно работать, если этот параметр включён. Тем не менее, рекомендуется по соображениям безопасности, отключить register_globals в настройках PHP.';
$LNG['req_ftp_head']          = 'FTP';
$LNG['req_ftp_desc']          = 'Пожалуйста, введите Ваши данные FTP, чтобы установщик автоматически исправил ошибки. Кроме того, можно также вручную назначить разрешения на запись.';
$LNG['req_ftp_host']          = 'FTP хост';
$LNG['req_ftp_username']      = 'FTP логин';
$LNG['req_ftp_password']      = 'FTP пароль';
$LNG['req_ftp_dir']           = 'FTP путь к ultimateXnova';
$LNG['req_ftp_send']          = 'Установить права CHMOD 777';
$LNG['req_ftp_error_data']    = 'С предоставленными учетными данными не удалось подключиться к серверу FTP.';
$LNG['req_ftp_error_dir']     = 'Папка указана неверно.';

$LNG['step1_head']            = 'Настройка доступа к базе данных';
$LNG['step1_desc']            = 'ultimateXnova может быть установлена на Вашем сервере, но Вы должны указать настройки доступа к базе данных. Если Вы не знаете настройки доступа для подключения к базе данных, узнайте их у Вашего хостинг-провайдера или связитесь с технической поддержкой ultimateXnova для консультации. При вводе данных, пожалуйста, проверьте их внимательно, прежде чем продолжить.';
$LNG['step1_mysql_server']    = 'Имя сервера базы данных';
$LNG['step1_mysql_port']      = 'Порт сервера базы данных';
$LNG['step1_mysql_dbuser']    = 'Логин пользователя базы данных';
$LNG['step1_mysql_dbpass']    = 'Пароль пользователя базы данных';
$LNG['step1_mysql_dbname']    = 'Название базы данных';
$LNG['step1_mysql_prefix']    = 'Префикс таблиц';

$LNG['step2_prefix_invalid']  = 'Префикс базы данных должен содержать только алфавитно-цифровые символы и знак подчеркивания.';
$LNG['step2_db_no_dbname']    = 'Имя базы данных не указано.';
$LNG['step2_db_too_long']     = 'Указанный префикс таблиц слишком длинный. Максимальная длина составляет 36 символов.';
$LNG['step2_db_con_fail']     = 'Нет соединения с базой данных. Подробная информация указана ниже.';
$LNG['step2_config_exists']   = 'config.php уже существует.';
$LNG['step2_conf_op_fail']    = 'Для config.php не были установлены права на запись.';
$LNG['step2_conf_create']     = 'config.php создан.';
$LNG['step2_db_done']         = 'Подключение к базе данных установлено.';

$LNG['step3_head']            = 'Создание таблиц базы данных';
$LNG['step3_desc']            = 'Таблицы базы данных созданы и заполнены. Переходите к следующему шагу, чтобы завершить установку ultimateXnova.';
$LNG['step3_db_error']        = 'Не удалось создать следующие таблицы в базе данных:';

$LNG['step4_head']            = 'Создание учётной записи администратора';
$LNG['step4_desc']            = 'Для создания учетной записи администратора введите логин, пароль и адрес электронной почты.';
$LNG['step4_admin_name']      = 'Логин:';
$LNG['step4_admin_name_desc'] = 'От 3 до 20 символов.';
$LNG['step4_admin_pass']      = 'Пароль:';
$LNG['step4_admin_pass_desc'] = 'От 6 до 30 символов.';
$LNG['step4_admin_mail']      = 'Адрес электронной почты:';

$LNG['step6_head']            = 'Поздравляем!';
$LNG['step6_desc']            = 'Вы установили ultimateXnova.';
$LNG['step6_info_head']       = 'Начните использовать ultimateXnova.';
$LNG['step6_info_additional'] = 'Если Вы нажмёте на кнопку ниже, Вы будете перенаправлены в панель администратора. Потратьте некоторое время на ознакомление с доступными настройками.<br/><br/><strong>Пожалуйста, удалите файл &raquo;includes/ENABLE_INSTALL_TOOL&laquo; или переименуйте его, прежде чем использовать игру. Пока этот файл существует, Ваша игра подвергается потенциальному риску взлома!</strong>';

$LNG['step8_need_fields']     = 'Вы должны заполнить все поля.';

$LNG['sql_close_reason']      = 'Сервер в данный момент недоступен';
$LNG['sql_welcome']           = 'Добро пожаловать в ultimateXnova v';
