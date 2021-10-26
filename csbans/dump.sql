-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 27 2018 г., 20:37
-- Версия сервера: 5.7.21
-- Версия PHP: 5.5.38-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `csbans`
--

-- --------------------------------------------------------

--
-- Структура таблицы `amx_admins_servers`
--

CREATE TABLE `amx_admins_servers` (
  `admin_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `custom_flags` varchar(32) NOT NULL DEFAULT '',
  `use_static_bantime` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_amxadmins`
--

CREATE TABLE `amx_amxadmins` (
  `id` int(12) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `access` varchar(32) DEFAULT NULL,
  `flags` varchar(32) DEFAULT NULL,
  `steamid` varchar(32) DEFAULT NULL,
  `nickname` varchar(32) DEFAULT NULL,
  `icq` int(9) DEFAULT NULL,
  `ashow` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `expired` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_bans`
--

CREATE TABLE `amx_bans` (
  `bid` int(11) NOT NULL,
  `player_ip` varchar(32) DEFAULT NULL,
  `player_id` varchar(35) DEFAULT NULL,
  `player_nick` varchar(100) DEFAULT 'Unknown',
  `admin_ip` varchar(32) DEFAULT NULL,
  `admin_id` varchar(35) DEFAULT 'Unknown',
  `admin_nick` varchar(100) DEFAULT 'Unknown',
  `ban_type` varchar(10) DEFAULT 'S',
  `ban_reason` varchar(100) DEFAULT NULL,
  `cs_ban_reason` varchar(100) DEFAULT NULL,
  `ban_created` int(11) DEFAULT NULL,
  `ban_length` int(11) DEFAULT NULL,
  `server_ip` varchar(32) DEFAULT NULL,
  `server_name` varchar(100) DEFAULT 'Unknown',
  `ban_kicks` int(11) NOT NULL DEFAULT '0',
  `expired` int(1) NOT NULL DEFAULT '0',
  `imported` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_comments`
--

CREATE TABLE `amx_comments` (
  `id` int(11) NOT NULL,
  `name` varchar(35) DEFAULT NULL,
  `comment` text,
  `email` varchar(100) DEFAULT NULL,
  `addr` varchar(32) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_files`
--

CREATE TABLE `amx_files` (
  `id` int(11) NOT NULL,
  `upload_time` int(11) DEFAULT NULL,
  `down_count` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `demo_file` varchar(100) DEFAULT NULL,
  `demo_real` varchar(100) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `comment` text,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `addr` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_flagged`
--

CREATE TABLE `amx_flagged` (
  `fid` int(11) NOT NULL,
  `player_ip` varchar(32) DEFAULT NULL,
  `player_id` varchar(35) DEFAULT NULL,
  `player_nick` varchar(100) DEFAULT 'Unknown',
  `admin_ip` varchar(32) DEFAULT NULL,
  `admin_id` varchar(35) DEFAULT NULL,
  `admin_nick` varchar(100) DEFAULT 'Unknown',
  `reason` varchar(100) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `server_ip` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_levels`
--

CREATE TABLE `amx_levels` (
  `level` int(12) NOT NULL DEFAULT '0',
  `bans_add` enum('yes','no') DEFAULT 'no',
  `bans_edit` enum('yes','no','own') DEFAULT 'no',
  `bans_delete` enum('yes','no','own') DEFAULT 'no',
  `bans_unban` enum('yes','no','own') DEFAULT 'no',
  `bans_import` enum('yes','no') DEFAULT 'no',
  `bans_export` enum('yes','no') DEFAULT 'no',
  `amxadmins_view` enum('yes','no') DEFAULT 'no',
  `amxadmins_edit` enum('yes','no') DEFAULT 'no',
  `webadmins_view` enum('yes','no') DEFAULT 'no',
  `webadmins_edit` enum('yes','no') DEFAULT 'no',
  `websettings_view` enum('yes','no') DEFAULT 'no',
  `websettings_edit` enum('yes','no') DEFAULT 'no',
  `permissions_edit` enum('yes','no') DEFAULT 'no',
  `prune_db` enum('yes','no') DEFAULT 'no',
  `servers_edit` enum('yes','no') DEFAULT 'no',
  `ip_view` enum('yes','no') DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `amx_levels`
--

INSERT INTO `amx_levels` (`level`, `bans_add`, `bans_edit`, `bans_delete`, `bans_unban`, `bans_import`, `bans_export`, `amxadmins_view`, `amxadmins_edit`, `webadmins_view`, `webadmins_edit`, `websettings_view`, `websettings_edit`, `permissions_edit`, `prune_db`, `servers_edit`, `ip_view`) VALUES
(1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `amx_logs`
--

CREATE TABLE `amx_logs` (
  `id` int(11) NOT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `action` varchar(64) DEFAULT NULL,
  `remarks` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `amx_logs`
--

INSERT INTO `amx_logs` (`id`, `timestamp`, `ip`, `username`, `action`, `remarks`) VALUES
(1, 1519763636, '127.0.0.1', 'admin', 'Install', 'Installation CS:Bans 1.0');

-- --------------------------------------------------------

--
-- Структура таблицы `amx_reasons`
--

CREATE TABLE `amx_reasons` (
  `id` int(11) NOT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `static_bantime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_reasons_set`
--

CREATE TABLE `amx_reasons_set` (
  `id` int(11) NOT NULL,
  `setname` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_reasons_to_set`
--

CREATE TABLE `amx_reasons_to_set` (
  `id` int(11) NOT NULL,
  `setid` int(11) NOT NULL,
  `reasonid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_serverinfo`
--

CREATE TABLE `amx_serverinfo` (
  `id` int(11) NOT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `hostname` varchar(100) DEFAULT 'Unknown',
  `address` varchar(100) DEFAULT NULL,
  `gametype` varchar(32) DEFAULT NULL,
  `rcon` varchar(32) DEFAULT NULL,
  `amxban_version` varchar(32) DEFAULT NULL,
  `amxban_motd` varchar(250) DEFAULT NULL,
  `motd_delay` int(10) DEFAULT '10',
  `amxban_menu` int(10) NOT NULL DEFAULT '1',
  `reasons` int(10) DEFAULT NULL,
  `timezone_fixx` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_usermenu`
--

CREATE TABLE `amx_usermenu` (
  `id` int(11) NOT NULL,
  `pos` int(11) DEFAULT NULL,
  `activ` tinyint(1) NOT NULL DEFAULT '1',
  `lang_key` varchar(64) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `lang_key2` varchar(64) DEFAULT NULL,
  `url2` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `amx_usermenu`
--

INSERT INTO `amx_usermenu` (`id`, `pos`, `activ`, `lang_key`, `url`, `lang_key2`, `url2`) VALUES
(1, 1, 1, '_HOME', '/site/index', '_HOME', '/site/index'),
(2, 2, 1, '_BANLIST', '/bans/index', '_BANLIST', '/bans/index'),
(3, 3, 1, '_ADMLIST', '/amxadmins/index', '_ADMLIST', '/amxadmins/index'),
(5, 5, 1, '_SERVER', '/serverinfo/index', '_SERVER', '/serverinfo/index');

-- --------------------------------------------------------

--
-- Структура таблицы `amx_webadmins`
--

CREATE TABLE `amx_webadmins` (
  `id` int(12) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) DEFAULT '99',
  `logcode` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `last_action` int(11) DEFAULT NULL,
  `try` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `amx_webconfig`
--

CREATE TABLE `amx_webconfig` (
  `id` int(11) NOT NULL,
  `cookie` varchar(32) DEFAULT NULL,
  `bans_per_page` int(11) DEFAULT NULL,
  `design` varchar(32) DEFAULT NULL,
  `banner` varchar(64) DEFAULT NULL,
  `banner_url` varchar(128) NOT NULL,
  `default_lang` varchar(32) DEFAULT NULL,
  `start_page` varchar(64) DEFAULT NULL,
  `show_comment_count` int(1) DEFAULT '1',
  `show_demo_count` int(1) DEFAULT '1',
  `show_kick_count` int(1) DEFAULT '1',
  `demo_all` int(1) NOT NULL DEFAULT '0',
  `comment_all` int(1) NOT NULL DEFAULT '0',
  `use_capture` int(1) DEFAULT '1',
  `max_file_size` int(11) DEFAULT '2',
  `file_type` varchar(64) DEFAULT 'dem,zip,rar,jpg,gif',
  `auto_prune` int(1) NOT NULL DEFAULT '0',
  `max_offences` smallint(6) NOT NULL DEFAULT '10',
  `max_offences_reason` varchar(128) NOT NULL DEFAULT 'max offences reached',
  `use_demo` int(1) DEFAULT '1',
  `use_comment` int(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `amx_webconfig`
--

INSERT INTO `amx_webconfig` (`id`, `cookie`, `bans_per_page`, `design`, `banner`, `banner_url`, `default_lang`, `start_page`, `show_comment_count`, `show_demo_count`, `show_kick_count`, `demo_all`, `comment_all`, `use_capture`, `max_file_size`, `file_type`, `auto_prune`, `max_offences`, `max_offences_reason`, `use_demo`, `use_comment`) VALUES
(1, 'csbans', 50, 'default', 'amxbans.png', 'http://craft-soft.ru', 'russian', '/site/index', 1, 1, 1, 0, 0, 1, 2, 'dem,zip,rar,jpg,gif,png', 0, 10, 'max offences reached', 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `amx_admins_servers`
--
ALTER TABLE `amx_admins_servers`
  ADD UNIQUE KEY `admin_id` (`admin_id`,`server_id`);

--
-- Индексы таблицы `amx_amxadmins`
--
ALTER TABLE `amx_amxadmins`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `steamid` (`steamid`);

--
-- Индексы таблицы `amx_bans`
--
ALTER TABLE `amx_bans`
  ADD UNIQUE KEY `bid` (`bid`),
  ADD KEY `player_id` (`player_id`);

--
-- Индексы таблицы `amx_comments`
--
ALTER TABLE `amx_comments`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_files`
--
ALTER TABLE `amx_files`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_flagged`
--
ALTER TABLE `amx_flagged`
  ADD UNIQUE KEY `fid` (`fid`),
  ADD KEY `player_id` (`player_id`);

--
-- Индексы таблицы `amx_levels`
--
ALTER TABLE `amx_levels`
  ADD UNIQUE KEY `level` (`level`);

--
-- Индексы таблицы `amx_logs`
--
ALTER TABLE `amx_logs`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_reasons`
--
ALTER TABLE `amx_reasons`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_reasons_set`
--
ALTER TABLE `amx_reasons_set`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_reasons_to_set`
--
ALTER TABLE `amx_reasons_to_set`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_serverinfo`
--
ALTER TABLE `amx_serverinfo`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_usermenu`
--
ALTER TABLE `amx_usermenu`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `amx_webadmins`
--
ALTER TABLE `amx_webadmins`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Индексы таблицы `amx_webconfig`
--
ALTER TABLE `amx_webconfig`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `amx_amxadmins`
--
ALTER TABLE `amx_amxadmins`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_bans`
--
ALTER TABLE `amx_bans`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_comments`
--
ALTER TABLE `amx_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_files`
--
ALTER TABLE `amx_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_flagged`
--
ALTER TABLE `amx_flagged`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_logs`
--
ALTER TABLE `amx_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `amx_reasons`
--
ALTER TABLE `amx_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_reasons_set`
--
ALTER TABLE `amx_reasons_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_reasons_to_set`
--
ALTER TABLE `amx_reasons_to_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_serverinfo`
--
ALTER TABLE `amx_serverinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `amx_usermenu`
--
ALTER TABLE `amx_usermenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `amx_webadmins`
--
ALTER TABLE `amx_webadmins`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `amx_webconfig`
--
ALTER TABLE `amx_webconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
