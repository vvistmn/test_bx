<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("[ex2-97] Разработать простой компонент «Новости по интересам» ");
?><?$APPLICATION->IncludeComponent(
	"simplecomp3",
	"",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"NEWS_IBLOCK_ID" => "1",
		"NEWS_PROPERTY_AUTHOR" => "AUTHOR",
		"USER_UF_CODE" => "UF_AUTHOR_TYPE"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>