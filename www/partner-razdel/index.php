<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары"); ?><? if ($USER->IsAuthorized()) {
    $APPLICATION->IncludeComponent(
        "mycomponent:partner.list",
        ".default",
        Array(),
        false
    );
} else {
	$APPLICATION->IncludeComponent(
		"bitrix:system.auth.form",
		"",
		Array(
			"REGISTER_URL" => SITE_DIR . "register/",
			"PROFILE_URL" => SITE_DIR . "profile/",
			"SHOW_ERRORS" => "N"
		)
	);
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>