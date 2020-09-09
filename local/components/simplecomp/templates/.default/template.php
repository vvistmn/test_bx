<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div>
    <h3>Элементов - <?=$arResult["COUNT"]?></h3>
    <b>Каталог:</b>
    <br>
    <ul>
        <?foreach($arResult["NEWS"] as $news):?>
                <? // [ex2-58]  Добавить управление элементами –«Эрмитаж»  в созданный простой компонент   «Каталог товаров»
                    $this->AddEditAction($news['ID'], $news['EDIT_LINK'],
                    CIBlock::GetArrayByID($news["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($news['ID'], $news['DELETE_LINK'],
                    CIBlock::GetArrayByID($news["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>

        <li id="<?=$this->GetEditAreaId($news['ID']);?>">
            <b><?=$news["NAME"]?></b> - <?=$news["ACTIVE_FROM"]?>
            <br>
            (<?=implode(", ", $news["SECTION_NAME"])?>)
        </li>
            <ul>
                <?foreach($news["ELEMENTS"] as $element):?>
                    <li><?=$element["NAME"]?> - <?=$element["PROPERTY_PRICE_VALUE"]?> - <?=$element["PROPERTY_MATERIAL_VALUE"]?> - <?=$element["PROPERTY_ARTNUMBER_VALUE"]?></li>
                <?endforeach;?>
            </ul>
        <?endforeach;?>
    </ul>
</div>
