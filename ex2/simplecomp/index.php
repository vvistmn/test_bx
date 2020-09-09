<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("простой компонент «Каталог товаров»");
?>Text here....<br>
 <br>
<?$APPLICATION->IncludeComponent(
	"mycomponent:simplecompcatproduct",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"ID_IBLOCK_CATALOG" => "2",
		"ID_IBLOCK_NEWS" => "1",
		"UF_CATALOG_CODE" => "UF_NEWS_LINK"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>