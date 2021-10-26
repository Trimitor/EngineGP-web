<?php 
if( !defined("BLOCK") ) 
{
	exit ( "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> 
		<html>
			<head>
				<title>404 Not Found</title>
			</head>
			<body>
				<h1>Not Found</h1>
				<p>The requested URL was not found on this server.</p>
			</body>
		</html>" );
}

$database = @mysqli_connect($GLOBALS["db_host"], $GLOBALS["db_user"], $GLOBALS["db_pass"], $GLOBALS["db_name"]);
if( mysqli_connect_errno() ) 
{
    exit( "Не удалось подключиться к БД! Ошибка: " . mysqli_connect_error() . "" );
}

@mysqli_set_charset($database, "utf8");

class DataBase
{
    public function m_query($sql)
    {
        global $database;
        return mysqli_query($database, $sql);
    }

    public function n_rows($sql)
    {
        $rows = @mysqli_num_rows($sql);
        return $rows;
    }

    public function f_arr($sql)
    {
        $array = @mysqli_fetch_array($sql, MYSQLI_ASSOC);
        return $array;
    }

    public function m_escape($sql)
    {
        global $database;
        $sql = get_magic_quotes_gpc() ? stripslashes($sql) : $sql;
        $sql = mysqli_real_escape_string($database, $sql);
        return $sql;
    }
}


class Engine
{
    public function dateDiff($startDay, $endDay)
    {
        if( $endDay - $startDay < 0 ) 
        {
            return "end";
        }

        $difference = abs($endDay - $startDay);
        $month = floor($difference / 2592000);
        if( 0 < $month ) 
        {
            $return["month"] = $this->declOfNum($month, array( "месяц", "месяца", "месяцев" ));
        }

        $days = floor($difference / 86400) % 30;
        if( 0 < $days ) 
        {
            $return["days"] = $this->declOfNum($days, array( "день", "дня", "дней" ));
        }

        $hours = floor($difference / 3600) % 24;
        if( 0 < $hours ) 
        {
            $return["hours"] = $this->declOfNum($hours, array( "час", "часа", "часов" ));
        }

        $minutes = floor($difference / 60) % 60;
        if( 0 < $minutes ) 
        {
            $return["minutes"] = $this->declOfNum($minutes, array( "минута", "минуты", "минут" ));
        }

        if( 0 < count($return) ) 
        {
            $datediff = implode(" ", $return);
            return $datediff;
        }

        return "few";
    }

    public function declOfNum($number, $titles)
    {
        $cases = array( 2, 0, 1, 1, 1, 2 );
        return $number . " " . $titles[4 < $number % 100 && $number % 100 < 20 ? 2 : $cases[min($number % 10, 5)]];
    }

    public function alert_mess($mess)
    {
        return "\r\n\t\t\t<script type='text/javascript'>\r\n\t\t\t\t\$(document).ready(function(){\r\n\t\t\t\t\t\$('#mess').jGrowl('<center><strong>" . $mess . "</strong></center>', { life: 5000 });\r\n\t\t\t\t});\r\n\t\t\t</script>";
    }

    public function pagination($array)
    {
        global $db, $GLOBALS;
        if( $_GET["page"] == NULL || !is_numeric($_GET["page"]) ) 
        {
            $page = 1;
        }
        else
        {
            $page = abs((int) $_GET["page"]);
        }

        $page_total = floor(($db->n_rows($db->m_query($array["query"])) - 1) / $array["page_num"] + 1);
        $page_query = $array["query"] . " LIMIT " . ($page * $array["page_num"] - $array["page_num"]) . "," . $array["page_num"] . "";
        $page_count = $page * $array["page_num"] - $array["page_num"];
        $pagination .= "<ul class=\"pagination\">";
        if( 1 < $page ) 
        {
            $pagination .= "<li><a href=\"" . $array["url"] . "?page=" . ($page - 1) . "\">Назад</a></li>";
        }

        for( $i = max(1, $page - 2); $i <= min($page + 2, $page_total); $i++ ) 
        {
            if( $i == $page ) 
            {
                $pagination .= "<li class=\"active\"><a>" . $i . "</a></li>";
            }
            else
            {
                $pagination .= "<li>" . "<a href=\"" . $array["url"] . "?page=" . $i . "\">" . $i . "</a>" . "</li>";
            }

        }
        $pagination .= "" . ($page < $page_total ? "<li><a href=\"" . $array["url"] . "?page=" . ($page + 1) . "\">Далее</a></li>" : "") . "";
        if( 1 < $page_total ) 
        {
            if( $page == $page_total ) 
            {
                $pagination .= "<li><a href=\"" . $array["url"] . "?page=1\">В начало</a></li>";
            }
            else
            {
                $pagination .= "<li><a href=\"" . $array["url"] . "?page=" . $page_total . "\">В конец</a></li>";
            }

        }

        $pagination .= "</ul>";
        return array( "query" => $page_query, "pages" => $pagination, "count" => $page_count );
    }

    public function chat_time($timestamp)
    {
        $getdata = date("d.m.Y", $timestamp);
        $yesterday = date("d.m.Y", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
        if( $getdata == date("d.m.Y") ) 
        {
            $date = date("Сегодня в [H:i]", $timestamp);
        }
        else
        {
            if( $yesterday == $getdata ) 
            {
                $date = date("Вчера в [H:i]", $timestamp);
            }
            else
            {
                $date = date("d.m.Y в [H:i]", $timestamp);
            }

        }

        return $date;
    }

    public function insert_smiles($text_mess)
    {
        $smile1 = array( "=)", "8)", ":(", ":W", ":P", ":-D", "=-O", ":-!", ":L", ":C", ":Y", ":lol", ":red", ":G", ":Devil", "@=", ":S", ":sos", ":B", ":MS" );
        $smile2 = array( "<img onclick=\"smiles('=)')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_smile.gif\" title=\"Улыбка\"/>", "<img onclick=\"smiles('8)')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_cool.gif\" title=\"Блатной\"/>", "<img onclick=\"smiles(':(')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_sad.gif\" title=\"Грусть\"/>", "<img onclick=\"smiles(':W')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_wink.gif\" title=\"Подмигивание\"/>", "<img onclick=\"smiles(':P')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_razz.gif\" title=\"Язык\"/>", "<img onclick=\"smiles(':-D')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_biggrin.gif\" title=\"Ржач\"/>", "<img onclick=\"smiles('=-O')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_eek.gif\" title=\"Офигел\"/>", "<img onclick=\"smiles(':-!')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_sick.gif\" title=\"Нудота\"/>", "<img onclick=\"smiles(':L')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_love.gif\" title=\"Любовь\"/>", "<img onclick=\"smiles(':C')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_mrgreen.gif\" title=\"Двинутый\"/>", "<img onclick=\"smiles(':Y')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_yahoo.gif\" title=\"Радость\"/>", "<img onclick=\"smiles(':lol')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_lol.gif\" title=\"Лол\"/>", "<img onclick=\"smiles(':red')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_red.gif\" title=\"Покраснел\"/>", "<img onclick=\"smiles(':G')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_nice.gif\" title=\"Отлично\"/>", "<img onclick=\"smiles(':Devil')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_devil.gif\" title=\"Дьявол\"/>", "<img onclick=\"smiles('@=')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_bomb.gif\" title=\"Бомба\"/>", "<img onclick=\"smiles(':S')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_stop.gif\" title=\"Стоп\"/>", "<img onclick=\"smiles(':sos')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_sos.gif\" title=\"Помощь\"/>", "<img onclick=\"smiles(':B')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/icon_bear.gif\" title=\"Пиво\"/>", "<img onclick=\"smiles(':MS')\" style=\"cursor: pointer;\" src=\"../style/img/smiles/ms.gif\" title=\"Музыка\"/>" );
        return str_replace($smile1, $smile2, $text_mess);
    }

    public function log($text)
    {
        file_put_contents("../core/logs.txt", $text, FILE_APPEND);
    }

    public static function getString(&$packet)
    {
        $str = "";
        $n = strlen($packet);
        for( $i = 0; $packet[$i] != chr(0) && $i < $n; $i++ ) 
        {
            $str .= $packet[$i];
        }
        $packet = substr($packet, strlen($str));
        return trim($str);
    }

    public static function getChar(&$packet)
    {
        $char = $packet[0];
        $packet = substr($packet, 1);
        return $char;
    }

    public static function serverInfo($server)
    {
        list($ip, $port) = explode(":", $server);
        $fp = @fsockopen("udp://" . $ip, $port);
        if( $fp ) 
        {
            stream_set_timeout($fp, 2);
            fwrite($fp, "����TSource Engine Query");
            $temp = fread($fp, 4);
            $status = socket_get_status($fp);
            if( 0 < $status["unread_bytes"] ) 
            {
                $temp = fread($fp, $status["unread_bytes"]);
                $version = ord(self::getChar($temp));
                $array = array(  );
                $array["status"] = "1";
                if( $version == 109 ) 
                {
                    $array["ip"] = self::getString($temp);
                    $temp = substr($temp, 1);
                    $array["hostname"] = self::getString($temp);
                    $temp = substr($temp, 1);
                    $array["mapname"] = self::getString($temp);
                    $temp = substr($temp, 1);
                    self::getString($temp);
                    $temp = substr($temp, 1);
                    self::getString($temp);
                    $temp = substr($temp, 1);
                    $array["players"] = ord(self::getChar($temp));
                    $array["maxplayers"] = ord(self::getChar($temp));
                }
                else
                {
                    if( $version == 73 ) 
                    {
                        self::getChar($temp);
                        $array["hostname"] = self::getString($temp);
                        $temp = substr($temp, 1);
                        $array["mapname"] = self::getString($temp);
                        $temp = substr($temp, 1);
                        self::getString($temp);
                        $temp = substr($temp, 1);
                        self::getString($temp);
                        $temp = substr($temp, 3);
                        $array["players"] = ord(self::getChar($temp));
                        $array["maxplayers"] = ord(self::getChar($temp));
                    }

                }

            }
            else
            {
                $array["hostname"] = "Сервер отключен";
                $array["mapname"] = "Неизвестно";
                $array["players"] = "0";
                $array["maxplayers"] = "0";
                $array["status"] = "0";
            }

        }

        return $array;
    }

    public function tmp_bar()
    {
        $style = isset($_COOKIE["tmp"]) ? $_COOKIE["tmp"] : "skin-blue";
        $sidebar = isset($_COOKIE["sidebar"]) ? $_COOKIE["sidebar"] : "";
        return $style . " " . $sidebar;
    }

    public function serverlist()
    {
        global $db, $GLOBALS;
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_servers` ORDER BY `id`");
        if( 0 < $db->n_rows($query) ) 
        {
            while( $row = $db->f_arr($query) ) 
            {
                $list .= "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>" . PHP_EOL;
            }
        }
        else
        {
            $list = "";
        }

        return "\r\n\t\t\t<select class=\"form-control\" id=\"server\" name=\"server\" OnChange=\"tarif_list(); time_list(); sel_server();\" required>\r\n\t\t\t\t<option value=\"0\" disabled=\"disabled\" selected=\"selected\">Выбрать сервер</option>\r\n\t\t\t\t" . $list . "\r\n\t\t\t</select>";
    }

    public function tarifs($server_id)
    {
        global $db, $GLOBALS;
        $server_id = abs((int) $server_id);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_tarifs` WHERE `server_id` = '" . $server_id . "'");
        if( 0 < $db->n_rows($query) ) 
        {
            while( $row = $db->f_arr($query) ) 
            {
                $list .= "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>" . PHP_EOL;
            }
        }
        else
        {
            $list = "";
        }

        return "\r\n\t\t\t<select class=\"form-control\" id=\"tarif\" name=\"tarif\" OnChange=\"time_list();\" required>\r\n\t\t\t\t<option value=\"0\" disabled=\"disabled\" selected=\"selected\">Выбрать услугу</option>\r\n\t\t\t\t" . $list . "\r\n\t\t\t</select>";
    }

    public function tarifs_time($tarif_id)
    {
        global $db, $GLOBALS;
        global $curr;
        $tarif_id = abs((int) $tarif_id);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_tarif_time` WHERE `tarif_id` = '" . $tarif_id . "'");
        if( 0 < $db->n_rows($query) ) 
        {
            while( $row = $db->f_arr($query) ) 
            {
                $time = $row["time"] == 0 ? "Навсегда" : $row["time"] . " дн.";
                $list .= "<option value=\"" . $row["time"] . "\">" . $time . " - (<h1>" . $row["price"] . "</h1> " . $curr . ")</option>" . PHP_EOL;
            }
        }
        else
        {
            $list = "";
        }

        return "\r\n\t\t\t<select class=\"form-control\" id=\"time\" name=\"time\" required>\r\n\t\t\t\t<option value=\"net\" disabled=\"disabled\" selected=\"selected\">Выбрать срок</option>\r\n\t\t\t\t" . $list . "\r\n\t\t\t</select>";
    }

    public function up_cfg($server_id, $config_text)
    {
        global $db, $GLOBALS;
        $server_id = abs((int) $server_id);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_servers` WHERE `id` = '" . $server_id . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $row = $db->f_arr($query);
            $tmp_dir = ini_get("upload_tmp_dir") ? ini_get("upload_tmp_dir") : sys_get_temp_dir();
            $local_tmp_configfile = tempnam($tmp_dir, "");
            if( $local_tmp_configfile === false ) 
            {
                $adm_mess = "Внутренняя ошибка генерации конфигурации (возможно недоступен временный каталог)<br />";
                return $adm_mess;
            }

            $handle = fopen($local_tmp_configfile, "w");
            if( !$handle ) 
            {
                $adm_mess = "Внутренняя ошибка генерации конфигурации (возможно он недоступен для записи)<br />";
                return $adm_mess;
            }

            fwrite($handle, $config_text);
            fclose($handle);
            $remote_file = "users.ini";
            if( strpos($row["hostname"], ":") === false ) 
            {
                $ftp_ip = $row["hostname"];
                $ftp_port = 21;
            }
            else
            {
                $strings = explode(":", $row["hostname"]);
                list($ftp_ip, $ftp_port) = $strings;
            }

            $conn_id = @ftp_connect($ftp_ip, $ftp_port);
            if( $conn_id ) 
            {
                $login_result = @ftp_login($conn_id, $row["login"], $row["password"]);
                if( $login_result ) 
                {
                    $chdir = @ftp_chdir($conn_id, $row["path"]);
                    if( $chdir ) 
                    {
                        if( $res = @ftp_put($conn_id, $remote_file, $local_tmp_configfile, FTP_BINARY) ) 
                        {
                            $adm_mess = "Файл конфигурации успешно загружен на Сервер: " . $row["name"] . "<br />";
                            return $adm_mess;
                        }

                        $adm_mess = "Ошибка загрузки файла конфигурации! Сервер: " . $row["name"] . "<br />";
                        return $adm_mess;
                    }

                    $adm_mess = "Не могу перейти в каталог настроек! Сервер: " . $row["name"] . " " . ftp_pwd($conn_id) . "<br />";
                    return $adm_mess;
                }

                $adm_mess = "Ошибка авторизации на FTP во время обновления конфигурации! Сервер: " . $row["name"] . "<br />";
                return $adm_mess;
            }

            $adm_mess = "Не могу подключиться к серверу для обновления конфигурации! Сервер: " . $row["name"] . "<br />";
            return $adm_mess;
        }

        $adm_mess = "Сервер не найден!<br />";
        return $adm_mess;
    }

    public function g_cfg($server_id)
    {
        global $db, $GLOBALS;
        $server_id = abs((int) $server_id);
        $sql = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_admins` WHERE `server_id` = '" . $server_id . "' ORDER BY `utime` = '0' DESC, `utime` DESC");
        $config = "";
        if( 0 < $db->n_rows($sql) ) 
        {
            while( $row = $db->f_arr($sql) ) 
            {
                $datestart = date("d.m.Y [H:i]", $row["time"]);
                if( time() < $row["utime"] || $row["utime"] == 0 ) 
                {
                    $accstatus = $row["utime"] == 0 ? "Бессрочно" : date("d.m.Y [H:i]", $row["utime"]);
                    $config .= "\"" . $row["auth"] . "\" \"" . $row["servpass"] . "\" \"" . $row["access"] . "\" \"" . $row["flags"] . "\" ; \"" . $row["name"] . "\" - \"" . $datestart . "\" - \"" . $accstatus . "\"" . "\r\n";
                }
                else
                {
                    $config .= ";\"" . $row["auth"] . "\" \"" . $row["servpass"] . "\" \"" . $row["access"] . "\" \"" . $row["flags"] . "\" ; \"" . $row["name"] . "\" - \"" . $datestart . "\" - \"Срок истек\"" . "\r\n";
                }

            }
        }

        return $config;
    }

}


class Auth
{
    public function GenerateKey()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while( strlen($code) < 10 ) 
        {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return md5($code);
    }

    public function check_auth()
    {
        global $db, $GLOBALS;
        if( isset($_COOKIE["id"]) && isset($_COOKIE["hash"]) ) 
        {
            $id = abs((int) $_COOKIE["id"]);
            $hash = $db->m_escape($_COOKIE["hash"]);
            $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_admins` WHERE `id` = '" . $id . "' AND `hash` = '" . $hash . "' LIMIT 1");
            if( $db->n_rows($query) == 0 ) 
            {
                return array( "request" => "error" );
            }

        }
        else
        {
            return array( "request" => "error" );
        }

    }

    public function on_auth($login, $password, $server)
    {
        global $db, $GLOBALS;
        $server = abs((int) $server);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_admins` WHERE `auth` = '" . $db->m_escape($login) . "' AND `password` = '" . $db->m_escape($password) . "' AND `server_id` = '" . $server . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $row = $db->f_arr($query);
            $hash = $this->GenerateKey();
            setcookie("hash", $hash, time() + 60 * 60 * 24 * 7, "/");
            setcookie("id", $row["id"], time() + 60 * 60 * 24 * 7, "/");
            $db->m_query("UPDATE `" . $GLOBALS["db_prefix"] . "_admins` SET `hash` = '" . $hash . "' WHERE `id` = '" . $row["id"] . "'");
            return array( "request" => "ok" );
        }

        return array( "request" => "error" );
    }

    public function auth_exit($id)
    {
        global $db, $GLOBALS;
        $id = abs((int) $id);
        $hash = $db->m_escape($_COOKIE["hash"]);
        unset($_COOKIE["id"]);
        unset($_COOKIE["hash"]);
        setcookie("id", NULL, time() - 3600, "/");
        setcookie("hash", NULL, time() - 3600, "/");
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_admins` WHERE `id` = '" . $id . "' AND `hash` = '" . $hash . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $row = $db->f_arr($query);
            $hash = $this->GenerateKey();
            $db->m_query("UPDATE `" . $GLOBALS["db_prefix"] . "_admins` SET `hash` = '" . $hash . "' WHERE `id` = '" . $row["id"] . "'");
        }

    }

    public function auth_info($info, $id, $hash)
    {
        global $db, $GLOBALS;
        $id = abs((int) $id);
        $hash = $db->m_escape($hash);
        $query = $db->m_query("SELECT " . $info . " FROM `" . $GLOBALS["db_prefix"] . "_admins` WHERE `id` = '" . $id . "' AND `hash` = '" . $hash . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $a_info = $db->f_arr($query);
            return $a_info[$info];
        }

    }

    public function user_info($id)
    {
        global $db, $GLOBALS;
        $id = abs((int) $id);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_admins` WHERE `id` = '" . $id . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $row = $db->f_arr($query);
            return $row;
        }

    }

    public function serv_info($id)
    {
        global $db, $GLOBALS;
        $id = abs((int) $id);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_servers` WHERE `id` = '" . $id . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $row = $db->f_arr($query);
            return $row["name"];
        }

    }

    public function tarif_info($id)
    {
        global $db, $GLOBALS;
        $id = abs((int) $id);
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_tarifs` WHERE `id` = '" . $id . "' LIMIT 1");
        if( 0 < $db->n_rows($query) ) 
        {
            $row = $db->f_arr($query);
            return $row["name"];
        }

    }

    public function ch_auth($id)
    {
        global $db, $GLOBALS;
        $id = abs((int) $id);
        $time = time() - 3600 * 24 * 30;
        $db->m_query("DELETE FROM `" . $GLOBALS["db_prefix"] . "_auth_count` WHERE `time` < '" . $time . "'");
        $query = $db->m_query("SELECT * FROM `" . $GLOBALS["db_prefix"] . "_auth_count` WHERE `user_id` = '" . $id . "' LIMIT 1");
        $row = $db->f_arr($query);
        if( 0 < $db->n_rows($query) ) 
        {
            if( $row["count"] == 3 ) 
            {
                $error = 3;
            }
            else
            {
                $db->m_query("UPDATE `" . $GLOBALS["db_prefix"] . "_auth_count` SET `count` = `count`+1 WHERE `user_id` = '" . $id . "' LIMIT 1");
            }

        }
        else
        {
            $db->m_query("INSERT INTO `" . $GLOBALS["db_prefix"] . "_auth_count` (`id`, `user_id`, `time`, `count`) VALUES (NULL, '" . $id . "', '" . time() . "', '1')");
            $error = 1;
        }

        if( !isset($error) ) 
        {
            $error = $row["count"];
        }

        return $error;
    }

}


