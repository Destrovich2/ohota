
; /* Start:"a:4:{s:4:"full";s:83:"/bitrix/templates/aspro_max/components/bitrix/news/blog/script.min.js?1629702722833";s:6:"source";s:65:"/bitrix/templates/aspro_max/components/bitrix/news/blog/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
$(document).ready(function(){InitScrollBar(),$(".select_head_wrap .menu_item_selected span").text($(".select_head_wrap .head-block .item-link.active").text()),$(".select_head_wrap .menu_item_selected").on("click",function(){window.matchMedia("(max-width: 767px)").matches&&($(this).toggleClass("opened"),$(this).closest(".select_head_wrap").find(".head-block").slideToggle(200))}),$(".select_head_wrap .btn-inline").on("click",function(){var e=$(this).text(),t=$(this).closest(".select_head_wrap");t.find(".menu_item_selected span").text(e),t.find(".menu_item_selected").removeClass("opened"),window.matchMedia("(max-width: 767px)").matches&&t.find(".head-block").slideUp(200)}),$("html, body").on("mousedown",function(e){$(e.target).closest(".select_head_wrap").length||$(".select_head_wrap .menu_item_selected.opened").click()})});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:93:"/bitrix/templates/aspro_max/components/bitrix/news.list/news-list/script.min.js?1629702722608";s:6:"source";s:75:"/bitrix/templates/aspro_max/components/bitrix/news.list/news-list/script.js";s:3:"min";s:79:"/bitrix/templates/aspro_max/components/bitrix/news.list/news-list/script.min.js";s:3:"map";s:83:"/bitrix/templates/aspro_max/components/bitrix/news.list/news-list/script.min.js.map";}"*/
$(document).ready((function(){var containerEl=document.querySelector(".mixitup-container");if(containerEl){var config,mixer=mixitup(containerEl,{selectors:{target:'[data-ref="mixitup-target"]'},animation:{effects:"fade scale stagger(50ms)"},load:{filter:"none"},animation:{duration:350},controls:{scope:"local"},callbacks:{onMixStart:function(state){},onMixEnd:function(){InitLazyLoad()}}});containerEl.classList.add("mixitup-ready"),mixer.show().then((function(){mixer.configure({animation:{effects:"fade scale"}})}))}})),readyDOM((function(){checkLinkedArticles()}));
/* End */
;; /* /bitrix/templates/aspro_max/components/bitrix/news/blog/script.min.js?1629702722833*/
; /* /bitrix/templates/aspro_max/components/bitrix/news.list/news-list/script.min.js?1629702722608*/

//# sourceMappingURL=page_6d2a0150cf28a55a7f417aceb40bee7b.map.js