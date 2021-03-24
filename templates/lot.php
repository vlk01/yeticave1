<?php
?>
<nav class="nav">
    <ul class="nav__list container">
        <?php foreach($categories_list as $category) :?>

            <li class="nav__item">
                <a href="all-lots.html"><?= $category['categ_name'];?></a>
            </li>
        <?php endforeach; ?>

    </ul>
</nav>
<section class="lot-item container">
    <h2><?= $lot['lot_name']; ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="../<?=$lot['lot_img']?>" width="730" height="548" alt="">
            </div>
            <p class="lot-item__category">Категория: <span><?= $categories_list[$lotID]['categ_name'];?></span></p>
            <p class="lot-item__description"><?= $lot['lot_discr'];?></p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    <?= My_Timer()?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=  Sum_Price($lot['lot_first_price'], true)?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span>12 000 р</span>
                    </div>
                </div>
                <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="12 000">
                        <span class="form__error">Введите наименование лота</span>
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>

        </div>
    </div>
</section>
