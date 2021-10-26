function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function get_stats(top,w,h,s,url) {
	var xmlhttp = getXmlHttp();
	var padding = '';
	if(h=="auto") { h = 'auto'; padding = 'padding-bottom: 20px;'; h2='auto';}
	else { h2 = (h-60)+'px'; h = h+'px';}
	xmlhttp.open("GET", "http://"+url+"index.php?a=api&id="+s+"&type=json&c="+top, true);
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState != 4) return
	  clearTimeout(timeout);
	  if (xmlhttp.status == 200) {
		document.getElementById('monitor').innerHTML = '<div id="mon_div_index" style="width: '+w+'px; min-height: '+h+'; background: #7E9171; border: 1px solid #B2BEAA; margin:1px; '+padding+'"><div style="color: #E6EAE4; font: 1.3em Arial,sans-serif; padding-left: 10px; padding-top:5px">Топ '+top+' игроков</div><div style="margin: 7px; border: 1px solid #3E4637; overflow:auto; height: '+h2+';"><table style="border: 1px solid;border-color: #282e22 #889180 #889180 #282e22; width: 100%;line-height: 160%;font-size: 12px;max-width: 100%;background-color: transparent;border-collapse: collapse;border-spacing: 0; border-spacing: 2px;border-color: gray;color: #d8ded3;font-family: sans-serif;height:100%;"><thead style="display: table-header-group;vertical-align: middle;border-color: inherit;"><tr style="background: #3e4637;display: table-row;vertical-align: inherit;border-color: inherit;"><td><strong>#</strong></td><td><strong>Nick</strong></td><td><strong>Kills</strong></td><td><strong>Deaths</strong></td></tr></thead><tbody id="tbody">';
		  var stats = JSON.parse(xmlhttp.responseText);
		  var i = 1;
		  for ( key in stats){
			if (i % 2 == 0) color = '#393e34';
			else color = '#3e4637';
			document.getElementById('tbody').innerHTML += "<tr style=\"background:"+color+";display: table-row;vertical-align: inherit;border-color: inherit;\"><td style=\"padding-left: 7px;\">"+stats[key].rank+'</td><td style="padding-left: 7px;color: #fff;"><a href="http://'+url+'?a=stats&n='+stats[key].rank+'&id='+s+'" style="text-decoration: none; color: #E6EAE4;"><strong>'+stats[key].nick.substr(0,10)+'</strong></a></td><td style="padding-left: 7px;">'+stats[key].kills+'</td><td style="padding-left: 7px;">'+stats[key].deaths+'</td></tr>';
			i++;
		  }
		  document.getElementById('mon_div_index').innerHTML += '<a style="text-decoration: none; color: #E6EAE4; font: 0.7em Arial,sans-serif; float: right !important; padding-right: 5px;" href="http://assada.com.ua/cs/">assada.com.ua © 2014</a>'
		  } else {
		  handleError(xmlhttp.statusText);
	  }
	}
	xmlhttp.send();
	var timeout = setTimeout( function(){ xmlhttp.abort(); handleError("Time over") }, 10000);
	function handleError(message) {
	  console.log("AStats Top Widget Error: "+message)
	}
}