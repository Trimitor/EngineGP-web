<?php
// Что и как показывать в топе?
//	a - место в статистике
//	b - ник
//	c - фраги
//	d - смерти
//	e - в голову
//	f - убийств своих
//	g - выстрелы
//	h - попадания
//	i - урон
//	j - суицид
//	k - пытался разминировать
//	l - разминировал
//	m - поставил бомб
//	n - взорвал бомб
//	o - звание (если стоит плагин army_ranks_ultimate)
//	p - погоны (если стоит плагин army_ranks_ultimate)
//	q - опыт (если стоит плагин army_ranks_ultimate)
//	r - скилл (если стоит плагин statsx_rbs)
	$show_top = "aropbcdefghijklmnq";
	
// Максимальное число игроков на странице
	$show_pages = 50;
	
// Начальная сортировка игроков
// Значения: place, frags, deaths, headshots, teamkills, shots, hits, damage, suicide, defusing, defused, planted, explode
// xp - если стоит плагин Army Ranks Ultimate
// skill - если стоит плагин StatsX RBS
	$DefaultSort = "place";
	
// Сделать стату по центру экрана?
	$center = 0;
	
// Размер погон в таблице
	$Pogony[0] = 46;
	$Pogony[1] = 16;
	
	
// Адрес
	$csstats_host = "";
// Логин
	$csstats_user = "";
// Пароль
	$csstats_pass = "";
// Имя базы данных
	$csstats_db = "";
// Таблица для записи игроков
	$csstats_table_players = "csstats_players";
// Таблица для записи настроек
	$csstats_table_settings = "csstats_settings";
	
	
// IP:PORT Вашего сервера/серверов (для отображение онлайн игрока)
	$server_address[] = "";
	//$server_address[] = "123.123.123.123:27016";
?>