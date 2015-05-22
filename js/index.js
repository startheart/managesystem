/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-03-03 13:06:59
 * @version $Id$
 */

/*$(".menu").click(function(){
	var $submenu=$(document.getElementById(this.name));
    	$submenu.toggle("slow");
});

 var div_row = document.getElementById("div-row");
 */
 (function () {
 	var $tabWrappers = $(".tab-wrapper>a");
 	var $tabLists = $(".tab-menuWrapper");
 	var $tabMenus = $(".J_tab-menu");
 	var $tabContents = $(".tab-contentWrapper");

 	console.log($tabMenus);
 	console.log($tabWrappers[1]);
 	/**
 	 * 循环左侧tab导航
 	 * @param  {[type]} var i             [description]
 	 * @return {[type]}     [description]
 	 */
 	for (var i = $tabWrappers.length - 1; i >= 0; i--) {
 		$tabWrappers[i]._index = i;
 		$tabWrappers[i].onclick = function () {
 			//alert(this._index);
 			for (var j = $tabLists.length - 1; j >= 0; j--) {
 				$($tabLists[j]).hide('slow');
 				$($tabWrappers[j]).css({ "color": "#337ab7"});
 			};
 			$($tabLists[this._index]).show('slow');
 			$($tabWrappers[this._index]).css({ "color": "#fff"});
 		};
 	};
 	/**
 	 * 循环右侧列表对应的内容
 	 * @param  {[type]} var i             [description]
 	 * @return {[type]}     [description]
 	 */
 	for (var i = $tabMenus.length - 1; i >= 0; i--) {
 		$tabMenus[i]._index = i;
 		$tabMenus[i].onclick = function () {
 			for (var j = $tabContents.length - 1; j >= 0; j--) {
 				$($tabContents[j]).hide();
 				$($tabMenus[j]).css({ "color": "#337ab7"});
 			};
 			$($tabContents[this._index]).show('slow');
 			$($tabMenus[this._index]).css({ "color": "#fff"});
 		};
 	};
	$('#signData').highcharts({
		chart: {
			type: 'areaspline'
		},
		title: {
			text: '员工考勤周数据'
		},
		legend: {
			layout: 'vertical',
			align: 'left',
			verticalAlign: 'top',
			x: 150,
			y: 100,
			floating: true,
			borderWidth: 1,
			backgroundColor: '#FFFFFF'
		},
		xAxis: {
			categories: ['周日', '周一', '周二', '周三', '周四', '周五','周六']
		},
		yAxis: {
			floor: 0,
			title: {
				text: '人数'
			}
		},
		tooltip: {
			shared: true,
			valueSuffix: '人'
		},
		credits: {
			text: '晨电智能科技有限公司', // 显示的文字
			href: 'http://www.ixuanlun.com' // 链接地址
		},
		plotOptions: {
			areaspline: {
				fillOpacity: 0.5
			}
		},
		series: [{
			name: '应到人数',
			data: [200,210,220,200,230,240,235]
		}, {
			name: '实到人数',
			data: [195,200,210,190,210,220,210]
		}]
	});
 })();