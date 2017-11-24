<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары"); ?>
<?require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
include('/home/bitrix/www/bitrix/templates/main/myIblocks/partners/create.php');
include('/home/bitrix/www/bitrix/templates/main/myIblocks/tovars/create.php');
include('/home/bitrix/www/bitrix/templates/main/myIblocks/functions/index.php');
    $elemId=$_POST["id"];
    $action=$_POST["value"];
    if($action == "Активировать")
    	$action = "Y";
    else
    	$action = "N";

    $el = new CIBlockElement;
    $arLoadProductArray = Array("ACTIVE" => $action);
    $res = $el->Update($elemId, $arLoadProductArray);
    if($res == 1)
    	echo $res;
    else
    	echo "Не удалось обновить элемент";
    //LocalRedirect("");
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>