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
        "NEWS_IBLOCK_ID"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => "ID  инфоблока с новостями",
			"TYPE" => "STRING",
		),
        "UF_CATALOG_CODE" => array(
            "PARENT" => "BASE",
			"NAME" => "Код пользовательского свойстваразделов каталога, в котором хранится привязка кновостям",
			"TYPE" => "STRING",
        ),
        "CACHE_TIME" => array("DEFAULT" => 360000)
    ),    
);
?>