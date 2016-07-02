<div class="weatherBlock">
    <div id="SinoptikInformer" style="width:100%;" class="SinoptikInformer type1">
        <div class="siHeader">
            <div class="siLh">
                <div class="siMh"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/" target="_blank">
                        <?php echo Yii::t('frontend', 'Погода')?></a>
                    <a onmousedown="siClickCount();" class="siLogo" href="https://ua.sinoptik.ua/" target="_blank"> </a> <span id="siHeader"></span>
                </div>
            </div>
        </div>
        <div class="siBody">
            <div class="siCity">
                <div class="siCityName"><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-житомир" target="_blank"><?php echo Yii::t('frontend', 'Погода в')?><span><?php echo Yii::t('frontend', 'Житомире')?></span></a></div>
                <div id="siCont0" class="siBodyContent">
                    <div class="siLeft">
                        <div class="siTerm"></div>
                        <div class="siT" id="siT0"></div>
                        <div id="weatherIco0"></div>
                    </div>
                    <div class="siInf">
                        <p><?php echo Yii::t('frontend', 'влажность')?>: <span id="vl0"></span></p>
                        <p><?php echo Yii::t('frontend', 'давление')?>: <span id="dav0"></span></p>
                        <p><?php echo Yii::t('frontend', 'ветер')?>: <span id="wind0"></span></p>
                    </div>
                </div>
            </div>
            <div class="siLinks"><span><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-бердичів" target="_blank"><?php echo Yii::t('frontend', 'Погода в Бердичеве')?></a>&nbsp;</span><span><a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-київ" target="_blank"><?php echo Yii::t('frontend', 'Погода в Киеве')?></a>&nbsp;</span></div>
        </div>
        <div class="siFooter">
            <div class="siLf">
                <div class="siMf"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=3&amp;cities=303008030&amp;lang=ua"></script>
</div>