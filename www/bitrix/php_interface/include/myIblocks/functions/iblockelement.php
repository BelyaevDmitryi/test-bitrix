<?
//выборка всех элементов из инфоблока $chooseIBlocks. $selFields - поля в выборке
function getListElement($chooseIBlockID, $selFields = null)
{
    if (is_array($selFields))
        $res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID' => $chooseIBlockID,), false, false, $selFields);
    else
        $res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID' => $chooseIBlockID,), false, false, Array("ID", "NAME"));
    while ($ob = $res->GetNextElement()) {
        $arFields[] = $ob->GetFields();
    }
    return $arFields;
}

//получить из инфоблока Партнеры свойства условие доставки, описание
function getFieldsProperty($BlockPartID, $BlocktovarID, $IDElement)
{
    //получаем свойства $IDElement. Нужно получить ID привязынный к иб Партнеры (свойство Partner иб Товары)
    //Записать в массив свойства: название, условие доставки, описание
    $out = [];

    $rsTovarElem = CIBlockElement::GetProperty($BlocktovarID, $IDElement, array("sort" => "asc"), Array("CODE" => "Partner"));
    while ($arElemTov = $rsTovarElem->NavNext(false)) {
        $temp = $arElemTov;
    }
    //$temp["VALUE"] - ID элемента из ИБ Партнеры
    $arFilterPart = array("IBLOCK_TYPE" => iblocktype, "IBLOCK_ID" => $BlockPartID, "ID" => $temp["VALUE"]);
    $arSelect = array("NAME", "PROPERTY_DELIVERY", "PROPERTY_DESCRIPTION");
    $rsIBlockElement = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilterPart, false, false, $arSelect);
    while ($arElemPart = $rsIBlockElement->NavNext(false)) {
        $out = $arElemPart;
    }
    //echo "<pre>";
    //print_r($out);
    //echo "</pre>";
    return $out;
}

function getValueProperty($IBLOCK_ID, $fields)
{
    $VALUE = array();
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $IBLOCK_ID,), false, false, array());
    if ($ob = $res->GetNext()) {
        $VALUE = $ob;
    }
    return $VALUE;
}

//последний добавленный ID
function getProp($typeIBlock, $siteId, $symCode)
{
    $res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID' => getIdInfoBlocks($typeIBlock, $siteId, $symCode),), false, false, Array("ID"));
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
    }
    return $arFields;
}

function getCurrCount()
{
    return count(getListElement());
}

?>