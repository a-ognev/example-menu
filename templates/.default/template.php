<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<?php function buildLevel($menuItems)
{ ?>
    <ul>
        <?php foreach ($menuItems as $item): ?>
            <li>
                <?php if ($item["PERMISSION"] > "D"): ?>
                    <a href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
                <?php else: ?>
                    <p class="denied"><?= $item["TEXT"] ?></p>
                <?php endif; ?>
                <?php if (!empty($item["CHILD"])): ?>
                    <?php buildLevel($item["CHILD"]) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php } ?>

<?php if (!empty($arResult["ITEMS"])): ?>

    <nav>
        <?php buildLevel($arResult["ITEMS"]) ?>
    </nav>

<?php endif; ?>