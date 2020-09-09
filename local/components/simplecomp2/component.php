<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<?
if(!CModule::IncludeModule("Iblock")) {
    ShowError("Ошибка в подключении инфоблока");
    return false;
}

// [ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги».
global $CACHE_MANAGER;
// [ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги».


// [ex2-49]Добавить дополнительную фильтрациюэлементов в созданный простой компонент«Каталог товаров».
$filterSort = false;
if(!empty($_GET["F"])) {
    $filterSort = true;
}
// [ex2-49]Добавить дополнительную фильтрациюэлементов в созданный простой компонент«Каталог товаров».

// [ex2-60] Добавить постраничную навигацию в созданный простой компонент
$arParams["PAGE_NAVIGATION"] = intval($arParams["PAGE_NAVIGATION"]);
$arParams["PAGER_TITLE"] = "Странички";
$arParams["PAGER_SHOW_ALL"] = "Y";
$arNavParams = array(
    "nPageSize" => $arParams['PAGE_NAVIGATION'],
    "bShowAll"  => $arParams["PAGER_SHOW_ALL"],
);
$arNavigation = CDBResult::GetNavParams($arNavParams);
// [ex2-60] Добавить постраничную навигацию в созданный простой компонент

global $USER;
if($this->StartResultCache($arParams["CACHE_TIME"], [$USER->GetGroups(), $filterSort, $arNavigation])) {
    // [ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги».
    if (defined('BX_COMP_MANAGED_CACHE')) {
        $CACHE_MANAGER->RegisterTag("iblock_id_" . 3);
    }
    // [ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги».

    $arResult["FIRM"] = array();
    
    $firmFilter = array("IBLOCK_ID" => $arParams["CLASS_IBLOCK_ID"], "CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"], "ACTIVE" => "Y");
    
    $firmSelect = array("ID", "NAME");
    
    $firms = CIBlockElement::GetList(array(), $firmFilter, false, $arNavParams, $firmSelect);

    $arResult["NAV_STRING"] = $firms->GetPageNavStringEx(
        $navComponentObject,
        $arParams["PAGER_TITLE"],
        " ",
        $arParams["PAGER_SHOW_ALL"]
    );

    while($firm = $firms->GEtNext()) {
        $arResult["FIRM"][$firm["ID"]] = $firm;
    }

    $firmsID = array_column($arResult["FIRM"], "ID");
    $arResult["COUNT"] = count($arResult["FIRM"]);

    // [ex2-81]  Внести доработки в созданный простой компонент «Каталог товаров»
    $elementSort = array("NAME" => "ASC", "SORT" => "ASC");
    // [ex2-81]  Внести доработки в созданный простой компонент «Каталог товаров»

    $elementFilter = array("IBLOCK_ID" => $arParams["CAT_IBLOCK_ID"],
        "CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
        "PROPERTY_".$arParams["CATALOG_PROPERTY_CODE"] => $firmsID,
        "ACTIVE" => "Y");
    // [ex2-49]Добавить дополнительную фильтрациюэлементов в созданный простой компонент«Каталог товаров».
    if ($filterSort) {
        $filterLogicOr = array(
                "LOGIC" => "OR",
                array("<=PROPERTY_PRICE" => 1700, "PROPERTY_MATERIAL" => "Дерево, ткань"),
                array("<PROPERTY_PRICE" => 1500, "PROPERTY_MATERIAL" => "Металл, пластик"),
        );
        $elementFilter[] = $filterLogicOr;
        $this->AbortResultCache();
    }
    // [ex2-49]Добавить дополнительную фильтрациюэлементов в созданный простой компонент«Каталог товаров».

    $elementSelect = array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE", "PROPERTY_".$arParams["CATALOG_PROPERTY_CODE"], "PROPERTY_PRICE", "PROPERTY_MATERIAL"); // добавить символьный код

    $catalogsList = CIBlockElement::GetList($elementSort, $elementFilter, false, false, $elementSelect);
    dump($arParams["TEMPLATE_DETAIL_LINK"]);
    if(!empty($arParams["TEMPLATE_DETAIL_LINK"])) {
        $catalogsList->SetUrlTemplates($arParams["TEMPLATE_DETAIL_LINK"]);
    }

    while($element = $catalogsList->GetNext()) {
        $arResult["FIRM"][$element["PROPERTY_FIRM_LINK_VALUE"]]["ELEMENTS"][$element["ID"]] = $element;
    }
    
    $this->SetResultCacheKeys(array("COUNT"));
    $this->IncludeComponentTemplate();
}
$APPLICATION->SetTitle("Разделов: ".$arResult["COUNT"]);

?>