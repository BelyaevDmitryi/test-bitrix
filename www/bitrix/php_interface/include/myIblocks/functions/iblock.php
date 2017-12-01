<?
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
?>