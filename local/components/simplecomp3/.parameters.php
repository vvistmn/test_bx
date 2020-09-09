<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => "ID  информационного блока сновостями",
			"TYPE" => "STRING",
		),
		"NEWS_PROPERTY_AUTHOR"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => "Код  свойстваинформационного  блока,  в  котором  хранится Автор",
			"TYPE" => "STRING",
		),
		"USER_UF_CODE"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => "Код пользовательского свойства пользователей,  в  котором  хранится тип  автора",
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