<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->addExternalJS("/partner-razdel/js/script.js");
if (strlen($arResult["MESSAGE"]) > 0):?>
    <? ShowNote($arResult["MESSAGE"]) ?>
<? endif ?>

<? if ($arResult["NO_USER"] == "N"): ?>
    <h1><?= "Список товаров"; ?></h1>
    <? if (count($arResult["ELEMENTS"]) > 0): ?>
        <b>Наименование</b> <br />
        <? foreach ($arResult["ELEMENTS"] as $arElement): ?>
            <div>
                <a href="detail.php?ID=<?= $arElement["ID"] ?>"><?= $arElement["NAME"] ?></a>
                <small><?= is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]] ?></small>
                <input type="button" name="<?= $arElement["ACTIVE_VALUE"] ?>" onclick="load(this)" id="<?= $arElement["ID"] ?>" value="<?= $arElement["ACTIVE_VALUE"] ?>"/>
            </div>
        <? endforeach ?>
    <? else: ?>
        <?= "Списк пуст"; ?>
    <? endif ?>
    <br />
    <a href="add_form_page.php">Добавить</a>
<? endif ?>
<? if (strlen($arResult["NAV_STRING"]) > 0): ?><?= $arResult["NAV_STRING"] ?><? endif ?>
