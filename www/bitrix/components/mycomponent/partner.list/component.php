<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (CModule::IncludeModule("iblock"))
{
	if($arParams["IBLOCK_ID"] > 0)
		$bWorkflowIncluded = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "WORKFLOW") == "Y" && CModule::IncludeModule("workflow");
	else
		$bWorkflowIncluded = CModule::IncludeModule("workflow");

	if (!$bWorkflowIncluded)
	{
		if ($arParams["STATUS_NEW"] != "N" && $arParams["STATUS_NEW"] != "NEW") $arParams["STATUS_NEW"] = "ANY";
	}

	if(!is_array($arParams["STATUS"]))
	{
		if($arParams["STATUS"] === "INACTIVE")
			$arParams["STATUS"] = array("INACTIVE");
		else
			$arParams["STATUS"] = array("ANY");
	}
	//ID ИБ Партнеры
    $partnersID = getIdInfoBlocks(iblocktype, SITE_ID, ibloсk_code_partners);

    //ID ИБ Товары
    $tovarsID = getIdInfoBlocks(iblocktype, SITE_ID, ibloсk_code_tovars);

    $elemValueOperatorsList = array();
    $arFilterPart = array("IBLOCK_TYPE" => iblocktype, "IBLOCK_ID" => $partnersID);
    $arSelect = array("PROPERTY_OPERATOR");
    $rsIBlockElement = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilterPart, false, false, $arSelect);
    while ($arElemPart = $rsIBlockElement->NavNext(false)) {
        $elemValueOperatorsList[] = $arElemPart["PROPERTY_OPERATOR_VALUE"];
    }

	global $USER;
	if($USER->IsAdmin())
		$in_club = 1;
	elseif(in_array($USER->GetID(), $elemValueOperatorsList))
		$in_club = $USER->GetID();
	else
    {
		$in_club = 0;
        echo "<script>alert(\"Доступ запрещен\");</script>";
	}
	if($in_club != 0)
	{
        $arResult["NO_USER"] = "N";

        // get list of iblock properties and list of iblock property ids
        $rsIBLockPropertyList = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
        $arIBlockPropertyList = array();
        $arPropertyIDs = array();
        $i = 0;
        while ($arProperty = $rsIBLockPropertyList->GetNext())
        {
            $arIBlockPropertyList[] = $arProperty;
            $arPropertyIDs[] = $arProperty["ID"];
        }

        if($USER->IsAdmin()) {
            // set starting filter value
            $arFilter = array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $tovarsID, "SHOW_NEW" => "Y");
            // get elements list using generated filter
            $rsIBlockElements = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter);
        }
        else {
            // set starting filter value
            $arFilterPart = array("IBLOCK_TYPE" => iblocktype, "IBLOCK_ID" => $partnersID, "SHOW_NEW" => "Y", array("PROPERTY_OPERATOR" => $USER->GetID()));
            $rsIBlockPartElements = CIBlockElement::GetList(array("ID" => "ASC"), $arFilterPart);
            $partElements = array();
            while ($arElemPart = $rsIBlockPartElements->NavNext(false))
                $partElements[] = $arElemPart["ID"];
            // get elements list using generated filter
            $arFilterTov = array("IBLOCK_TYPE" => iblocktype, "IBLOCK_ID" => $tovarsID, "SHOW_NEW" => "Y", array("PROPERTY_PARTNER" => $partElements));
            $rsIBlockElements = CIBlockElement::GetList(array("ID" => "ASC"),$arFilterTov);
        }

		$arResult["ELEMENTS_COUNT"] = $rsIBlockElements->SelectedRowsCount();
		//$page_split = intval(COption::GetOptionString("iblock", "RESULTS_PAGEN"));
		$arParams["NAV_ON_PAGE"] = intval($arParams["NAV_ON_PAGE"]);
		$arParams["NAV_ON_PAGE"] = $arParams["NAV_ON_PAGE"] > 0 ? $arParams["NAV_ON_PAGE"] : 3;

		$rsIBlockElements->NavStart($arParams["NAV_ON_PAGE"]);

		// get paging to component result
		if ($arParams["NAV_ON_PAGE"] < $arResult["ELEMENTS_COUNT"])
		{
			$arResult["NAV_STRING"] = $rsIBlockElements->GetPageNavString(5, "", true);
		}

		// get current page elements to component result
		$arResult["ELEMENTS"] = array();
		while ($arElement = $rsIBlockElements->NavNext(false))
		{
			$arElement = htmlspecialcharsex($arElement);
			if ($bWorkflowIncluded)
			{
				$PREVIOUS_ID = $arElement['ID'];
				$LAST_ID = CIBlockElement::WF_GetLast($arElement['ID']);
				if ($LAST_ID != $arElement["ID"])
				{
					$rsElement = CIBlockElement::GetByID($LAST_ID);
					$arElement = $rsElement->GetNext();
				}
				$arElement["ID"] = $PREVIOUS_ID;
			}
			if ($arElement["ACTIVE"] == "Y") {
				$value = "Деактивировать";
			} else {
				$value = "Активировать";
			}
            $arElement["ACTIVE_VALUE"] = $value;
			$arResult["ELEMENTS"][] = $arElement;
//            echo "<pre>";
//            print_r($arElement);
//            echo "</pre>";
		}
//        echo "<pre>";
//        print_r($arResult);
//        echo "</pre>";
	}
	else
	{
		$arResult["NO_USER"] = "Y";
	}

	$arResult["MESSAGE"] = htmlspecialcharsex($_REQUEST["strIMessage"]);

	$this->IncludeComponentTemplate();
}
?>