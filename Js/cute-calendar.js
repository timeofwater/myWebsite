/**
 * generate a cute calender
 * @param date today
 * @param firstWeekInThisTerm 2022 autumn
 * @returns {HTMLElement} a cute calender
 */
function genCuteCalendar(date, firstWeekInThisTerm = new Date(2022, 7, 29)) {
    var weekDayArray = ["\u5468\u65e5", "\u5468\u4e00", "\u5468\u4e8c", "\u5468\u4e09", "\u5468\u56db", "\u5468\u4e94", "\u5468\u516d"];
    var weekDayInfoArray = ["\u4e00", "\u4e8c", "\u4e09", "\u56db", "\u4e94", "\u516d", "\u65e5"];
    var titleDate = date.getFullYear() + "." + (date.getMonth() + 1) + "." + date.getDate() + " " + weekDayArray[date.getDay()];

    var calDiv = document.createElement("div");
    calDiv.setAttribute("class", "cute-calendar");

    var calTable = document.createElement("table");
    calTable.setAttribute("class", "cute-calendar-table");
    calDiv.appendChild(calTable);

    var calTr1 = document.createElement("tr");
    calTr1.setAttribute("class", "cute-calendar-tr");
    calTable.appendChild(calTr1);

    var calThTime = document.createElement("th");
    calThTime.setAttribute("class", "cute-calendar-th time-th");
    calThTime.setAttribute("colspan", "7");
    calThTime.innerText = titleDate;
    calTr1.appendChild(calThTime);

    var calThUp = document.createElement("th");
    calThUp.setAttribute("id", "cute-calender-up");
    calThUp.setAttribute("class", "cute-calendar-th buttons-th");
    calThUp.innerText = "\u2191";
    calThUp.onclick = function () {
        calDiv.parentElement.appendChild(genCuteCalendar(new Date(date.getFullYear(), (date.getMonth() - 1))));
        calDiv.remove();
    };
    calTr1.appendChild(calThUp);

    var calThDown = document.createElement("th");
    calThDown.setAttribute("id", "cute-calender-down");
    calThDown.setAttribute("class", "cute-calendar-th buttons-th");
    calThDown.innerText = "\u2193";
    calThDown.onclick = function () {
        calDiv.parentElement.appendChild(genCuteCalendar(new Date(date.getFullYear(), (date.getMonth() + 1))));
        calDiv.remove();
    };
    calTr1.appendChild(calThDown);

    var calTr2 = document.createElement("tr");
    calTr2.setAttribute("class", "cute-calendar-tr");
    calTable.appendChild(calTr2);

    for (var i = 0; i < 7; i++) {
        var calThDayInfo = document.createElement("th");
        if (i < 5) {
            calThDayInfo.setAttribute("class", "cute-calendar-th");
        } else {
            calThDayInfo.setAttribute("class", "cute-calendar-th day-off");
        }
        calThDayInfo.innerText = weekDayInfoArray[i];
        calTr2.appendChild(calThDayInfo);
    }

    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var firstWeek = Math.floor((firstDay - firstWeekInThisTerm) / 1000 / 60 / 60 / 24 / 7) + 1;
    var isStart = false;
    var day = 1;
    for (var i = 0; i < 6; i++) {
        var calTr3to8 = document.createElement("tr");
        calTr3to8.setAttribute("class", "cute-calendar-tr");
        calTable.appendChild(calTr3to8);

        for (var j = 0; j < 7; j++) {
            var calTd = document.createElement("td");
            if (j < 5) {
                calTd.setAttribute("class", "cute-calendar-td");
            } else {
                calTd.setAttribute("class", "cute-calendar-td day-off");
            }
            if ((firstDay.getDay() - 1 + 7) % 7 === j) {
                isStart = true;
            }
            if (isStart) {
                if (new Date(date.getFullYear(), date.getMonth(), day).getMonth() === date.getMonth()) {
                    if (date.getDate() === day) {
                        calTd.className += " this-day";
                    }
                    calTd.setAttribute("id", "cute-calender-day-" + day);
                    calTd.innerText = "" + day;
                    day += 1;
                }
            }
            calTr3to8.appendChild(calTd);
        }

        var calThDayNum = document.createElement("th");
        calThDayNum.setAttribute("class", "cute-calendar-th week-th");
        calThDayNum.setAttribute("colspan", "2");
        calThDayNum.innerText = "" + (i + firstWeek);
        calTr3to8.appendChild(calThDayNum);
    }

    return calDiv;
}