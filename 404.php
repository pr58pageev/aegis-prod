<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);
 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?><div class="origami_404">
	<div class="origami_404_block">
		<div class="origami_404_block__main">
			<img src="/404.jpg" />
		</div>
		<div class="origami_404_block__text">
			<h2>
				 Ошибка 404. Страница очищена.
			</h2>
			<div class="origami_404_block__text_comment">
				 К сожалению, вы перешли по неправильной ссылке. Вы можете вернуться на <a href="/">главную</a> или перейти в <a href="/catalog/">каталог</a>.
			</div>
		</div>
	</div>
	
</div>

<style>
.origami_404_block__text_comment a{color: #244ed5; text-decoration:underline}
.origami_404_block__text_comment a:hover{text-decoration:none}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>