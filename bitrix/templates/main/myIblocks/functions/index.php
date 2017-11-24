<?
//выборка всех элементов из инфоблока $chooseIBlocks. $selFields - поля в выборке
function getListElement($chooseIBlockID,$selFields = null)
{
    if(is_array($selFields))
        $res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID' => $chooseIBlockID,), false, false, $selFields);
    else
        $res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID' => $chooseIBlockID,), false, false, Array("ID","NAME"));
    while ($ob = $res->GetNextElement()) {
        $arFields[] = $ob->GetFields();
    }
    return $arFields;
}

//получить из инфоблока типа type_partners свойство $symCode
function getFieldsProperty($IDBlocks,$Prop)
{
    $out = [];
    $arSort= Array("NAME"=>"ASC");
    $arSelect = Array("ID","NAME", "PROPERTY_".$Prop);
    $arFilter = Array("IBLOCK_ID" => $IDBlocks);
 
    $res =  CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
 
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $out["PROPERTY_".$Prop."_VALUE"] = ($arFields['PROPERTY_'.$Prop.'_VALUE']);
    }
    $out["NAME"] = $arFields["NAME"];
    return $out;
}

//получить ID инфоблока типа $typeIBlock с ID сайта $siteId и символьным кодом $symCode
function getIdInfoBlocks($typeIBlock,$siteId,$symCode)
{
    $res = CIBlock::GetList(
        Array(),
        Array(
            'TYPE' => $typeIBlock,
            'SITE_ID' => $siteId,
            'CODE' => $symCode,
        ), true
    );
    $arr = $res->Fetch();
    $IDBlocks = $arr['ID'];
    return $IDBlocks;
}

//получить из инфоблока типа type_partners свойство $symCode
function getIdProperty($typeIBlock,$siteId,$symCode)
{
    $res = CIBlockProperty::GetList(
        Array(),
        Array(
            'TYPE' => $typeIBlock,
            'SITE_ID' => $siteId,
            'CODE' => $symCode,
        ), true
    );
    $arr = $res->Fetch();
    $idIbPropertyBlocks = $arr['ID'];
    return $idIbPropertyBlocks;
}

function getValueProperty($IBLOCK_ID,$fields)
{
    $VALUE = array();
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $IBLOCK_ID,), false, false, array());
    if ($ob = $res->GetNext())
    {
        $VALUE = $ob;
    }
    return $VALUE;
}

//получить из инфоблока типа type_partners свойство $symCode
function getPropertyElement($IDBlocks,$symCode)
{
    $out = array();

    $arFilter = Array($IDBlocks, "ACTIVE"=> array("Y", "N"), "CODE" => $symCode, "CHECK_PERMISSIONS" => "N");
    $db_props = CIBlock::GetProperties($IDBlocks,Array(), $arFilter);
    while($ar_props = $db_props->Fetch()){
        array_push($out, $ar_props);
    }
    return $out;
}

//последний добавленный ID
function getProp($typeIBlock,$siteId,$symCode)
{
    $res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID' => getIdInfoBlocks($typeIBlock,$siteId,$symCode),), false, false, Array("ID"));
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
    }
    return $arFields;
}

function getCurrCount()
{
    return count(getListElement());
}

//получить ID всех пользователей
function getIdAllUsers()
{
    $idUser = array();
    $rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter);
    while ($arItem = $rsUsers->GetNext()) {
        $idUser[] = $arItem["ID"];
    }
    return $idUser;
}

//получить LOGIN всех пользователей
function getLoginAllUsers()
{
    $loginUser = array();
    $rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter);
    while ($arItem = $rsUsers->GetNext()) {
        $loginUser[] = $arItem["LOGIN"];
    }
    return $loginUser;
}
?>