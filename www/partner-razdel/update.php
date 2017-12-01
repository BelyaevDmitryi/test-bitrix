<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары"); ?>
<?
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
global $USER;
if ($USER->IsAuthorized()) {
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
}
else
{
	echo "<script>alert(\"Доступ запрещен\");</script>";
}
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>