<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?
global $USER;
if ($USER->IsAuthorized()) {
    if (!empty($_REQUEST['name']) and !empty($_REQUEST['description']) and !empty($_REQUEST['delivery']) and !empty($_REQUEST['anons']) and !empty($_REQUEST['detail'])) {

        CModule::IncludeModule('iblock');

        $error = array();

        //echo '<pre>';
        //print_r($_POST);
        //echo '<pre>';

        //создаем элемент для ИБ Партнеры и получаем ID ИБ
        $elP = new CIBlockElement;
        $iblock_id_partners = getIdInfoBlocks(iblocktype, SITE_ID, ibloсk_code_partners);

        //Свойства
        $PROP_IB_Partners = array();

        $PROP_IB_Partners[descriptionCode] = $_POST['description']; //Свойство описание
        $PROP_IB_Partners[deliveryCode] = $_POST['delivery']; //Свойство условие доставки
        $PROP_IB_Partners[operatorCode] = $_POST['operator']; //Свойство оператор

        global $USER;
        //Основные поля элемента
        $fields = array(
            "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
            "CREATED_BY" => $USER->GetID(),//Передаем ID пользователя кто добавляет
            "IBLOCK_ID" => $iblock_id_partners, //ID информационного блока
            "PROPERTY_VALUES" => $PROP_IB_Partners, // Передаем массив значении для свойств
            "NAME" => strip_tags($_REQUEST['name']),
            "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
            "PREVIEW_TEXT" => strip_tags($_REQUEST['anons']), //Анонс
            "DETAIL_TEXT" => strip_tags($_REQUEST['detail']),
            "CODE" => "ELEMPART"
        );

        //Результат в конце отработки
        if ($ID = $elP->Add($fields)) {
            echo "Элемент ИБ Партнеры сохранен с ID: " . $ID . "<br />";
        } else {
            $error[] = 'Не удалось добавить элемент для инфоблока Партнеры';
        }

        //Товары
        $elT = new CIBlockElement;
        $iblock_id_tovars = getIdInfoBlocks(iblocktype, SITE_ID, ibloсk_code_tovars);

        //Свойства
        $PROP_IB_Tovars = array();
        if (count($error) > 0)
            print_r($error);
        else {
            if (!empty($PROP_IB_Partners['Operator']))
                $PROP_IB_Tovars[partnersCode] = $ID;
            else
                $PROP_IB_Tovars[partnersCode] = '';

            //Основные поля элемента
            $fields = array(
                "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
                "CREATED_BY" => $USER->GetID(),//Передаем ID пользователя кто добавляет
                "IBLOCK_ID" => $iblock_id_tovars, //ID информационного блока
                "PROPERTY_VALUES" => $PROP_IB_Tovars, // Передаем массив значении для свойств
                "NAME" => strip_tags($_REQUEST['name']),
                "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
                "CODE" => "ELEMTOV"
            );

            //Результат в конце отработки
            if ($ID = $elT->Add($fields)) {
                echo "Элемент ИБ Товары сохранен с ID: " . $ID . "<br />";
            } else {
                $error[] = 'Не удалось добавить элемент для инфоблока Товары';
            }
            if (count($error) > 0)
                print_r($error);
            else
                LocalRedirect('');
        }
    }
} else {
    echo "<script>alert(\"Доступ запрещен\");</script>";
}
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>