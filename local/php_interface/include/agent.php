<?
function CheckUserCount ()
{
    $dateNow = ConvertTimeStamp(time(), "FULL");

    $dateLast = COption::GetOptionString("main", "date_last_check_user_count");

    if(!empty($dateLast)) {
        $arFilter = array("DATE_REGISTER_1" => $dateLast);
    } else {
        $arFilter = array();
    }

    $rsUsers = CUser::GetList($by = "DATE_REGISTER", $order = "ASC", $arFilter);
    $arUsers = [];
    while ($arUser = $rsUsers->Fetch()) {
        $arUsers[] = $arUser;
    }

    // Количество зарегистрированных пользователей за период времени
    $iCountUsers = count($arUsers);

    // Если подсчет производился впервые, получаем самую раннюю дату регистрации
    if (empty($dateLast)) {
        $dateLast = $arUsers[0]["DATE_REGISTER"];
    }

    // За какое количество дней произведен подсчет
    $iDifference = intval(strtotime($dateNow) - strtotime($dateLast));
    $iDays = round($iDifference / (3600 * 24));

    // Отправляем письмо всем пользователям из группы "Администраторы"
    $rsAdmins = CUser::GetList($by = "ID", $order = "ASC", ADMIN_GROUP);
    while ($admin = $rsAdmins->Fetch()) {
        CEvent::Send(
            "CHECK_COUNT_USER",
            SITE_ID,
            [
                "EMAIL_TO" => $admin["EMAIL"],
                // Количество зарегистрированных пользователей за период времени
                "COUNT_USERS" => $iCountUsers,
                // За какое количество дней произведен подсчет
                "COUNT_DAYS" => $iDays,
            ],
            "N",
            "31"
        );
    }

    // Дату подсчета сохранять и получать с помощью параметров модулей
    COption::SetOptionString("main", "last_date_agent_checkUserCount", $dateNow);

    return "CheckUserCount();";
}