<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "SET_SPECIAL_DATE" => Array(
        "NAME" => "Установить свойство страницы specialdate",
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
    ),
    "CANONICAL_IBLOCK_ID" => Array(
        "NAME" => "ID информационного блока для rel=canonical",
        "TYPE" => "STRING",
        "DEFAULT" => "N",
    ),
    "REPORT_AJAX" => array(
        "NAME" => "Cобирать жалобы в режиме AJAX",
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
        ),
);