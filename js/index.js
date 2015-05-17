/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-03-03 13:06:59
 * @version $Id$
 */

$(".menu").click(function(){
	var $submenu=$(document.getElementById(this.name));
    	$submenu.toggle("slow");
});

 var div_row = document.getElementById("div-row");