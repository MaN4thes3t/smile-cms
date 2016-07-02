<?php
use frontend\widgets\NewsOneSlider;
use frontend\widgets\VideoNewsSlider;
use frontend\widgets\TheVoiceOfCommunityMain;
use frontend\widgets\FocusOfTheWeekMain;
use frontend\widgets\InterviewMain;
use frontend\widgets\PhotoNewsSlider;
use frontend\widgets\AfishaMain;
use frontend\widgets\WeatherBlock;
use frontend\widgets\ZhitomirTodayMain;
?>
<?php //echo ZhitomirTodayMain::widget()?>
<?php echo NewsOneSlider::widget()?>
<?php echo TheVoiceOfCommunityMain::widget()?>
<?php echo VideoNewsSlider::widget()?>
<?php echo FocusOfTheWeekMain::widget()?>
<?php echo InterviewMain::widget()?>
<?php echo WeatherBlock::widget()?>
<?php echo AfishaMain::widget()?>
<?php echo PhotoNewsSlider::widget()?>

<div class="zhitomirLive">
    <div class="verticalTextWrapper">
        <h2 class="verticalText"><a href="#" title="">Житомир <span>Live</span></a></h2>
    </div>
    <div class="zhitomirLiveImgWrap">
        <a href="#" title=""><img src="images/slider/3.jpg" alt=""></a>
    </div>
    <p class="zhitomirLiveHeader"><a href="#" title="">Разведчик 95-ой бригады Иван Трембовецкий: Как мы выходили из Дебальцево</a></p>
    <p class="zhitomirLiveDesc"><a href="#" title="">Год назад, после Майдана, когда началась эта заварушка с Крымом, мы пошли с друзьями в... </a></p>
</div>
<div class="social">
    <h2 class="blockHeader"><a href="#" title="">Соціологія</a></h2>
    <a href="#" class="blockNext">Архів опитувань →</a>
    <form action="" method="get" accept-charset="utf-8">
        <h3 class="blockName"><a href="#" title="">Ваше відношення до сучасного політичного устрою України?</a></h3>
        <label>
            <input type="radio" name="ukr" value="">Мені байдуже</label>
        <label>
            <input type="radio" name="ukr" value="">Досить нормально</label>
        <label>
            <input type="radio" name="ukr" value="">Вкрай негативно</label>
        <label>
            <input type="radio" name="ukr" value="">Помірне ставлення</label>
        <label>
            <input type="radio" name="ukr" value="">Я про це не думав</label>
        <button type="submit">
            <div class="submitHover">
            </div>Проголосувати
        </button>
    </form>
</div>
<div class="focusOfTheWeek kitchen">
    <h2 class="blockHeader"><a href="#" title="">КУЛІНАРІЯ</a></h2>
    <a href="#" class="blockNext">Більше →</a>
    <ul class="clear">
        <li>
            <figure>
                <div class="blogImgWrapper">
                    <a href="#" title="">
                        <img src="images/tGarmashenko.png" alt="">
                    </a>
                </div>
                <figcaption>
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                    <time datetime=""><a href="#" title="">11 вересня 09:35</a></time>
                </figcaption>
            </figure>
        </li>
        <li>
            <figure>
                <div class="blogImgWrapper">
                    <a href="#" title="">
                        <img src="images/tGarmashenko.png" alt="">
                    </a>
                </div>
                <figcaption>
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                    <time datetime=""><a href="#" title="">11 вересня 09:35</a></time>
                </figcaption>
            </figure>
        </li>
        <li>
            <figure>
                <div class="blogImgWrapper">
                    <a href="#" title="">
                        <img src="images/tGarmashenko.png" alt="">
                    </a>
                </div>
                <figcaption>
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                    <time datetime=""><a href="#" title="">11 вересня 09:35</a></time>
                </figcaption>
            </figure>
        </li>
        <li>
            <figure>
                <div class="blogImgWrapper">
                    <a href="#" title="">
                        <img src="images/tGarmashenko.png" alt="">
                    </a>
                </div>
                <figcaption>
                    <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                    <time datetime=""><a href="#" title="">11 вересня 09:35</a></time>
                </figcaption>
            </figure>
        </li>
    </ul>
</div>
<div class="birthday">
    <h2 class="blockHeader"><a href="#">ІМЕНИННИКИ СЬОГОДНІ</a></h2>
    <a href="#" title="" class="blockNext">Переглянути всіх →</a>
    <div>
        <figure>
            <div class="birthdayImgWrap">
                <a href="#" title=""><img src="images/tGarmashenko.png" alt=""></a>
            </div>
            <figcaption>
                <h3><a href="#" title="">Анастасія Гармаш</a></h3>
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                <p><a href="#" title="">11 вересня 09:35</a></p>
            </figcaption>
        </figure>
        <figure>
            <div class="birthdayImgWrap">
                <a href="#" title=""><img src="images/tGarmashenko.png" alt=""></a>
            </div>
            <figcaption>
                <h3><a href="#" title="">Анастасія Гармаш</a></h3>
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                <p><a href="#" title="">11 вересня 09:35</a></p>
            </figcaption>
        </figure>
        <figure>
            <div class="birthdayImgWrap">
                <a href="#" title=""><img src="images/tGarmashenko.png" alt=""></a>
            </div>
            <figcaption>
                <h3><a href="#" title="">Анастасія Гармаш</a></h3>
                <p><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></p>
                <p><a href="#" title="">11 вересня 09:35</a></p>
            </figcaption>
        </figure>
    </div>
</div>
<div class="advice">
    <h2 class="blockHeader"><a href="#" title="">ПОРАДНИЦЯ</a></h2>
    <ul class="clear">
        <li><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></li>
        <li><a href="#" title="">Запрошує житомирську молодь у гідропарк на КВЕСТ «Прояви смвою кмітливість»</a></li>
        <li><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></li>
        <li><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></li>
        <li><a href="#" title="">Запрошує житомирську молодь у гідропарк на КВЕСТ «Прояви смвою кмітливість»</a></li>
        <li><a href="#" title="">Янукович взявся призначати суддів на Житомирщині</a></li>
    </ul>
</div>
<div class="calendar">
    <h2 class="blockHeader"></h2>
    <div class="control">
        <button class="prev"></button>
        <button class="next"></button>
    </div>
    <div class="calWrap">
        <ul class="calDay clear">
            <li>Пн</li>
            <li>Вт</li>
            <li>Ср</li>
            <li>Чт</li>
            <li>Пт</li>
            <li>Сб</li>
            <li>Нд</li>
        </ul>
        <ul class="calDate clear">

        </ul>
    </div>
</div>
<div class="lastComments">
    <h2 class="blockHeader"><a href="#">ОСТАННІ КОМЕНТАРІ</a></h2>
    <div class="comments">
        <ul>
            <li>
                <h3><a href="#">Анастасія:</a></h3>
                <p><a href="#" title="">Генеральний директор Рідна корпорація голови «Укравтодору» закопає 232 мільй...</a></p>
            </li>
            <li>
                <h3><a href="#">Анастасія:</a></h3>
                <p><a href="#" title="">Генеральний директор Рідна корпорація голови «Укравтодору» закопає 232 мільй...</a></p>
            </li>
            <li>
                <h3><a href="#">Анастасія:</a></h3>
                <p><a href="#" title="">Генеральний директор Рідна корпорація голови «Укравтодору» закопає 232 мільй...</a></p>
            </li>
            <li>
                <h3><a href="#">Анастасія:</a></h3>
                <p><a href="#" title="">Генеральний директор Рідна корпорація голови «Укравтодору» закопає 232 мільй...</a></p>
            </li>
            <li>
                <h3><a href="#">Анастасія:</a></h3>
                <p><a href="#" title="">Генеральний директор Рідна корпорація голови «Укравтодору» закопає 232 мільй...</a></p>
            </li>
        </ul>
    </div>
</div>
<div class="add">

</div>
<section class="manyNews clear">
    <div class="ukraineNews mNews">
        <h2 class="headerMNews"><a href="#" title="">НОВИНИ УКРАЇНИ</a></h2>
        <div class="mNewsContent">
            <ul>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Запрошує житомирську молодь у гідропарк на КВЕСТ</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">У Житомирі міліція затримала зухвалого грабіжника на місці</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Власників житомирських магазинів ресторан зобов'яжуть узгоджувати</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">У Житомирі міліція затримала зухвалого грабіжника на місці скоєння злочину</a></p></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="worldNews mNews">
        <h2 class="headerMNews"><a href="#" title="">СВІТОВІ НОВИНИ</a></h2>
        <div class="mNewsContent">
            <ul>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Запрошує житомирську молодь у гідропарк на КВЕСТ</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">У Житомирі міліція затримала зухвалого грабіжника на місці</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Власників житомирських магазинів ресторан зобов'яжуть узгоджувати</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">У Житомирі міліція затримала зухвалого грабіжника на місці скоєння злочину</a></p></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="interesting mNews">
        <h2 class="headerMNews"><a href="#" title="">ЦІКАВИНКА</a></h2>
        <div class="mNewsContent">
            <ul>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Запрошує житомирську молодь у гідропарк на КВЕСТ</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">У Житомирі міліція затримала зухвалого грабіжника на місці</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Власників житомирських магазинів ресторан зобов'яжуть узгоджувати</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">Янукович взявся призначати суддів на Житомирщині</a></p></div>
                </li>
                <li>
                    <div class="data"><a href="#" title=""><time>09.08.2015</time></a></div>
                    <div class="text"><p><a href="#">У Житомирі міліція затримала зухвалого грабіжника на місці скоєння злочину</a></p></div>
                </li>
            </ul>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        if($(".owl-carousel").length){
            $(".owl-carousel").owlCarousel({
                items: 3,
                loop: true,
                margin: 10,
                nav: true,
            });
        }
        if($(".owl-carousel-photo").length) {
            $(".owl-carousel-photo").owlCarousel({
                items: 3,
                loop: true,
                margin: 10,
                nav: true,
            });
        }
        if($(".owl-carousel-interview").length) {
            $(".owl-carousel-interview").owlCarousel({
                items: 1,
                loop: true,
                nav: true,
            });
        }
    });
</script>