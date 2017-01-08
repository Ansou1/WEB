$(function(){

	var $mainMenuItems = $("#main-menu ul").children("li"),
		totalMainMenuItems = $mainMenuItems.length,
		openedIndex = -1,
		init = function () {

			$mainMenuItems.children(".images").click(function(){
				var newIndex = $(this).parent().index();
				if (openedIndex === newIndex) 
				{
					animateItem($item, true, 250);
				}
				$item = $mainMenuItems.eq(newIndex);
				animateItem($item, true, 250);
				openedIndex = newIndex;
			});
		},
		animateItem = function($item, toOpen, speed){
				var $colorImage = $item.find(".color"),
				itemParam = toOpen ? {width:"420px"} : {width:"140px"},
				colorImageParam = toOpen ? {left:"0px"} : {left:"140px"};
				$colorImage.animate(colorImageParam, speed);
				$item.animate(itemParam, speed);
		};
		init();
});