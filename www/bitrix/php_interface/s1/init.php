<?
if (isset($_GET['noinit']) && !empty($_GET['noinit']))
{
    $strNoInit = strval($_GET['noinit']);
    if ($strNoInit == 'N')
    {
        if (isset($_SESSION['NO_INIT']))
            unset($_SESSION['NO_INIT']);
    }
    elseif ($strNoInit == 'Y')
    {
        $_SESSION['NO_INIT'] = 'Y';
    }
}
    if (file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/constants.php') && file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/myIblocks/partners/create.php') && file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/myIblocks/tovars/create.php') && file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/myIblocks/functions/iblock.php') && file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/myIblocks/functions/iblockelement.php') && file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/myIblocks/functions/users.php'))
    {
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/constants.php");
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/myIblocks/partners/create.php");
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/myIblocks/tovars/create.php");
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/myIblocks/functions/iblock.php");
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/myIblocks/functions/iblockelement.php");
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/myIblocks/functions/users.php");
    }
?>