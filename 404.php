<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Запрашивая страница не найдена");
?>

<section class="l-error__page-section">
	<div class="l-wrapper">
		<div class="l-section__title">
			<h1>
				Ой, страница не найдена!
			</h1>
		</div>
		<div class="l-error">
			<span class="l-title">404</span>
			<span class="l-text">Приехали…Страница не найдена. Она была удалена, либо вовсе не существовала на сайте.</span>
			<div class="l-footer__top-action mob-hidden">
				<a class="btn btn-yellow" href="/">Перейти на главную</a>
			</div>
		</div>
	</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
