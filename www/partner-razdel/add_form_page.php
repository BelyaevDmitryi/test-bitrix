<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
include('/home/bitrix/www/bitrix/templates/main/myIblocks/functions/index.php');

//Подключаем модуль инфоблоков
CModule::IncludeModule('iblock');
$IBLOCK_ID = getIdInfoBlocks($iblocktype, $SITE_ID, 'partners'); //ИД инфоблока с которым работаем
?>

<form name="add_my_ankete" action="add_form_result.php" method="POST" enctype="multipart/form-data">

    Название
    <input type="text" name="name" maxlength="255" value="" required>
    <br/>                                           
    Описание (ИБ Партнеры)
    <input type="text" name="description" maxlength="255" value="" required>
    <br/>     
    Условия доставки
    <select name='delivery' required>
        <option value="Самовывоз">Самовывоз</option>
        <option value="Компания">Компанией</option>
    </select>
    <br/>
    Оператор
    <?
    $login = getLoginAllUsers();
    $id = getIdAllUsers();
    ?>
    <select name='operator'>
        <?
        echo "<option value=''>Выберите из списка</option>";
        for($i = 0; $i < count($id); $i++)
            echo "<option value=".$id[$i].">".$login[$i]."</option>";
        ?>
    </select>
    <br/>                            
    Текст анонса
    <textarea name="anons" placeholder="Анонсированное описание" required></textarea>
    <br/>
    Текст детельного описания
    <textarea name="detail" placeholder="Детальное описание" required></textarea>
    <br/>          
    <input type="submit" value="Отправить">

</form>

                 
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>