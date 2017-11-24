<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары"); ?><? if ($USER->IsAuthorized()) {
    include('/home/bitrix/www/bitrix/templates/main/myIblocks/partners/create.php');
    include('/home/bitrix/www/bitrix/templates/main/myIblocks/tovars/create.php');
    include('/home/bitrix/www/bitrix/templates/main/myIblocks/functions/index.php');

//ID ИБ Партнеры
    $partnersID = getIdInfoBlocks($iblocktype, $SITE_ID, 'partners');

//ID ИБ Товары
    $tovarsID = getIdInfoBlocks($iblocktype, $SITE_ID, 'tovars');

    //$arNavElements = getNavListElements($partnersID,Array());

//список всех элементов
    $elemPartnersList = getListElement($partnersID, Array());

    $elemTovarsList = getListElement($tovarsID, array());

    $elemValueTovarsList = array();

    for ($i = 0; $i < count($elemTovarsList); $i++) {
        $db_props = CIBlockElement::GetProperty($elemTovarsList[$i]["IBLOCK_ID"], $elemTovarsList[$i]["ID"], "sort", "asc", Array());
        while ($ar_props = $db_props->Fetch()) {
            $elemValueTovarsList[] = $ar_props["VALUE"];
        }
    }

    $elemValueOperatorsList = array();

    for ($i = 0; $i < count($elemPartnersList); $i++) {
        $db_props = CIBlockElement::GetProperty($elemPartnersList[$i]["IBLOCK_ID"], $elemPartnersList[$i]["ID"], "sort", "asc", Array());
        while ($ar_props = $db_props->Fetch()) {
            if ($ar_props["CODE"] == "Operator")
                $elemValueOperatorsList[] = $ar_props["VALUE"];
        }
    }
    $count = 2;//Кол-во на странице

    //Доступ запрещаем всем пользователям кроме администратора ($USER->GetID() == 1)
    $in_Club = 0;//доступ запрещен
    if ($USER->GetID() == 1)
    	$in_Club = 1;
    for ($i = 0; $i < count($elemValueOperatorsList); $i++) {
        if ($USER->GetID() == $elemValueOperatorsList[$i]) {
        	$in_Club = 1;
        }
    }
    if ($in_Club == 0) {
        echo "<script>alert(\"Доступ запрещен\");</script>";
    } else {
    	//для пагинации        
        $p = isset($_GET["p"]) ? (int) $_GET["p"] : 0;
        //число страниц
        $len = floor( count($elemPartnersList) / $count);        
        ?>
        <h1>Список товаров</h1>
        <b>Наименование</b>
        <?if (count($elemPartnersList) == 0){ ?>
        <small>Список пуст!</small>
        <? } else {

        	for($i = $p*$count; $i < ($p+1)*$count; $i++){
        		echo "<p>".$elemPartnersList[$i]["NAME"];
        		if ($elemPartnersList[$i]["ACTIVE"] == "Y") {
        			$value = "Деактивировать";
        		} else {
        			$value = "Активировать";
        		}
        		if (!empty($elemValueTovarsList[$i])):?>
        			<a href="detail.php?ID=<?=$elemPartnersList[$i]["ID"]?>"> Подробно</a>
        		<? endif ?>
        		<?if($i < count($elemPartnersList)):?>
        		<input type="button" name="<?=$i?>" onclick="load(this)" id="<?=$elemPartnersList[$i]["ID"]?>" value="<?=$value?>"/>
        		<?endif?>
        		<?}?>

        <script type="text/javascript" src="/partner-razdel/js/script.js"></script>
        
        <nav>
    	<ul class="pagination">
    		<? for($i = 0; $i <= $len; $i++){ ?>
    		<li><a href="?p=<?= $i ?>"><?= $i + 1 ?></a></li>
    		<? } ?>
    	</ul>
    	</nav>    	
        <?}?>
        <a href="add_form_page.php">Добавить</a>
        <?
    }
} else {
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        ".default",
        array(
            "PROFILE_URL" => "/profile/",
            "REGISTER_URL" => "/register/",
            "SHOW_ERRORS" => "N",
            "COMPONENT_TEMPLATE" => ".default"
        ),
        false
    );
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>