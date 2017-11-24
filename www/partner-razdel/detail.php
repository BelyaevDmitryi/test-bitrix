<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары"); ?>
<?
include('/home/bitrix/www/bitrix/templates/main/myIblocks/partners/create.php');
include('/home/bitrix/www/bitrix/templates/main/myIblocks/tovars/create.php');
include('/home/bitrix/www/bitrix/templates/main/myIblocks/functions/index.php');

//ID ИБ Партнеры
    $partnersID = getIdInfoBlocks($iblocktype, $SITE_ID, 'partners');

//ID ИБ Товары
    $tovarsID = getIdInfoBlocks($iblocktype, $SITE_ID, 'tovars');

    $deli = getFieldsProperty($partnersID,"DELIVERY");
    $desc = getFieldsProperty($partnersID,"DESCRIPTION");
    ?>

    <table>
        <thead>
        <tr>
            <td><h1>Подробный вывод товара № <?=$_GET["ID"]?></h1></td>
        </tr>
        </thead>
        <tbody>
        	<tr>
        		<td>Название: <?=$deli["NAME"]?></td>
        	</tr>
        	<tr>
        		<td>Описание: <?=$desc["PROPERTY_DESCRIPTION_VALUE"]?></td>
        	</tr>
        	<tr>
        		<td>Условие доставки: <?=$deli["PROPERTY_DELIVERY_VALUE"]?></td>
        	</tr>     
            <tr>
                <td><a href="/partner-razdel/">Назад к списку</a></td>
            </tr>
        </tbody>
    </table>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>