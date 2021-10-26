-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 25 2018 г., 18:59
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
-- База данных: `sourcebans`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sb_admins`
--

CREATE TABLE `sb_admins` (
  `aid` int(6) NOT NULL,
  `user` varchar(64) NOT NULL,
  `authid` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL,
  `gid` int(6) NOT NULL,
  `email` varchar(128) NOT NULL,
  `validate` varchar(128) DEFAULT NULL,
  `extraflags` int(10) NOT NULL,
  `immunity` int(10) NOT NULL DEFAULT '0',
  `srv_group` varchar(128) DEFAULT NULL,
  `srv_flags` varchar(64) DEFAULT NULL,
  `srv_password` varchar(128) DEFAULT NULL,
  `lastvisit` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_admins_servers_groups`
--

CREATE TABLE `sb_admins_servers_groups` (
  `admin_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  `srv_group_id` int(10) NOT NULL,
  `server_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_banlog`
--

CREATE TABLE `sb_banlog` (
  `sid` int(6) NOT NULL,
  `time` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `bid` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_bans`
--

CREATE TABLE `sb_bans` (
  `bid` int(6) NOT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `authid` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT 'unnamed',
  `created` int(11) NOT NULL DEFAULT '0',
  `ends` int(11) NOT NULL DEFAULT '0',
  `length` int(10) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `aid` int(6) NOT NULL DEFAULT '0',
  `adminIp` varchar(32) NOT NULL DEFAULT '',
  `sid` int(6) NOT NULL DEFAULT '0',
  `country` varchar(4) DEFAULT NULL,
  `RemovedBy` int(8) DEFAULT NULL,
  `RemoveType` varchar(3) DEFAULT NULL,
  `RemovedOn` int(10) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `ureason` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_comments`
--

CREATE TABLE `sb_comments` (
  `cid` int(6) NOT NULL,
  `bid` int(6) NOT NULL,
  `type` varchar(1) NOT NULL,
  `aid` int(6) NOT NULL,
  `commenttxt` longtext NOT NULL,
  `added` int(11) NOT NULL,
  `editaid` int(6) DEFAULT NULL,
  `edittime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_demos`
--

CREATE TABLE `sb_demos` (
  `demid` int(6) NOT NULL,
  `demtype` varchar(1) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `origname` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_groups`
--

CREATE TABLE `sb_groups` (
  `gid` int(6) NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL DEFAULT 'unnamed',
  `flags` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_log`
--

CREATE TABLE `sb_log` (
  `lid` int(11) NOT NULL,
  `type` enum('m','w','e') NOT NULL,
  `title` varchar(512) NOT NULL,
  `message` text NOT NULL,
  `function` text NOT NULL,
  `query` text NOT NULL,
  `aid` int(11) NOT NULL,
  `host` text NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_mods`
--

CREATE TABLE `sb_mods` (
  `mid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `modfolder` varchar(64) NOT NULL,
  `steam_universe` tinyint(4) NOT NULL DEFAULT '0',
  `enabled` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sb_mods`
--

INSERT INTO `sb_mods` (`mid`, `name`, `icon`, `modfolder`, `steam_universe`, `enabled`) VALUES
(0, 'Web', 'web.png', 'NULL', 0, 1),
(2, 'Half-Life 2 Deathmatch', 'hl2dm.png', 'hl2mp', 0, 1),
(3, 'Counter-Strike: Source', 'csource.png', 'cstrike', 0, 1),
(4, 'Day of Defeat: Source', 'dods.png', 'dod', 0, 1),
(5, 'Insurgency: Source', 'ins.gif', 'insurgency', 0, 1),
(6, 'Dystopia', 'dys.gif', 'dystopia_v1', 0, 1),
(7, 'Hidden: Source', 'hidden.png', 'hidden', 0, 1),
(8, 'Half-Life 2 Capture the Flag', 'hl2ctf.png', 'hl2ctf', 0, 1),
(9, 'Pirates Vikings and Knights II', 'pvkii.gif', 'pvkii', 0, 1),
(10, 'Perfect Dark: Source', 'pdark.gif', 'pdark', 0, 1),
(11, 'The Ship', 'ship.gif', 'ship', 0, 1),
(12, 'Fortress Forever', 'hl2-fortressforever.gif', 'FortressForever', 0, 1),
(13, 'Team Fortress 2', 'tf2.gif', 'tf', 0, 1),
(14, 'Zombie Panic', 'zps.gif', 'zps', 0, 1),
(15, 'Garry\'s Mod', 'gmod.png', 'garrysmod', 0, 1),
(16, 'Left 4 Dead', 'l4d.png', 'left4dead', 1, 1),
(17, 'Left 4 Dead 2', 'l4d2.png', 'left4dead2', 1, 1),
(18, 'CSPromod', 'cspromod.png', 'cspromod', 0, 1),
(19, 'Alien Swarm', 'alienswarm.png', 'alienswarm', 0, 1),
(20, 'E.Y.E: Divine Cybermancy', 'eye.png', 'eye', 0, 1),
(21, 'Nuclear Dawn', 'nucleardawn.png', 'nucleardawn', 0, 1),
(22, 'Counter-Strike: Global Offensive', 'csgo.png', 'csgo', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sb_overrides`
--

CREATE TABLE `sb_overrides` (
  `id` int(11) NOT NULL,
  `type` enum('command','group') NOT NULL,
  `name` varchar(32) NOT NULL,
  `flags` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_protests`
--

CREATE TABLE `sb_protests` (
  `pid` int(6) NOT NULL,
  `bid` int(6) NOT NULL,
  `datesubmitted` int(11) NOT NULL,
  `reason` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `archiv` tinyint(1) DEFAULT '0',
  `archivedby` int(11) DEFAULT NULL,
  `pip` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_servers`
--

CREATE TABLE `sb_servers` (
  `sid` int(6) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `port` int(5) NOT NULL,
  `rcon` varchar(64) NOT NULL,
  `modid` int(10) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_servers_groups`
--

CREATE TABLE `sb_servers_groups` (
  `server_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_settings`
--

CREATE TABLE `sb_settings` (
  `setting` varchar(128) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sb_settings`
--

INSERT INTO `sb_settings` (`setting`, `value`) VALUES
('dash.intro.text', '<img src=\"images/logo-large.jpg\" border=\"0\" width=\"800\" height=\"126\" /><h3>Your new SourceBans install</h3><p>SourceBans successfully installed!</p>'),
('dash.intro.title', 'Your SourceBans install'),
('dash.lognopopup', '0'),
('banlist.bansperpage', '30'),
('banlist.hideadminname', '0'),
('banlist.nocountryfetch', '0'),
('banlist.hideplayerips', '0'),
('bans.customreasons', ''),
('config.password.minlength', '4'),
('config.debug', '0 '),
('template.logo', 'logos/sb-large.png'),
('template.title', 'SourceBans'),
('config.enableprotest', '1'),
('config.enablesubmit', '1'),
('config.exportpublic', '0'),
('config.enablekickit', '1'),
('config.dateformat', ''),
('config.theme', 'default'),
('config.defaultpage', '0'),
('config.timezone', '0'),
('config.summertime', '0'),
('config.enablegroupbanning', '0'),
('config.enablefriendsbanning', '0'),
('config.enableadminrehashing', '1'),
('protest.emailonlyinvolved', '0'),
('config.version', '356');

-- --------------------------------------------------------

--
-- Структура таблицы `sb_srvgroups`
--

CREATE TABLE `sb_srvgroups` (
  `id` int(10) UNSIGNED NOT NULL,
  `flags` varchar(30) NOT NULL,
  `immunity` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `groups_immune` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_srvgroups_overrides`
--

CREATE TABLE `sb_srvgroups_overrides` (
  `id` int(11) NOT NULL,
  `group_id` smallint(5) UNSIGNED NOT NULL,
  `type` enum('command','group') NOT NULL,
  `name` varchar(32) NOT NULL,
  `access` enum('allow','deny') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sb_submissions`
--

CREATE TABLE `sb_submissions` (
  `subid` int(6) NOT NULL,
  `submitted` int(11) NOT NULL,
  `ModID` int(6) NOT NULL,
  `SteamId` varchar(64) NOT NULL DEFAULT 'unnamed',
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `reason` text NOT NULL,
  `ip` varchar(64) NOT NULL,
  `subname` varchar(128) DEFAULT NULL,
  `sip` varchar(64) DEFAULT NULL,
  `archiv` tinyint(1) DEFAULT '0',
  `archivedby` int(11) DEFAULT NULL,
  `server` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sb_admins`
--
ALTER TABLE `sb_admins`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Индексы таблицы `sb_banlog`
--
ALTER TABLE `sb_banlog`
  ADD PRIMARY KEY (`sid`,`time`,`bid`);

--
-- Индексы таблицы `sb_bans`
--
ALTER TABLE `sb_bans`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `sid` (`sid`);
ALTER TABLE `sb_bans` ADD FULLTEXT KEY `reason` (`reason`);
ALTER TABLE `sb_bans` ADD FULLTEXT KEY `authid_2` (`authid`);

--
-- Индексы таблицы `sb_comments`
--
ALTER TABLE `sb_comments`
  ADD KEY `cid` (`cid`);
ALTER TABLE `sb_comments` ADD FULLTEXT KEY `commenttxt` (`commenttxt`);

--
-- Индексы таблицы `sb_demos`
--
ALTER TABLE `sb_demos`
  ADD PRIMARY KEY (`demid`,`demtype`);

--
-- Индексы таблицы `sb_groups`
--
ALTER TABLE `sb_groups`
  ADD PRIMARY KEY (`gid`);

--
-- Индексы таблицы `sb_log`
--
ALTER TABLE `sb_log`
  ADD PRIMARY KEY (`lid`);

--
-- Индексы таблицы `sb_mods`
--
ALTER TABLE `sb_mods`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `modfolder` (`modfolder`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `steam_universe` (`steam_universe`);

--
-- Индексы таблицы `sb_overrides`
--
ALTER TABLE `sb_overrides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`,`name`);

--
-- Индексы таблицы `sb_protests`
--
ALTER TABLE `sb_protests`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `bid` (`bid`);

--
-- Индексы таблицы `sb_servers`
--
ALTER TABLE `sb_servers`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `ip` (`ip`,`port`);

--
-- Индексы таблицы `sb_servers_groups`
--
ALTER TABLE `sb_servers_groups`
  ADD PRIMARY KEY (`server_id`,`group_id`);

--
-- Индексы таблицы `sb_settings`
--
ALTER TABLE `sb_settings`
  ADD UNIQUE KEY `setting` (`setting`);

--
-- Индексы таблицы `sb_srvgroups`
--
ALTER TABLE `sb_srvgroups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sb_srvgroups_overrides`
--
ALTER TABLE `sb_srvgroups_overrides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`type`,`name`);

--
-- Индексы таблицы `sb_submissions`
--
ALTER TABLE `sb_submissions`
  ADD PRIMARY KEY (`subid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sb_admins`
--
ALTER TABLE `sb_admins`
  MODIFY `aid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sb_bans`
--
ALTER TABLE `sb_bans`
  MODIFY `bid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_comments`
--
ALTER TABLE `sb_comments`
  MODIFY `cid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_groups`
--
ALTER TABLE `sb_groups`
  MODIFY `gid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_log`
--
ALTER TABLE `sb_log`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_mods`
--
ALTER TABLE `sb_mods`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `sb_overrides`
--
ALTER TABLE `sb_overrides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_protests`
--
ALTER TABLE `sb_protests`
  MODIFY `pid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_servers`
--
ALTER TABLE `sb_servers`
  MODIFY `sid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_srvgroups`
--
ALTER TABLE `sb_srvgroups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_srvgroups_overrides`
--
ALTER TABLE `sb_srvgroups_overrides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sb_submissions`
--
ALTER TABLE `sb_submissions`
  MODIFY `subid` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
