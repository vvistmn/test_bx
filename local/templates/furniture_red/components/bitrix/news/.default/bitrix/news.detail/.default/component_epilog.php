
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["CANONICAL_LINK"])) {
    $APPLICATION->SetPageProperty("canonical", $arResult["CANONICAL_LINK"]);
}
?>
<?
if($_GET["TYPE"] == "REPORT_RESULT") {
echo '<script>'.PHP_EOL;
    echo 'var textElem = document.getElementById("ajax_text");'.PHP_EOL;
    if($_GET["ID"]) {
        echo 'textElem.innerText = "Ваше мнение учтено №'.$_GET["ID"].'";'.PHP_EOL;
    } else {
        echo 'textElem.innerText = "Ошибка без AJAX";'.PHP_EOL;
    }
    echo '</script>'.PHP_EOL;
} else {
    if(isset($_GET["ID"]) && CModule::IncludeModule("iblock")){
        $answer = array();

        $user = "";
        global $USER;
        if($USER->IsAuthorized()) {
        $user = $USER->GetID()." (".$USER->GetLogin().") ".$USER->GetFullName();
        } else {
        $user = "Не авторизирован";
        }

        $arFields = array(
            "IBLOCK_ID" => 8,
            "NAME" => "Новость ".$_GET["ID"],
            "ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL"),
            "PROPERTY_VALUES" => array(
            "USER" => $user,
            "NEWS" => $_GET["ID"]
            ),
        );

        $newElement = new CIBlockElement();

        if($element = $newElement->Add($arFields)) {
        $answer["ID"] = $element;

            if($_GET["TYPE"] == "REPORT_AJAX") {
                $APPLICATION->RestartBuffer();
                echo json_encode($answer);
                exit;
            } elseif ($_GET['TYPE'] == 'REPORT_GET') {
                LocalRedirect($APPLICATION->GetCurPage() . "?TYPE=REPORT_RESULT&ID=" . $answer['ID']);
            }
        } else {
            LocalRedirect($APPLICATION->GetCurPage() . "?TYPE=REPORT_RESULT");
        }
    }
}
?>
