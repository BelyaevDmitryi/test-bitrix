<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Войти");
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"",
	Array(
		"REGISTER_URL" => SITE_DIR . "register/",
		"PROFILE_URL" => SITE_DIR . "profile/",
		"SHOW_ERRORS" => "Y"
	)
); ?>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>