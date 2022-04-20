<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\UserTable;
use Bitrix\Main\Loader;
use \Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Type\DateTime;

CModule::IncludeModule("crm");
Loader::IncludeModule('highloadblock');

$entity   = HighloadBlockTable::compileEntity( 'Workload' );
$entity_data_class = $entity->getDataClass();

$arDepartment =
    [
        122 => 'Отдел 1', // id отдела => название которое будет выводиться в представлении
        131 => 'Отдел 2',
        112 => 'Отдел 3',
        113 => 'Отдел 4'
    ];
$arManagers = [];
$date = (new DateTime())->getTimestamp();
//Собираем id менеджеров
foreach ($arDepartment as $key=>$department){

    $rsUsers = UserTable::GetList(array(
        'select' => array('ID', 'NAME', 'LAST_NAME'),
        'filter' => array('UF_DEPARTMENT' => $key,'ACTIVE' => 'Y')
    ))->fetchAll();
    $arResult['MANAGERS'][$department] = $rsUsers;
    //Собираем всех менеджеров в 1 массив
    $arManagers = array_merge($arManagers, $rsUsers);

}

// Проверяем не истек ли срок действия установленного времени
foreach ($arManagers as $idManagers){
    $resultItem = $entity_data_class::getList(array(
        "select" => array("UF_DATE_CLOSE","ID"),
        "order" => array("ID" => "DESC"),
        "filter" => array("UF_MANAGER_ID" => $idManagers)
    ))->fetch();

    if(empty($resultItem['ID'])){
        continue;
    }
    $dateClose = (new DateTime($resultItem['UF_DATE_CLOSE']))->getTimestamp();
    if($date >= $dateClose){
        $entity_data_class::Delete($resultItem['ID']);
    }
}
if(!empty($arResult['MANAGERS'])){
    $this->IncludeComponentTemplate();
}
