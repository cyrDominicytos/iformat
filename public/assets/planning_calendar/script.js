let nav = 0;
let clicked = null;
let clickedTime = null;
let clickedPlace = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const newEventModal = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function openModal(date, hour, place) {
    clicked = date;
    let eventForDayList = events[date];
    const eventForDay = eventForDayList.find(e => e.date === clicked && e.learnTime === hour && e.learnClass === place);
    console.log(eventForDay)

    if (eventForDay) {
        document.getElementById('learnTime').innerHTML = eventForDay.learnTime;
        document.getElementById('learnText').innerHTML = eventForDay.learnText;
        document.getElementById('learnClass').innerHTML = eventForDay.learnClass;
        document.getElementById('learnDesc').innerHTML = eventForDay.learnDesc;
        document.getElementById('learnGoal').innerHTML = eventForDay.learnGoal;
        document.getElementById('learnGroup').innerHTML = eventForDay.learnGroup;
        showEventModal.style.display = 'block';
        backDrop.style.display = 'block';
    }

}

function load() {
    const dt = new Date();
    if (nav !== 0) {
        dt.setMonth(new Date().getMonth() + nav);
    }
    const day = dt.getDate();
    const month = dt.getMonth();
    const year = dt.getFullYear();

    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
        weekday: 'long',
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
    });
    const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);
    document.getElementById('monthDisplay').innerText = `${dt.toLocaleDateString('fr-fr', { month: 'long' })} ${year}`;
    calendar.innerHTML = '';
    console.log(events);

    for (let i = 1; i <= paddingDays + daysInMonth; i++) {
        const daySquare = document.createElement('div');
        daySquare.classList.add('day');
        const displayDate = (i - paddingDays) < 10 ? '0' + (i - paddingDays) : (i - paddingDays);
        const displayMonth = (month + 1) < 10 ? '0' + (month + 1) : (month + 1);
        const dayString = `${year}-${displayMonth}-${displayDate}`;
        // console.log(dayString)
        if (i > paddingDays) {
            daySquare.innerText = i - paddingDays;
            const eventForDay = events[dayString];
            if (i - paddingDays === day && nav === 0) {
                daySquare.id = 'currentDay';
            }
            console.log(eventForDay);
            if (eventForDay) {
                for (let t = 0; t < eventForDay.length; t++) {
                    let eventDiv = document.createElement('div');
                    eventDiv.classList.add('event');
                    eventDiv.innerHTML = eventForDay[t].title;
                    daySquare.appendChild(eventDiv);
                    eventDiv.addEventListener('click', () => openModal(dayString, eventForDay[t].learnTime, eventForDay[t].learnClass));
                }

            }

        } else {
            daySquare.classList.add('padding');
        }

        calendar.appendChild(daySquare);
    }
}

function closeModal() {
    //eventTitleInput.classList.remove('error');
    //newEventModal.style.display = 'none';
    showEventModal.style.display = 'none';
    backDrop.style.display = 'none';
    //eventTitleInput.value = '';
    clicked = null;
    clickedTime = null;
    load();
}

function saveEvent() {
    if (eventTitleInput.value) {
        eventTitleInput.classList.remove('error');

        events.push({
            date: clicked,
            title: eventTitleInput.value,
        });

        localStorage.setItem('events', JSON.stringify(events));
        closeModal();
    } else {
        eventTitleInput.classList.add('error');
    }
}

function deleteEvent() {
    events = events.filter(e => e.date !== clicked);
    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
}

function initButtons() {
    document.getElementById('nextButton').addEventListener('click', () => {
        nav++;
        switch_events();
        //load();
    });

    document.getElementById('backButton').addEventListener('click', () => {
        nav--;
        switch_events();
        //load();
    });
    document.getElementById('exitButton').addEventListener('click', closeModal);
}

function initEvents() {
    events = php_events;
}

function switch_events() {

    var newDate = new Date();

    if (nav !== 0) {
        newDate.setMonth(newDate.getMonth() + nav);
    }
    const month = newDate.getMonth() < 10 ? '0' + (newDate.getMonth() + 1) : newDate.getMonth();
    const yearMonth = newDate.getFullYear() + "-" + month;
    console.log(yearMonth);

    $.ajax({
        url: switch_events_route,
        type: "POST",
        data: {
            yearMonth: yearMonth,
        },
        success: function(result) {
            events = result;
            load();
            console.log(events);
        }
    });
}
initButtons();
initEvents();
load();