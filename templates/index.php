<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach($categories_list as $a=>$val) :?>

                <li class="promo__item promo__item-- <?php $a ?> ">
                    <a class="promo__link" href="pages/all-lots.html"><?php echo($val);?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php foreach($data_list as $z => $val) :?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="img/lot-<?=($z + 1)?>.jpg" width="350" height="260" alt="<?php $val['name']?>">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?php echo($categories_list[$val['category']]); ?></span>
                        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?php echo($val['name']); ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount"><?php echo($val['count']);?></span>
                                <span class="lot__cost"> <?= Sum_Price($val['count'], true) ?><b class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">
                                12:23
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
