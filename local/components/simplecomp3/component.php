<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

global $USER;
if($USER->IsAuthorized()) {
	$currentUserID = $USER->GetID();

	$userType = CUser::GetList(($by="id"),
	($order="asc"),
	array("ID" => $currentUserID),
	array("SELECT" => array($arParams["USER_UF_CODE"])));
	
	$curUserType = "";
	
	while($type = $userType->GetNext()) {
        $curUserType = $type["UF_AUTHOR_TYPE"];
	}

	if($this->StartResultCache(false, $currentUserID)) {
		$users = CUser::GetList(($by="id"),
		($order="asc"),
		array($arParams["USER_UF_CODE"] => $curUserType, ),
		array("FIELDS" => array("ID", "LOGIN")));
        $listUsers = array();
		$listUsersID = array();
		
		while($user = $users->GetNext()) {
			$listUsers[$user["ID"]] = $user;
			$listUsersID[] = $user["ID"];
		}
		
		if(!empty($listUsersID)) {
			$listNews = array();
			$countNews = array();

            $newsFilter = array("IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"], "PROPERTY_".$arParams["NEWS_PROPERTY_AUTHOR"] => $listUsersID);

            $newsSelect = array("ID", "IBLOCK_ID", "NAME", "ACTIVE_FROM", "PROPERTY_".$arParams["NEWS_PROPERTY_AUTHOR"]);


            $newsList = CIBlockElement::GetList(array(), $newsFilter, false, false, $newsSelect);

            $newsElem = array();
            while($elem = $newsList->Fetch()) {
                $iAuthorId = $elem["PROPERTY_AUTHOR_VALUE"];
                if($elem["PROPERTY_AUTHOR_VALUE"] == $currentUserID) {
                    $newsElem[$elem["ID"]] = $elem;
               }
                $listUsers[$iAuthorId]["NEWS"][$elem["ID"]] = $elem;
            }

            foreach ($listUsers as $key_id=>$val_id) {
                foreach ($val_id["NEWS"] as $key=>$value) {
                    foreach($newsElem as $news) {
                        if($value["ID"] == $news["ID"]) {
                            unset($listUsers[$key_id]["NEWS"][$key]);
                        }
                    }
                }
                if($val_id["ID"] == $currentUserID) {
                    unset($listUsers[$key_id]);
                }
            }

            foreach ($listUsers as $key_id=>$val_id) {
                foreach ($val_id["NEWS"] as $key=>$value) {
                    if(empty($countNews[$key])) {
                        $countNews[$key] = $value;
                    }
                }
            }


            $arResult["COUNT"] = count($countNews);
            $arResult["AUTHORS"] = $listUsers;

		}
		$this->SetResultCacheKeys(array("COUNT"));
		$this->includeComponentTemplate();
	}
	$APPLICATION->SetTitle("Новостей ".$arResult["COUNT"]);
}
?>