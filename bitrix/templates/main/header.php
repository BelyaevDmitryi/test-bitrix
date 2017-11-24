<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE HTML>
<html>
<head>
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>
<script src="/bitrix/templates/main/js/jquery-3.2.1.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>
<?$APPLICATION->ShowPanel();?>
<div class="container">


<header>
     <a class="logotype" href="/">
		 <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" width="222" height="33" alt="описание" />
      </a>
     
     <nav>
          <?include('top_menu.php');?>
     </nav>
     
     <div class="contacts">
          г. Липецк, ул. Отличная<br/>
         дом 123, корпус 4, оф. 123456<br/>
        <span>+7 (474) <b>212-34-56</b></span>
     </div>
</header>

<div class="it_clear"></div>

<table height="235" width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr><td width="77%">
    Здесь может быть размещен элемент
    </td><td width="23%">
    Здесь может быть элемент яндекс || google карт
    </td></tr>
</table>

<div class="it_clear"></div>

<section>
     <aside class="left">
     Рыбные тексты также применяются для демонстрации различных видов
шрифта и в разработке макетов. Как правило их содержание бессмыслен
но. По причине своей функции текста-заполнителя для макетов нечитабе
льность рыбных текстов имеет особое значение, так как человеческое 
восприятие имеет особенность, распознавать определенные образцы и 
повторения. 
     </aside>
     
     <article>
     	