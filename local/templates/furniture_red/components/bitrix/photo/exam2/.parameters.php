<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
    return;

$arComponentParameters = array(

    "PARAMETERS" => array(

        "VARIABLE_ALIASES" => Array(
            "SECTION_ID" => Array("NAME" => GetMessage("SECTION_ID_DESC")),
            "ELEMENT_ID" => Array("NAME" => GetMessage("ELEMENT_ID_DESC")),
//Добавили переменные
            "PARAM1" => Array("NAME" => GetMessage("PARAM1")),
            "PARAM2" => Array("NAME" => GetMessage("PARAM2")),
        ),
        "SEF_MODE" => Array(
            "sections_top" => array(
                "NAME" => GetMessage("SECTIONS_TOP_PAGE"),
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "section" => array(
                "NAME" => GetMessage("SECTION_PAGE"),
                "DEFAULT" => "#SECTION_ID#/",
                "VARIABLES" => array("SECTION_ID"),
            ),
            "detail" => array(
                "NAME" => GetMessage("DETAIL_PAGE"),
                "DEFAULT" => "#SECTION_ID#/#ELEMENT_ID#/",
                "VARIABLES" => array("ELEMENT_ID", "SECTION_ID"),
            ),
//добавили новую страницу
            "exampage" => array(
                "NAME" => GetMessage("EXAM_PAGE"),
                "DEFAULT" => "exam/new/#PARAM1#/?PARAM2=#PARAM2#",
                "VARIABLES" => array("PARAM1", "PARAM2"),
            ),
        ),
    ),
);
