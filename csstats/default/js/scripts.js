/* Popup */
  $(function() {
    $(".p_anch a").simplePopup();
  });


/* Table Select */
function tableRuler() {

if (document.getElementById) { 
tables = document.getElementsByTagName("table")

for (i=0;i<tables.length;i++) {

if (tables[i].className == "sortable") {

trs = tables[i].getElementsByTagName("tr")

for (j=0;j<trs.length;j++) {

if (trs[j].className != "shapka") {

trs[j].onmouseover = function() { this.className = "line"; return false }
trs[j].onmouseout = function() { this.className = ""; return false }
} } } } }
}


/* hz */
$(document).ready(
  function()
  {
  	$(".listtable tr").mouseover(function() {
  		$(this).addClass("over");
  	});
  
  	$(".listtable tr").mouseout(function() {
  		$(this).removeClass("over");
  	});
  	
  	$(".listtable tr:even").addClass("alt");
  }
);


/* Spoiler */
$(document).ready(function(){
 $('.spoiler_links').click(function(){
  $(this).parent().children('div.spoiler_body').toggle('normal');
  return false;
 });
});

/* Online */
function is_user_online(name)
{
	var p_online = document.getElementById("p_online").innerHTML
	document.getElementById("p_online").innerHTML="<img src='img/wait.gif' width='16px'>";
	
	var xmlhttp;
	if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest();else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var otvet = xmlhttp.responseText;
			if (otvet == "none") document.getElementById("p_online").innerHTML = p_online;
			else
			{
				var numbers = otvet.split('|');
				document.getElementById("p_online").innerHTML="<a class='label label-on' title='Зайти на сервер' href='steam://connect/"+numbers[0]+"'>Online</a>";
			}
		}
	}
	xmlhttp.open("GET", "include/check_online.php?name="+encodeURIComponent(name), true);xmlhttp.send();
}