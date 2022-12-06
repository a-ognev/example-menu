## Компонент иерахичного многоуровнего меню

Расположение компонента
```
/local/components/example/menu/
```

Подключение компонента
```php
<? $APPLICATION->IncludeComponent(
    "example:menu",
    ".default",
    array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "DIR" => "/", // Директория начала построения меню
        "ROOT_MENU_TYPE" => "top", // Основное меню
        "INNER_MENU_TYPE" => "left", // Меню для остальных уровней
        "MAX_DEPTH" => "0", //Максимальная вложенность
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
); ?>
```
