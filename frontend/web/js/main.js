$(document).ready(function(){
    try {
        var photoSliderMainBlock = document.getElementsByClassName('sliderWrap')[0],
            photoSliderControls = document.getElementsByClassName('sliderControlsHelp')[0],
            photoSliderMainBlockE = photoSliderMainBlock.getElementsByClassName('owl-stage-outer')[0],
            photoSliderControlsE = photoSliderControls.getElementsByClassName('owl-stage-outer')[0];
        photoSliderControlsE.addEventListener('click', function (event) {
            var target = event.target,
                index, item, itm = '';
            if (target.className = 'owl-item') {
                index = $(target).parent().parent().index();
                item = $(photoSliderMainBlockE).children().children();

                $(item).each(function () {
                    $(this).removeClass('active');
                });
                $('.themeSlider').find('.owl-stage').first().css({'transform': 'translate3d(' + (index*-732) + 'px, 0px, 0px)', 'transition':'.3s'});
                $(item[index]).addClass('active');
                var imgs = $(photoSliderControls).find('img');
                $(imgs).each(function () {
                    $(this).removeClass('active');
                });
                $(target).addClass('active');
            }
        });
    } catch (e) {}


    // slider
    var sControl = document.getElementsByClassName('sliderControls')[0];
    var slider = document.getElementsByClassName('sliderWrap')[0];
    sControl.children[0].style.borderBottom = "3px solid #d62424";
    sControl.addEventListener('click', function (event) {
        var target = event.target;
        var buf = '';
        if (target.tagName == 'IMG') {
            target = target.parentElement;
        } else if(target.tagName == 'UL') {
            return;
        }
        for (var item = 0; item < sControl.children.length; item++) {
            if (target == sControl.children[item]) {
                if (target.parentElement.parentElement.parentElement.className == "asideInfo") { //fix for video page
                    slider.style.left = -355 * item + "px";
                } else {
                    slider.style.left = -733 * item + "px";
                }
                target.style.borderBottom = "3px solid #d62424";
            } else {
                sControl.children[item].style.borderBottom = "3px solid transparent";
            }
        }
    });
    // calendar   calToday
    var monthArr = ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"];
    var engMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var todayMonth = new Date().getUTCMonth();
    var todayDate = new Date().getUTCDate();
    var todayYear = new Date().getUTCFullYear();

    try{
        makeCalendar(engMonth[todayMonth], todayYear, todayDate+1);
        var calendar = document.getElementsByClassName('calendar')[0];
        var prevB = calendar.getElementsByClassName('prev')[0];
        var nextB = calendar.getElementsByClassName('next')[0];
        var control = calendar.getElementsByClassName('control')[0];
        control.addEventListener('click', function (event) {
            var monthFrom = calendar.getElementsByTagName('span')[0];
            monthFrom = monthFrom.textContent;
            var yearFrom = calendar.getElementsByTagName('span')[1];
            yearFrom = yearFrom.textContent;
            yearFrom = parseInt(yearFrom);
            var target = event.target;
            if (target == prevB) {
                for (var i = 0; i < monthArr.length; i++){
                    if (monthFrom == monthArr[i]) {
                        if (i == '0') {
                            makeCalendar("December", yearFrom-1);
                            break;
                        } if (i == '1') {
                            makeCalendar(engMonth[0], yearFrom+1);
                        } else {
                            makeCalendar(engMonth[i-1], yearFrom);
                        }
                    }
                }
            }
            if (target == nextB) {
                for (var j = 0; j < monthArr.length; j++){
                    if (monthFrom == monthArr[j]) {
                        if (j == '11') {
                            makeCalendar("January", yearFrom+2);
                            break;
                        } if (j == '10') {
                            makeCalendar(engMonth[11], yearFrom);
                        } else {
                            makeCalendar(engMonth[j+1], yearFrom);
                        }
                    }
                }
            }
        });
        function clearCalendar() {
            var cal = document.getElementsByClassName('calendar')[0];
            var name = cal.getElementsByClassName('blockHeader')[0];
            var calDate = cal.getElementsByClassName('calDate')[0];
            name.innerHTML = "";
            var mm = calDate.children.length;
            for (var k = 0; k <= mm; k++) {
                if (calDate.children.length == '0') break;
                calDate.removeChild(calDate.children[0]);
            }
        }
        function makeCalendar(month, year, today) {
            clearCalendar();
            var today = today || "";    // если задан день то збсь)
            var startDay = new Date(month + " 1, " + year), // какой месяц
                dayStart = startDay.getDay(),   // с какого дня начинаеться месяц
                cal = document.getElementsByClassName('calendar')[0],
                calDate = cal.getElementsByClassName('calDate')[0],
                name = cal.getElementsByClassName('blockHeader')[0],
                dayArr = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; // количества дней в месяце (с февралем пока не порешал)
            if (month == 'February') {
                if (year % 4 == 0) {
                    dayArr[1] = 29;
                }
            }
            var monthLength = dayArr[startDay.getMonth()];
            name.innerHTML = "АРХІВ НОВИН ЗА <span>" + monthArr[startDay.getMonth()] + "</span> <span>" + startDay.getUTCFullYear() + "</span>";
            for (var j = 1; j < dayStart; j++) {    // пропускаем дни
                var fakeLi = document.createElement('li'),
                    fakeA = document.createElement('a'),
                    textNodeX = document.createTextNode(' ');
                fakeA.appendChild(textNodeX);
                fakeLi.appendChild(fakeA);
                calDate.appendChild(fakeLi);
            }
            for (var i = 1; i <= monthLength; i++) { // рисуем дни
                var newLi = document.createElement('li'),
                    newA = document.createElement('a'),
                    textNode = document.createTextNode(i);
                if (i == today) {
                    newLi.setAttribute('class', 'calToday');
                }
                newA.setAttribute('href', "#blabla_"+i);
                newA.appendChild(textNode);
                newLi.appendChild(newA);
                calDate.appendChild(newLi);
            }
        }
    } catch (e) {}
    $(document).ready(function(){
        $(".videoCaption a, .afishaDesc p a, .famousPeople h2, " +
            ".famousPeople p, " +
            ".famousPeople .famousPeopleGo," +
            ".sliderItemWrap p a, .todayWord h3 a, " +
            ".afisha .moreNews p a, .zhitomirLiveDesc a, p.zhitomirLiveHeader a, .focusOfTheWeek p a, .interview p a, .advice li a, .mNews .text a "
        ).dotdotdot();
        $('.todayWord p a').dotdotdot({
            callback: function( isTruncated, orgContent){
                if(isTruncated){
                    $('.todayWord p a').css('max-height', 'inherit');
                }

            }
        });
    });
});

