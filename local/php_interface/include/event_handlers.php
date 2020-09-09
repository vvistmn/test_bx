<?
#
# Проверка при деактивации товара
#
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("CatDeleteElem", "OnBeforeIBlockElementUpdateHandler"));

class CatDeleteElem
{
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        CModule::IncludeModule("iblock");

        if ($arFields["ACTIVE"] == "N") {
            $select = array("ID", "NAME", "SHOW_COUNTER", "ACTIVE");
            $filter = array(
                "ID" => $arFields["ID"],
            );
            $res = CIBlockElement::GetList(array(), $filter, false, false, $select);

            $ar_res = $res->GetNext();

            if(!$ar_res || $ar_res["ACTIVE"] === $arFields["ACTIVE"])
            {
                return true;
            }

            if ($ar_res["SHOW_COUNTER"] > 2) {
                global $APPLICATION;
                $APPLICATION->throwException("Товар невозможно деактивировать, у него {$ar_res["SHOW_COUNTER"]} просмотров");
                return false;
            }
            return true;
        }
    }
};

#
# Изменение данных в письме
#
AddEventHandler("main", "OnBeforeEventAdd", array("ChangeFeedBackForm", "OnBeforeEventAddHandler"));

class ChangeFeedBackForm
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;

            if ($USER->IsAuthorized()) {
                $mess = 'Пользователь авторизован: ' . $USER->GetID() . ' (' . $USER->GetLogin() . ') ' . $USER->GetFullName() . ', данные из формы: ' . $arFields["AUTHOR"];
            } else {
                $mess = 'Пользователь не авторизован, данные из формы: ' . $arFields["AUTHOR"];
            }

            $arFields["AUTHOR"] = $mess;

            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "MAIL_DATA_REPLACED",
                "MODULE_ID" => "main",
                "ITEM_ID" => $USER->GetID(),
                "DESCRIPTION" => "Замена данных в отсылаемом письме – {$arFields["AUTHOR"]}"
            ));
        }
    }
};

#
# Упростить меню в адмистративном разделе для контент-менеджера
#
AddEventHandler("main", "OnEpilog", array("ERROR_PAGE_404", "OnEpilogHandler"));
class ERROR_PAGE_404
{
    function OnEpilogHandler () {
        if (defined("ERROR_404") && ERROR_404 == "Y") {
            global $APPLICATION;
            $currentPage = $APPLICATION->GetCurUri();
            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "ERROR_404",
                "MODULE_ID" => "main",
                "DESCRIPTION" => $currentPage,
            ));
        }
    }
}


#
# Упростить меню в адмистративном разделе для контент-менеджера
#
addEventHandler("main", "OnBuildGlobalMenu", array("GlobalMenuBTRX", "OnBuildGlobalMenuHandler"));
class GlobalMenuBTRX
{
    function OnBuildGlobalMenuHandler (&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER;
        if ($USER->IsAdmin() || !in_array(CONTENT_MANAGER_GROUP_ID, $USER->GetUserGroupArray())) {
            return false;
        }
        foreach ($aGlobalMenu as $key => $v) {
            if ($v["items_id"] !== 'global_menu_content') {
                unset($aGlobalMenu[$key]);
            };
        }
        foreach ($aModuleMenu as $key => $v) {
            if ($v["items_id"] !== 'menu_iblock_/news') {
                unset($aModuleMenu[$key]);
            };
        }
    }
}
// поправить

#
# Супер инструмент SEO специалиста
#
addEventHandler("main", "OnPageStart", array("IBlockToolSEO", "OnPageStartHandler"));
class IBlockToolSEO
{
    function OnPageStartHandler ()
    {
        global $APPLICATION;

        $getCurPage = $APPLICATION->GetCurPage();


        if (!CModule::IncludeModule("iblock")) {
            return;
        }
        $filter = array(
            "IBLOCK_ID" => META_IBLOCK_ID,
            "NAME" => $getCurPage,
        );
        $select = array("ID", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION");
        $result = CIBlockElement::GetList(array(), $filter, false, false, $select);
        if ($match = $result->GetNext()) {
            $APPLICATION->SetPageProperty('title',$match['PROPERTY_TITLE_VALUE']);
            $APPLICATION->SetPageProperty('description',$match['PROPERTY_DESCRIPTION_VALUE']);
        }
    }
}

