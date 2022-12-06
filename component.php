<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arParams['ROOT_MENU_TYPE'] = strval($arParams['ROOT_MENU_TYPE']);
$arParams['INNER_MENU_TYPE'] = strval($arParams['INNER_MENU_TYPE']);
$arParams['DIR'] = strval($arParams['DIR']);
$arParams['MAX_DEPTH'] = intval($arParams['MAX_DEPTH']);

if (strlen($arParams['DIR']) <= 0) {
    $arPath = explode("/", $APPLICATION->GetCurDir());
    if (strlen($arPath[2]) > 0) {
        $arParams['DIR'] = implode("/", array_slice($arPath, 0, 3)) . 'component.php/';
    } else
        $arParams['DIR'] = SITE_DIR;
}

function GetChild($dir, $type, $depth, $maxDepth)
{
    $result = [];
    $currentDepth = $depth + 1;
    $menu = new CMenu($type);
    $menu->Init($dir, true, '/bitrix/components/bitrix/menu/stub.php');
    if ($menu->MenuDir == $dir) {
        $menu->RecalcMenu();
        $arMenu = $menu->arMenu;
        foreach ($arMenu as $arItem) {
            $item = $arItem;
            $item["DEPTH"] = $currentDepth;
            if ($maxDepth <= 0 || $maxDepth > $currentDepth)
                $item['CHILD'] = GetChild($item['LINK'], $type, $currentDepth, $maxDepth);
            $result[] = $item;
        }
    }
    return $result;
}

function GetMenuTree($dir, $top, $inner, $maxDepth)
{
    $result = [];
    $menu = new CMenu($top);
    $menu->Init($dir, true, '/bitrix/components/bitrix/menu/stub.php');
    if ($menu->MenuDir == $dir) {
        $menu->RecalcMenu();
        $arMenu = $menu->arMenu;
        foreach ($arMenu as $arItem) {
            $item = $arItem;
            $item["DEPTH"] = 1;
            if ($maxDepth <= 0 || $maxDepth > 1)
                $item['CHILD'] = GetChild($item['LINK'], $inner, 1, $maxDepth);
            $result[] = $item;
        }
    }
    return $result;
}

if ($this->StartResultCache(false, array($USER->GetGroups(), $_GET, $APPLICATION->GetCurUri()))) {
    $arResult['ITEMS'] = GetMenuTree($arParams['DIR'], $arParams['ROOT_MENU_TYPE'], $arParams['INNER_MENU_TYPE'], $arParams['MAX_DEPTH']);
    $this->IncludeComponentTemplate();
} else {
    $this->AbortResultCache();
}
?>