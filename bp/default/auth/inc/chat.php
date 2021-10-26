<?php 
	if ( ! defined ( 'BLOCK' ) )
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
	
	echo '
	<script type="text/javascript">
		function write_to (msg_id){
			$("#redex").val(\'[b]\' + $(\'#chat-box #copy_name_\' + msg_id).html() + \'[/b], \');
			$("#redex").focus();
			return false;
		}
		
		$(document).ready(function () {
			setInterval("Load();", 3000);
			$("#redex").keyup(function (){
				number = $("#redex").val().length;
				$("#count").html(number);
			});
			
			$("#redex").keypress(function(e){
				if(e.keyCode==13) Send();
			});
		});  
		
		function Send() {
			var text = $("#redex").val();	
			var user_id = "'.$_COOKIE['id'].'";
			if(text == "") {
				alert("Введите сообщение!");
			} else {
				$.ajax({
					url: "action.php",
					type: "POST",
					data: {act: 1, user_id: user_id, text_chat: text},
					success: function(){
						$("#redex").val("");
					}
				});
			}
		};
		
		jQuery.fn.extend({
			insertAtCaret: function(myValue){
				return this.each(function(i) {
					if (document.selection) {
						// Для браузеров типа Internet Explorer
						this.focus();
						var sel = document.selection.createRange();
						sel.text = myValue;
						this.focus();
					}
					else if (this.selectionStart || this.selectionStart == \'0\') {
						// Для браузеров типа Firefox и других Webkit-ов
						var startPos = this.selectionStart;
						var endPos = this.selectionEnd;
						var scrollTop = this.scrollTop;
						this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
						this.focus();
						this.selectionStart = startPos + myValue.length;
						this.selectionEnd = startPos + myValue.length;
						this.scrollTop = scrollTop;
					} else {
						this.value += myValue;
						this.focus();
					}
				})
			}
		});
		
		function smiles(smile) {
			$("#redex").insertAtCaret(smile);
		}
		
		function Clear_redex(){
			$("#redex").val("");
			$("#count").html(0);
		}
		
		function Load() {
			var id_mess = $("div[name=message]:first").attr("id");
			$.ajax({
				url: "action.php",
				type: "POST",
				data: {act: 2, id_mess: id_mess},
				success: function(data){
					if(data==1) {
					} else {
						$("div[name=clear_chat]").remove();
						$("#chat-box").prepend(data);
					}
				}
			});
		};
	</script>
	<!-- Chat box -->
	<div class="box box-success">
		<div class="box-header">
			<i class="fa fa-comments-o"></i>
			<h3 class="box-title">Чат</h3>
		   <div class="box-tools pull-right">
				<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
				<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body chat">
			<div id="chat-box">';
			
			$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_chat_mess` ORDER BY `id` DESC LIMIT 15" );
			
			if ( $db->n_rows( $query ) > 0 )
			{
				while( $arr = $db->f_arr( $query ) ) 
				{
					$base = $at->user_info( $arr['user_id'] );
					$text = $eng->insert_smiles( $arr['text'] );
					$text = preg_replace("#\[b\](.+?)\[\/b\]#is", "<b>\\1</b>", $text);
					
					echo '
					<!-- chat item -->
					<div name="message" class="item" id="'.$arr['id'].'">
						<img src="'.$url.'style/img/avatar5.png" alt="user image" class="online"/>
						<p class="message" style="word-wrap: break-word;">
							<a class="name">
								<span style="cursor:pointer;" class="text-light-blue" onclick="return write_to('.$arr['user_id'].')" id="copy_name_'.$arr['user_id'].'">'.$base['auth'].'</span>
								<small class="text-muted pull-right" data-toggle="tooltip" title="" data-placement="left" data-original-title="'.$eng->chat_time( $arr['time'] ).'"><i class="fa fa-clock-o"></i> '.$eng->chat_time( $arr['time'] ).'</small>
							</a>
							'.$text.'
						</p>
					</div><!-- /.item -->';
				}
			} else {
				echo '
				<div name="clear_chat" class="item">
					<img src="'.$url.'style/img/avatar04.png" alt="user image" class="online"/>
					<p class="message">
					<a class="name text-red">Бот</a>
						Чат пустой, но вы можете начать его своим сообщениям!
					</p>
				</div>';
			}
		echo '
			</div><!-- /.chat box -->
		</div><!-- /.chat -->
		<div class="box-footer">
			<div class="input-group" id="formchat">
				<input maxlength="200" required class="form-control" id="redex" name="redex" placeholder="Введите сообщение">
				<div class="input-group-btn">
					<span><i class="fa fa-smile-o"></i>8o</span>
					<button id="allsmiles" class="btn btn-success" data-trigger="focus" data-original-title="" title=""><i class="fa fa-smile-o"></i></button>	
					<button class="btn btn-success" onclick="Clear_redex()"><span id="count">0</span>/200</button>						
					<button onclick="Send(); Load();" class="btn btn-success"><i class="fa fa-arrow-right"></i></button>
				</div>
			</div>
			<div id="contentsmiles" class="hide"> 
				<table class="table" style="width:200px;">
					<tbody>
						<tr>
							<td><img onclick="smiles(\'=)\')" style="cursor: pointer;" src="../style/img/smiles/icon_smile.gif" title="Улыбка"/></td>
							<td><img onclick="smiles(\':(\')" style="cursor: pointer;" src="../style/img/smiles/icon_sad.gif" title="Грусть"/></td>
							<td><img onclick="smiles(\':W\')" style="cursor: pointer;" src="../style/img/smiles/icon_wink.gif" title="Подмигивание"/></td>
							<td><img onclick="smiles(\':P\')" style="cursor: pointer;" src="../style/img/smiles/icon_razz.gif" title="Язык"/></td>
							<td><img onclick="smiles(\':-D\')" style="cursor: pointer;" src="../style/img/smiles/icon_biggrin.gif" title="Ржач"/></td>
						</tr>
						<tr>
							<td><img onclick="smiles(\'=-O\')" style="cursor: pointer;" src="../style/img/smiles/icon_eek.gif" title="Офигел"/></td>
							<td><img onclick="smiles(\':-!\')" style="cursor: pointer;" src="../style/img/smiles/icon_sick.gif" title="Нудота"/></td>
							<td><img onclick="smiles(\':L\')" style="cursor: pointer;" src="../style/img/smiles/icon_love.gif" title="Любовь"/></td>
							<td><img onclick="smiles(\':C\')" style="cursor: pointer;" src="../style/img/smiles/icon_mrgreen.gif" title="Двинутый"/></td>
							<td><img onclick="smiles(\':Y\')" style="cursor: pointer;" src="../style/img/smiles/icon_yahoo.gif" title="Радость"/></td>
						</tr>
						<tr>	
							<td><img onclick="smiles(\':lol\')" style="cursor: pointer;" src="../style/img/smiles/icon_lol.gif" title="Лол"/></td>
							<td><img onclick="smiles(\'8)\')" style="cursor: pointer;" src="../style/img/smiles/icon_cool.gif" title="Блатной"/></td>
							<td><img onclick="smiles(\':red\')" style="cursor: pointer;" src="../style/img/smiles/icon_red.gif" title="Покраснел"/></td>
							<td><img onclick="smiles(\':G\')" style="cursor: pointer;" src="../style/img/smiles/icon_nice.gif" title="Отлично"/></td>
							<td><img onclick="smiles(\':Devil\')" style="cursor: pointer;" src="../style/img/smiles/icon_devil.gif" title="Дьявол"/></td>
						</tr>
						<tr>	
							<td><img onclick="smiles(\'@=\')" style="cursor: pointer;" src="../style/img/smiles/icon_bomb.gif" title="Бомба"/></td>
							<td><img onclick="smiles(\':S\')" style="cursor: pointer;" src="../style/img/smiles/icon_stop.gif" title="Стоп"/></td>
							<td><img onclick="smiles(\':sos\')" style="cursor: pointer;" src="../style/img/smiles/icon_sos.gif" title="Помощь"/></td>
							<td><img onclick="smiles(\':B\')" style="cursor: pointer;" src="../style/img/smiles/icon_bear.gif" title="Пиво"/></td>
							<td><img onclick="smiles(\':MS\')" style="cursor: pointer;" src="../style/img/smiles/ms.gif" title="Музыка"/></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div><!-- /.box (chat box) -->';
?>