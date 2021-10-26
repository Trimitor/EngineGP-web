-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 03 2018 г., 15:33
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
-- База данных: `w10005`
--

-- --------------------------------------------------------

--
-- Структура таблицы `csstats_players`
--

CREATE TABLE `csstats_players` (
  `id` int(11) NOT NULL,
  `nick` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `authid` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `frags` int(11) NOT NULL DEFAULT '0',
  `deaths` int(11) NOT NULL DEFAULT '0',
  `headshots` int(11) NOT NULL DEFAULT '0',
  `teamkills` int(11) NOT NULL DEFAULT '0',
  `shots` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `damage` int(11) NOT NULL DEFAULT '0',
  `suicide` int(11) NOT NULL DEFAULT '0',
  `defusing` int(11) NOT NULL DEFAULT '0',
  `defused` int(11) NOT NULL DEFAULT '0',
  `planted` int(11) NOT NULL DEFAULT '0',
  `explode` int(11) NOT NULL DEFAULT '0',
  `place` int(11) NOT NULL DEFAULT '0',
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `gametime` int(11) NOT NULL DEFAULT '0',
  `connects` int(11) NOT NULL DEFAULT '0',
  `rounds` int(11) NOT NULL DEFAULT '0',
  `wint` int(11) NOT NULL DEFAULT '0',
  `winct` int(11) NOT NULL DEFAULT '0',
  `skill` int(11) NOT NULL DEFAULT '0',
  `ar_addxp` int(11) NOT NULL DEFAULT '0',
  `ar_anew` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `csstats_settings`
--

CREATE TABLE `csstats_settings` (
  `command` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `csstats_settings`
--

INSERT INTO `csstats_settings` (`command`, `value`) VALUES
('mp_timelimit', '20'),
('mp_roundtime', '5'),
('mp_friendlyfire', '0'),
('mp_freezetime', '6'),
('csstats_sort', '-2'),
('csstats_ffa', '0'),
('csstats_double', '1'),
('csstats_version', '17.12.12'),
('army_enable', '0'),
('statsx_enable', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `csstats_players`
--
ALTER TABLE `csstats_players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_authid` (`authid`),
  ADD KEY `idx_frags` (`frags`),
  ADD KEY `idx_ar_addxp` (`ar_addxp`),
  ADD KEY `idx_ar_anew` (`ar_anew`),
  ADD KEY `idx_lasttime` (`lasttime`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `csstats_players`
--
ALTER TABLE `csstats_players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
