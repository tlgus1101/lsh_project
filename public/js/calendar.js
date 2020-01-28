$( document ).ready(function() {
    function c(passed_month, passed_year, calNum) {
        var calendar = calNum == 0 ? calendars.cal1 : calendars.cal2;
        makeWeek(calendar.weekline);
        calendar.datesBody.empty();
        var calMonthArray = makeMonthArray(passed_month, passed_year);
        var r = 0;
        var u = false;
        while(!u) {
            if(daysArray[r] == calMonthArray[0].weekday) { u = true }
            else {
                calendar.datesBody.append('<div class="blank"></div>');
                r++;
            }
        }
        for(var cell=0;cell<42-r;cell++) { // 42 date-cells in calendar
            if(cell >= calMonthArray.length) {
                calendar.datesBody.append('<div class="blank"></div>');
            } else {
                var shownDate = calMonthArray[cell].day;
                // Later refactiroing -- iter_date not needed after "today" is found
                var iter_date = new Date(passed_year,passed_month,shownDate);
                if (
                    (
                        ( shownDate != today.getDate() && passed_month == today.getMonth() )
                        || passed_month != today.getMonth()
                    )
                    && iter_date < today) {
                    var m = '<div class="past-date">';
                } else {
                    var m = checkToday(iter_date)?'<div class="today">':"<div>";
                }
                calendar.datesBody.append(m + shownDate + "</div>");
            }
        }

        // var color = o[passed_month];
        calendar.calHeader.find("h2").text(i[passed_month]+" "+passed_year);
        //.css("background-color",color)
        //.find("h2").text(i[passed_month]+" "+year);

        // find elements (dates) to be clicked on each time
        // the calendar is generated

        //clickedElement = bothCals.find(".calendar_content").find("div");
        var clicked = false;
        selectDates(selected);

        clickedElement = calendar.datesBody.find('div');
        clickedElement.on("click", function(){
            clicked = $(this);
            if (clicked.hasClass('past-date')) { return; }
            var whichCalendar = calendar.name;
            console.log(whichCalendar);
            // Understading which element was clicked;
            // var parentClass = $(this).parent().parent().attr('class');
            firstClicked = getClickedInfo(clicked, calendar);
            console.log(firstClicked.year+" "+(firstClicked.month+1)+" "+firstClicked.date );
            bothCals.find(".calendar_content").find("div").each(function(){
                $(this).removeClass("selected");
            });
            $(this).addClass('selected');

            findTimeList(firstClicked.year,(firstClicked.month+1),firstClicked.date);
            selectDates(selected);
        });

    }
    function selectDates(selected) {
        if (!$.isEmptyObject(selected)) {
            var dateElements1 = datesBody1.find('div');
            var dateElements2 = datesBody2.find('div');

            function highlightDates(passed_year, passed_month, dateElements){
                if (passed_year in selected && passed_month in selected[passed_year]) {
                    var daysToCompare = selected[passed_year][passed_month];
                    // console.log(daysToCompare);
                    for (var d in daysToCompare) {
                        dateElements.each(function(index) {
                            if (parseInt($(this).text()) == daysToCompare[d]) {
                                $(this).addClass('selected');
                            }
                        });
                    }
                }
            }
            console.log(year+" "+month+" "+dateElements1);
            highlightDates(year, month, dateElements1);
            highlightDates(nextYear, nextMonth, dateElements2);
        }
    }

    function makeMonthArray(passed_month, passed_year) { // creates Array specifying dates and weekdays
        var e=[];
        for(var r=1;r<getDaysInMonth(passed_year, passed_month)+1;r++) {
            e.push({day: r,
                // Later refactor -- weekday needed only for first week
                weekday: daysArray[getWeekdayNum(passed_year,passed_month,r)]
            });
        }
        return e;
    }
    function makeWeek(week) {
        week.empty();
        for(var e=0;e<7;e++) {
            week.append("<div>"+daysArray[e].substring(0,3)+"</div>")
        }
    }
    function getDaysInMonth(currentYear,currentMon) {
        return(new Date(currentYear,currentMon+1,0)).getDate();
    }
    function getWeekdayNum(e,t,n) {
        return(new Date(e,t,n)).getDay();
    }
    function checkToday(e) {
        var todayDate = today.getFullYear()+'/'+(today.getMonth()+1)+'/'+today.getDate();
        var checkingDate = e.getFullYear()+'/'+(e.getMonth()+1)+'/'+e.getDate();
        return todayDate==checkingDate;

    }
    function getAdjacentMonth(curr_month, curr_year, direction) {
        var theNextMonth;
        var theNextYear;
        if (direction == "next") {
            theNextMonth = (curr_month + 1) % 12;
            theNextYear = (curr_month == 11) ? curr_year + 1 : curr_year;
        } else {
            theNextMonth = (curr_month == 0) ? 11 : curr_month - 1;
            theNextYear = (curr_month == 0) ? curr_year - 1 : curr_year;
        }
        return [theNextMonth, theNextYear];
    }
    function b() {
        today = new Date;
        year = today.getFullYear();
        month = today.getMonth();
        var nextDates = getAdjacentMonth(month, year, "next");
        nextMonth = nextDates[0];
        nextYear = nextDates[1];
    }

    var e=480;

    var today;
    var year,
        month,
        nextMonth,
        nextYear;

    //var t=2013;
    //var n=9;
    var r = [];
    var i = ["JANUARY","FEBRUARY","MARCH","APRIL","MAY",
        "JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER",
        "NOVEMBER","DECEMBER"];
    var daysArray = ["일","월","화",
        "수","목","금","토"];
    var o = ["#16a085","#1abc9c","#c0392b","#27ae60",
        "#FF6860","#f39c12","#f1c40f","#e67e22",
        "#2ecc71","#e74c3c","#d35400","#2c3e50"];

    var cal1=$("#calendar_first");
    var calHeader1=cal1.find(".calendar_header");
    var weekline1=cal1.find(".calendar_weekdays");
    var datesBody1=cal1.find(".calendar_content");

    var cal2=$("#calendar_second");
    var calHeader2=cal2.find(".calendar_header");
    var weekline2=cal2.find(".calendar_weekdays");
    var datesBody2=cal2.find(".calendar_content");

    var bothCals = $(".calendar");

    var switchButton = bothCals.find(".calendar_header").find('.switch-month');

    var calendars = {
        "cal1": { 	"name": "first",
            "calHeader": calHeader1,
            "weekline": weekline1,
            "datesBody": datesBody1 },
        "cal2": { 	"name": "second",
            "calHeader": calHeader2,
            "weekline": weekline2,
            "datesBody": datesBody2	}
    }


    var clickedElement;
    var firstClicked,
        secondClicked,
        thirdClicked;
    var firstClick = false;
    var secondClick = false;
    var selected = {};

    b();
    c(month, year, 0);
    c(nextMonth, nextYear, 1);
    switchButton.on("click",function() {
        var clicked=$(this);
        var generateCalendars = function(e) {
            var nextDatesFirst = getAdjacentMonth(month, year, e);
            var nextDatesSecond = getAdjacentMonth(nextMonth, nextYear, e);
            month = nextDatesFirst[0];
            year = nextDatesFirst[1];
            nextMonth = nextDatesSecond[0];
            nextYear = nextDatesSecond[1];

            c(month, year, 0);
            c(nextMonth, nextYear, 1);
        };
        if(clicked.attr("class").indexOf("left")!=-1) {
            generateCalendars("previous");
        } else { generateCalendars("next"); }
        clickedElement = bothCals.find(".calendar_content").find("div");
        console.log("checking");
    });

    function getClickedInfo(element, calendar) {
        var clickedInfo = {};
        var clickedCalendar,
            clickedMonth,
            clickedYear;
        clickedCalendar = calendar.name;
        //console.log(element.parent().parent().attr('class'));
        clickedMonth =  month ;
        clickedYear =  year;
        clickedInfo = {"calNum": clickedCalendar,
            "date": parseInt(element.text()),
            "month": clickedMonth,
            "year": clickedYear}
        //console.log(clickedInfo);
        return clickedInfo;
    }
});
