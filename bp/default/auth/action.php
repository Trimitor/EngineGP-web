<?php
	define ( 'BLOCK', true );
	@require_once '../core/cfg.php';
	
	if ( isset( $_POST['act'] ) ) 
	{
		switch ( $_POST['act'] )
		{
			case "1" :
				Send();
				break;
			case "2" :
				Load();
				break;
			default :
				exit();
		}
	}

	function Send()
	{
		global $db;
		
		$user_id = abs( ( int ) $_POST['user_id'] );
		$text = mb_substr( $_POST['text_chat'], 0, 200 );
		$text = $db->m_escape( $text );
		
		$reg_Url = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		
		if ( preg_match( $reg_Url, $text, $urls ) ) {
			$text = preg_replace( $reg_Url, '<a href="'.$urls[0].'" target="_blank">'.$urls[0].'</a>', $text );
		}

		$db->m_query( "INSERT INTO `".$GLOBALS['db_prefix']."_chat_mess` (id, user_id, time, text) VALUES (NULL, '".$user_id."', '".time()."', '".$text."')" );
	}

	function Load()
	{
		global $db, $at, $eng, $url;
		
		$id = abs( ( int ) $_POST['id_mess'] );
		$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_chat_mess` WHERE `id` > '".$id."' LIMIT 15" );
		
		if ( $db->n_rows( $query ) > 0 )
		{
			while( $arr = $db->f_arr( $query ) ) 
			{
				$base = $at->user_info( $arr['user_id'] );
				$text = $eng->insert_smiles( $arr['text'] );
				$text = preg_replace( "#\[b\](.+?)\[\/b\]#is", "<b>\\1</b>", $text );
				
				echo '
				<!-- chat item -->
				<div name="message" class="item" id="'.$arr['id'].'">
					<img src="'.$url.'style/img/avatar5.png" alt="user image" class="online"/>
					<p class="message">
						<a class="name">
							<span style="cursor:pointer;" class="text-light-blue" onclick="return write_to('.$arr['user_id'].')" id="copy_name_'.$arr['user_id'].'">'.$base['auth'].'</span>
							<small class="text-muted pull-right" data-toggle="tooltip" title="" data-placement="left" data-original-title="'.$eng->chat_time( $arr['time'] ).'"><i class="fa fa-clock-o"></i> '.$eng->chat_time( $arr['time'] ).'</small>
						</a>
						'.$text.'
					</p>
				</div><!-- /.item -->';
			}
		} else {
			echo 1;	
		}
	}
?>