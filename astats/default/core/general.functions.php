<?php
	function pagination($total, $per_page, $num_links, $cur_page,$server_id, $url='', $style='pagination', $text=''){
		$itemscount=$total+$per_page*$num_links;
		$itemsperpage=$per_page;
		$pagedisprange=$num_links;
		
		$pagescount=ceil($itemscount/$itemsperpage);
		$stpage=$cur_page-$pagedisprange;
		if ($stpage<1) { $stpage=1; }
		$endpage=$cur_page+$pagedisprange;
		if ($endpage>$pagescount) { $endpage=$pagescount; }
		if ($cur_page>1) {
			$output .= '<li><a href="?p=1&id='.$server_id.'"><<</a></li> ';
			$output .= '<li><a href="?p='.($cur_page-1).'&id='.$server_id.'"><</a></li> ';
		}
		if ($stpage>1) $output .= '... ';
		for ($i=$stpage;$i<=$endpage;$i++) { 
			if ($i==$cur_page) { $output .= '<li class="active"><a href="#">'.$i.'<span class="sr-only">(current)</span></a></li>'; }
			else{ $output .= '<li><a href="?p='.$i.'&id='.$server_id.'">'.$i.'</a></li>'; }
		}
		if ($endpage<$pagescount and $endpage !=$cur_page) $output .= '... ';
		if ($cur_page<$pagescount and $endpage !=$cur_page) {
			$output .= '<li><a href="?p='.($cur_page+1).'&id='.$server_id.'">></a></li>';
			$output .= '<li><a href="?p='.$pagescount.'&id='.$server_id.'">>></a></li>';
		}
		return $text.'<ul class="'.$style.'">'.$output.'</ul>';
	}
	
	function col_lines($path){ 
		if(!file_exists($path)) exit("Error! File not found!");
		$file_arr = file($path); 
		$col_lines = count($file_arr); 
		return $col_lines; 
	}
	
	function get_server_info($server, $port, $engine='SOURCE', $name=false){
		$return = array();
		$Query = new SourceQuery();
		if ($engine == 'SOURCE')$Query->Connect( $server, $port, 1, SourceQuery :: SOURCE );
		else $Query->Connect($server, $port, 1, SourceQuery :: GOLDSOURCE);
		$return = $Query->GetInfo();
		$Query->Disconnect( );
		if (!$name) $return['Address'] = $server.":".$port;
		if (!$return['HostName']){
			$return['HostName'] = "Unknown";
			$return['Map'] = "Unknown";
			$return['Players'] = 0;
			$return['MaxPlayers'] = 0;
		}
		//if ($name) return $return['HostName'];
		//else return $return;
		return ($name) ? $return['HostName'] : $return;
	}
	
	function object_to_array($var) {
		$result = array();
		$references = array();
		foreach ($var as $key => $value) {
			if (is_object($value) || is_array($value)) {
				if (!in_array($value, $references)) {
					$result[$key] = object_to_array($value);
					$references[] = $value;
				}
			} else {
				$result[$key] = $value;
			}
		}
		return $result;
	}

	function json_encode2($param) {
		if (is_object($param) || is_array($param)) {
			$param = object_to_array($param);
		}
		return json_encode($param);
	}
	
	function get_map_image($map){
		if(file_exists("image/maps/{$map}.jpg")) $image_url = "image/maps/{$map}.jpg";
		else $image_url = "image/noimage.gif";
		return $image_url;
	}
