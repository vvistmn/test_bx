<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<b>Каталог:</b>
<br>
<? $curPage = $APPLICATION->GetCurPage()."?F=Y"; ?>
<a href="<?=$curPage?>">[ex2-49]Добавить дополнительную фильтрацию элементов в созданный простой компонент «Каталог товаров».</a>
<br>
<?echo time();?>
<br>
<ul>
    <?foreach($arResult["FIRM"] as $firm):?>
    <li><b><?=$firm["NAME"]?></b></li>
    <ul>
        <?foreach($firm["ELEMENTS"] as $element):?>
            <li>
                <?=$element['NAME']?> - <?=$element['PROPERTY_PRICE_VALUE']?> - <?=$element['PROPERTY_MATERIAL_VALUE']?> - <?=$element['DETAIL_PAGE_URL']?>
            </li>
        <?endforeach;?>
    </ul>
    <?endforeach;?>
</ul>
<?=$arResult["NAV_STRING"]?>