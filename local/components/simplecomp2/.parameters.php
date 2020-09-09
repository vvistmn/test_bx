<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<?
$arComponentParameters = array(
    "PARAMETERS" => array(
        "CAT_IBLOCK_ID"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => "ID  инфоблока с каталогом товаров",
			"TYPE" => "STRING",
		),
        "CLASS_IBLOCK_ID"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => "ID  инфоблокас классификатором",
			"TYPE" => "STRING",
		),
        "TEMPLATE_DETAIL_LINK" => array(
            "PARENT" => "BASE",
			"NAME" => "Шаблон ссылки на детальный просмотр товара",
			"TYPE" => "STRING",
        ),
        "CATALOG_PROPERTY_CODE" => array(
            "PARENT" => "BASE",
			"NAME" => "Код свойства товара, в котором хранится привязка товара к классификатору",
			"TYPE" => "STRING",
        ),
        "PAGE_NAVIGATION" => array(
            "PARENT" => "BASE",
            "NAME" => "Количество элементов на странице",
            "TYPE" => "STRING",
        ),
        "CACHE_TIME" => array("DEFAULT" => 360000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => "Учитывать права групп",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
    ),    
);
?>