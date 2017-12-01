<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары"); ?>
<?
global $USER;
if ($USER->IsAuthorized()) {
//ID ИБ Партнеры
    $partnersID = getIdInfoBlocks(iblocktype, SITE_ID, ibloсk_code_partners);

//ID ИБ Товары
    $tovarsID = getIdInfoBlocks(iblocktype, SITE_ID, ibloсk_code_tovars);

    $arRes = getFieldsProperty($partnersID, $tovarsID, $_GET["ID"]);
    ?>

    <table>
        <thead>
        <tr>
            <td><h1>Подробный вывод товара № <?= $_GET["ID"] ?></h1></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Название: <?= $arRes["NAME"] ?></td>
        </tr>
        <tr>
            <td>Описание: <?= $arRes["PROPERTY_DESCRIPTION_VALUE"] ?></td>
        </tr>
        <tr>
            <td>Условие доставки: <?= $arRes["PROPERTY_DELIVERY_VALUE"] ?></td>
        </tr>
        <tr>
            <td><a href="/partner-razdel/">Назад к списку</a></td>
        </tr>
        </tbody>
    </table>
    <?
}
else
{
    echo "<script>alert(\"Доступ запрещен\");</script>";
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>