<?
if (CModule::IncludeModule("iblock")) {

    $res = CIBlock::GetList(
        Array(),
        Array(
            'TYPE' => iblocktype,
            'SITE_ID' => SITE_ID,
            'ACTIVE' => 'Y',
            'CODE' => ibloсk_code_tovars,
        ), true
    );

    if ($res->Fetch() == 0) {
        //Настройка доступа
        $arAccess = array(
            "2" => "R", //все пользователи
        );

        $obIblock = new CIBlock;
        $arFields = Array(
            "NAME" => ibloсk_name_tovars,
            "ACTIVE" => "Y",
            "IBLOCK_TYPE_ID" => iblocktype,
            "SITE_ID" => SITE_ID,
            "CODE" => ibloсk_code_tovars,
            "SORT" => "500",
            "GROUP_ID" => $arAccess,
            "FIELDS" => array(
                //Символьный код разделов
                "SECTION_CODE" => array(
                    "IS_REQUIRED" => "Y",
                    "DEFAULT_VALUE" => array(
                        "UNIQUE" => "Y",
                        "TRANSLITERATION" => "Y",
                        "TRANS_LEN" => "30",
                        "TRANS_CASE" => "L",
                        "TRANS_SPACE" => "-",
                        "TRANS_OTHER" => "-",
                        "TRANS_EAT" => "Y",
                        "USE_GOOGLE" => "N",
                    ),
                ),
                "DETAIL_TEXT_TYPE" => array( //тип детального описания
                    "DEFAULT_VALUE" => "text",
                ),
                "SECTION_DESCRIPTION_TYPE" => array(
                    "DEFAULT_VALUE" => "text",
                ),
                "IBLOCK_SECTION" => array( //привязка к разделам
                    "IS_REQUIRED" => "N",
                ),
                //Журналирование
                "LOG_SECTION_ADD" => array("IS_REQUIRED" => "Y"),
                "LOG_SECTION_EDIT" => array("IS_REQUIRED" => "Y"),
                "LOG_SECTION_DELETE" => array("IS_REQUIRED" => "Y"),
                "LOG_ELEMENT_ADD" => array("IS_REQUIRED" => "Y"),
                "LOG_ELEMENT_EDIT" => array("IS_REQUIRED" => "Y"),
                "LOG_ELEMENT_DELETE" => array("IS_REQUIRED" => "Y"),
            ),
            //Шаблонизация страниц
            "LIST_PAGE_URL" => "#SITE_DIR#/tovary/",
            "SECTION_PAGE_URL" => "#SITE_DIR#/tovary/#SECTION_CODE#/",
            "DETAIL_PAGE_URL" => "#SITE_DIR#/tovary/#ELEMENT_CODE#/",

            "INDEX_SECTION" => "Y", //Индексация разделов для модуля поиска
            "INDEX_ELEMENT" => "Y", //Индексация элементов для модуля поиска

            "VERSION" => 1, //Хранние элементов. 1- в общей таблице, 2- в отдельной

            "SECTION_PROPERTY" => "Y", //РАзделы каталога имеют свои свойства
        );
        $newIblockID = $obIblock->Add($arFields);
        if ($newIblockID > 0) {
            echo "инфоблок успешно создан";
        } else {
            echo "<pre>";
            print_r($obIblock);
            echo "</pre>";
            echo "ошибка создания инфоблока <br />";
            return false;
        }

        $res = CIBlock::GetList(
            Array(),
            Array(
                'TYPE' => iblocktype,
                'SITE_ID' => SITE_ID,
                'ACTIVE' => 'Y',
                'CODE' => ibloсk_code_partners,
            ), true
        );
        $arr = $res->Fetch();
        $PartnersID = $arr['ID'];

        //Определяем, есть ли у инфоблока свойства
        $dbProperties = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $newIblockID));
        if ($dbProperties->SelectedRowsCount() <= 0) {
            $ibp = new CIBlockProperty;
            $arFields = Array(
                "NAME" => partnersName,
                "ACTIVE" => "Y",
                "SORT" => 500,
                "CODE" => partnersCode,
                "PROPERTY_TYPE" => "E",
                "IBLOCK_ID" => $newIblockID,
                "LINK_IBLOCK_ID" => $PartnersID,
            );
            $propertyId = $ibp->Add($arFields);
            if ($propertyId > 0) {
                $arFields["ID"] = $propertyId;
                $arCommonProps[$arFields["CODE"]] = $arFields;
                echo "&mdash; Добавлено свойство " . $arFields["NAME"] . "<br />";
            } else {
                echo "&mdash; Ошибка добавления свойства " . $arFields["NAME"] . "<br />";
            }
        }
    }
}
?>