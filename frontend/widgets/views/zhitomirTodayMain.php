
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news && $category){
    ?>
    <div class="zhitomirToday">
        <div>
            <h2>
                <a title="<?php echo Yii::t('frontend', 'ЖИТОМИРЩИНА СЬОГОДНІ')?>"
                   href="<?php echo Yii::$app->urlManager->createAbsoluteUrl($category->translit)?>">
                    <?php echo Yii::t('frontend', 'ЖИТОМИРЩИНА СЬОГОДНІ')?>
                </a>
            </h2>
        </div>
        <?php foreach($news as $one){
            ?>

            <?php
        }?>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">08:15</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">09:35</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Запрошує житомирську молодь у гідропарк на КВЕСТ Прояви</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">10:15</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">10:35</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">У Житомирі міліція затримала зухвалого грабіжника просто на</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">10:15</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Власників житомирських магазинів ресторан зобов'яжуть</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">10:35</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">10:15</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Запрошує житомирську молодь у гідропарк на КВЕСТ</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
            </div>
        </section>
        <section class="zhitomirToday-item clear">
            <time datetime="08:15">10:35</time>
            <div class="zhitomirToday-wrapContent">
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
            </div>
        </section>
        <section class="olderNews">
            <h3>Вчора</h3>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">У Житомирі міліція затримала зухвалого грабіжника просто на</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">У Житомирі міліція затримала зухвалого грабіжника просто на</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
                </div>
            </section>
        </section>
        <section class="olderNews">
            <h3>11.08.16</h3>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">У Житомирі міліція затримала зухвалого грабіжника просто на</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">У Житомирі міліція затримала зухвалого грабіжника просто на</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a><a href="#" class="zhitomirToday-magazine">Рупор Житомира</a></p>
                </div>
            </section>
            <section class="zhitomirToday-item clear">
                <div class="zhitomirToday-wrapContent">
                    <p><a href="#" title="">У Житомирі міліція затримала зухвалого грабіжника просто на</a><a href="#" class="zhitomirToday-magazine">Жирнал житомира</a></p>
                </div>
            </section>
        </section>
        <div class="zhitomirToday-pages">
            <span>Сторінки:</span>
            <ul class="">
                <li class="activePage"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li>...</li>
                <li><a href="#">25</a></li>
                <li><a href="#">26</a></li>
                <li><a href="#" class="nextPage">наступна→</a></li>
            </ul>
        </div>
    </div>
    <?php
}