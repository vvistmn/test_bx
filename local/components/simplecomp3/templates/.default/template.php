<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>

<?global $USER;
if($USER->IsAuthorized()):?>
    <ul>
        <?foreach($arResult["AUTHORS"] as $author):?>
            <li><?=$author["ID"]?> - <?=$author["LOGIN"]?></li>
            <ul>
                <?foreach($author["NEWS"] as $news):?>
                <li> - <?=$news["NAME"]?></li>
                <?endforeach;?>
            </ul>
        <?endforeach;?>
    </ul>
<?endif;?>