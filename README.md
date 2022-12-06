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
        "DIR" => "/",
        "ROOT_MENU_TYPE" => "top",
        "INNER_MENU_TYPE" => "top",
        "MAX_DEPTH" => "0",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
); ?>
```
