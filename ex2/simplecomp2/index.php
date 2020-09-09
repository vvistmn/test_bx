<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("[ex2-71] Разработать простой компонент «Каталог товаров»");
?><?$APPLICATION->IncludeComponent(
	"simplecomp2",
	"",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"CATALOG_PROPERTY_CODE" => "FIRM_LINK",
		"CAT_IBLOCK_ID" => "2",
		"CLASS_IBLOCK_ID" => "7",
		"PAGE_NAVIGATION" => "1",
		"TEMPLATE_DETAIL_LINK" => "catalog_exam/#SECTION_ID#/#ELEMENT_CODE#"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>