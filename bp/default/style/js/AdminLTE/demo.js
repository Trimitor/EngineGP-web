$(function() {
    /* For demo purposes */
    var demo = $("<div />").css({
        position: "fixed",
        top: "150px",
        right: "0",
        background: "rgba(0, 0, 0, 0.7)",
        "border-radius": "5px 0px 0px 5px",
        padding: "10px 15px",
        "font-size": "16px",
        "z-index": "999999",
        cursor: "pointer",
        color: "#ddd"
    }).html("<i class='fa fa-gear'></i>").addClass("no-print");

    var demo_settings = $("<div />").css({
        "padding": "10px",
        position: "fixed",
        top: "130px",
        right: "-200px",
        background: "#fff",
        border: "3px solid rgba(0, 0, 0, 0.7)",
        "width": "200px",
        "z-index": "999999"
    }).addClass("no-print");
    demo_settings.append(
            "<h4 style='margin: 0 0 5px 0; border-bottom: 1px dashed #ddd; padding-bottom: 3px;'>Параметры</h4>"
            + "<div class='form-group no-margin'>"
            + "<div class='.checkbox'>"
            + "<label>"
			+ (get_cookie("sidebar") ? '<input type=\'checkbox\' onchange=\'del_layout();\' checked=\"checked\"/> Открепить Топ': '<input type=\'checkbox\' onchange=\'change_layout();\'/> Закрепить Топ')
            + "</label>"
            + "</div>"
            + "</div>"
            );
    demo_settings.append(
            "<h4 style='margin: 0 0 5px 0; border-bottom: 1px dashed #ddd; padding-bottom: 3px;'>Стили</h4>"
            + "<div class='form-group no-margin'>"
            + "<div class='.radio'>"
            + "<label>"
			+ (get_cookie("tmp") == 'skin-black' ? '<input name=\'skins\' type=\'radio\' onchange=\'change_skin(\"skin-black\");\' checked=\"checked\"/> ':'<input name=\'skins\' type=\'radio\' onchange=\'change_skin(\"skin-black\");\'"/> ')
            + "Черный"
            + "</label>"
            + "</div>"
            + "</div>"

            + "<div class='form-group no-margin'>"
            + "<div class='.radio'>"
            + "<label>"
			+ (get_cookie("tmp") == 'skin-blue' ? '<input name=\'skins\' type=\'radio\' onchange=\'change_skin(\"skin-blue\");\' checked=\"checked\"/> ':'<input name=\'skins\' type=\'radio\' onchange=\'change_skin(\"skin-blue\");\'"/> ')
            + "Голубой"
            + "</label>"
            + "</div>"
            + "</div>"
            );

    demo.click(function() {
        if (!$(this).hasClass("open")) {
            $(this).css("right", "200px");
            demo_settings.css("right", "0");
            $(this).addClass("open");
        } else {
            $(this).css("right", "0");
            demo_settings.css("right", "-200px");
            $(this).removeClass("open")
        }
    });

    $("body").append(demo);
    $("body").append(demo_settings);

});

function get_cookie ( cookie_name )
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

function change_layout() {
    $("body").toggleClass("fixed");
	var dates = new Date( new Date().getTime() + 60 * 60 * 24 * 7 * 1000 );
	document.cookie = "sidebar=fixed; path=/; expires="+dates.toUTCString();
    fix_sidebar();
}

function del_layout() {
	document.cookie = "sidebar=; path=/";
	$("body").toggleClass("fixed");
	fix_sidebar();
}

function change_skin(cls) {
    $("body").removeClass("skin-blue skin-black");
    $("body").addClass(cls);
	var dates = new Date( new Date().getTime() + 60 * 60 * 24 * 7 * 1000 );
	var updatedCookie = "tmp=" + cls + "; path=/; expires="+dates.toUTCString();
	document.cookie = updatedCookie;
}