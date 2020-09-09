<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<?
// [ex2-100] Добавить пункт «ИБ в админке» в выпадающем меню компонента. 
$arButtons = CIBlock::GetPanelButtons($arParams["NEWS_IBLOCK_ID"]);
$this->AddIncludeAreaIcon(
    [
        "TITLE" => "ИБ в админке",
        "URL"=> $arButtons['submenu']['element_list']['ACTION_URL'],
        "IN_PARAMS_MENU" => true,
    ]
);
// [ex2-100] Добавить пункт «ИБ в админке» в выпадающем меню компонента. 

if($this->StartResultCache($arParams["CACHE_TIME"])) {
    if(!CModule::IncludeModule("Iblock")) {
        ShowError("Ошибка в подключении инфоблока");
        return false;
    }


    $sectionFilter = array(
        "IBLOCK_ID" => $arParams["CAT_IBLOCK_ID"],
        "ACTIVE" => "Y",
        "!".$arParams["UF_CATALOG_CODE"] => false,
    );

    $sectionSelect = array(
        "ID", "NAME", $arParams["UF_CATALOG_CODE"]
    );

    $sectionsList = CIBlockSection::GetList(
            array(), $sectionFilter, false, $sectionSelect
    );

    $sectionsID = array();
    $news = array();
    $uf_code = array();
    while($section = $sectionsList->GetNext()) {
        $sectionsID[] = $section["ID"];
        foreach ($section[$arParams["UF_CATALOG_CODE"]] as $id ) {
            $news[$id]["SECTION_ID"][] = $section["ID"];
            $news[$id]["SECTION_NAME"][] = $section["NAME"];
        }
    }

    $elementFilter = array("IBLOCK_ID" => $arParams["CAT_IBLOCK_ID"], "IBLOCK_SECTION_ID" => $sectionsID, "ACTIVE" => "Y");

    $elementSelect  = array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER");

    $elementList = CIBlockElement::GetList(array(), $elementFilter, false, false, $elementSelect);

    $elements = array();
    $arResult["COUNT"] = 0;
    $price = array();

    while($elem = $elementList->GetNext()) {
        $arResult["COUNT"]++;
        $elements[$elem["IBLOCK_SECTION_ID"]][] = $elem;
        $price[] = $elem["PROPERTY_PRICE_VALUE"];
    }

    $newsFilter = array(
        "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
        "ACTIVE" => "Y",
        "ID" => array_keys($news),
    );

    $newsSelect = array("ID", "NAME", "ACTIVE_FROM");

    $newsList = CIBlockElement::GetList(array(), $newsFilter, false, false, $newsSelect);

    while($newsElem = $newsList->GetNext()) {
        // [ex2-58] Добавить управление элементами –«Эрмитаж» в созданный простой компонент «Каталог товаров»
        $arButtons = CIBlock::GetPanelButtons(
            $arParams["NEWS_IBLOCK_ID"],
            $newsElem["ID"],
            0,
            array("SECTION_BUTTONS"=>false, "SESSID"=>false)
        );
        // Добавить  создание
        $newsElem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $newsElem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
        // [ex2-58] Добавить управление элементами –«Эрмитаж» в созданный простой компонент «Каталог товаров»

        $newsElem = array_merge($newsElem, $news[$newsElem["ID"]]);
        $newsElem["ELEMENTS"] = array();
        foreach ($newsElem["SECTION_ID"] as $section) {
            $newsElem["ELEMENTS"] = array_merge($newsElem["ELEMENTS"], $elements[$section]);
        }
        $arResult["NEWS"][$newsElem["ID"]] = $newsElem;
    }

    $arResult["MIN"] = min($price);
    $arResult["MAX"] = max($price);

    $this->SetResultCacheKeys(array("COUNT", "MIN", "MAX"));
    $this->IncludeComponentTemplate();
}

$APPLICATION->SetTitle("В  каталоге  товаров  представлено товаров: ".$arResult["COUNT"]);

$APPLICATION->AddViewContent("max_price", "Максимальная цена ".$arResult["MAX"]);
$APPLICATION->AddViewContent("min_price", "Максимальная цена ".$arResult["MIN"]);
?>
