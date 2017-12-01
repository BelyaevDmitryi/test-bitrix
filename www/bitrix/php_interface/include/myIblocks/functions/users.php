<?
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