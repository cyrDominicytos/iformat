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

    for (let i = 1; i <= paddingDays + daysInMonth; i++) {
        const daySquare = document.createElement('div');
        daySquare.classList.add('day');
        const displayDate = (i - paddingDays) < 10 ? '0' + (i - paddingDays) : (i - paddingDays);
        const displayMonth = (month + 1) < 10 ? '0' + (month + 1) : (month + 1);
        const dayString = `${year}-${displayMonth}-${displayDate}`;
        console.log(dayString)
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
            /*else{
            		let eventDiv = document.createElement('div');
                    eventDiv.classList.add('event');
            	    eventDiv.innerHTML = "<div style='width:100%' title='Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication'><p style='text-align:center; font-weight:bold; color:red;'>7:00 - 12:00</p> \n\n Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication</div>";
                    daySquare.appendChild(eventDiv);
            		let eventList = [];
            		
            	    eventList.push({
            		   date: dayString,
            		   learnTime: "08H30 – 12H30",
            		   learnClass: "Salle 1",
            		   learnText: "PERFECTIONNEMENT BUREAUTIQUE",
            		   learnGoal: "Word, PowerPoint et Excel sont des logiciels utilisés au quotidien dans les entreprises. Pourtant, certaines fonctionnalités conçues pour améliorer l’efficience restent peu ou pas utilisées. Nous proposons des formations très opérationnelles qui couvrent tous les besoins et tous les niveaux de compétences pour être opérationnel en milieu professionnel.Obtenez la Certification internationale ICDL",
            		   learnDesc: "* 30 heures soit 6 heures par jour sur 5 jours / 08h à 14H30.Pause-café, cas pratiques, attestation de formation",
            		   learnGroup: "G1-G2-G3-G4-G5-G6-G7-G8-G9-G10",
            		});
            		localStorage.setItem('events', JSON.stringify(events));
            		eventDiv.addEventListener('click', () => openModal(dayString, "08H30 – 12H30","Salle 1"));
            		
            		eventDiv = document.createElement('div');
                    eventDiv.classList.add('event');
            	    eventDiv.innerHTML = "<div style='width:100%' title='Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication'><p style='text-align:center; font-weight:bold; color:red;'>7:00 - 12:00</p> \n\n Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication</div>";
                    daySquare.appendChild(eventDiv);
            	    eventList.push({
            		   date: dayString,
            		   learnTime: "08H30 – 12H30",
            		   learnClass: "Salle 2",
            		   learnText: "PERFECTIONNEMENT BUREAUTIQUE",
            		   learnGoal: "Word, PowerPoint et Excel sont des logiciels utilisés au quotidien dans les entreprises. Pourtant, certaines fonctionnalités conçues pour améliorer l’efficience restent peu ou pas utilisées. Nous proposons des formations très opérationnelles qui couvrent tous les besoins et tous les niveaux de compétences pour être opérationnel en milieu professionnel.Obtenez la Certification internationale ICDL",
            		   learnDesc: "* 30 heures soit 6 heures par jour sur 5 jours / 08h à 14H30.Pause-café, cas pratiques, attestation de formation",
            		   learnGroup: "G1",
            		});
            		localStorage.setItem('events', JSON.stringify(events));
            		eventDiv.addEventListener('click', () => openModal(dayString, "12H30 – 17H00","Salle 2"));
            		
            		events[dayString] = eventList;
            	  }*/

            //daySquare.addEventListener('click', () => openModal(dayString));
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
        load();
    });

    document.getElementById('backButton').addEventListener('click', () => {
        nav--;
        load();
    });

    /*document.getElementById('saveButton').addEventListener('click', saveEvent);
    document.getElementById('cancelButton').addEventListener('click', closeModal);
    document.getElementById('deleteButton').addEventListener('click', deleteEvent);
    document.getElementById('closeButton').addEventListener('click', closeModal);*/
    document.getElementById('exitButton').addEventListener('click', closeModal);
}

function initEvents() {
    /*let dayString = "2022-06-01";

    let eventList = [];

    eventList.push({
        date: dayString,
        title: "<div style='width:100%' title='Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication'><p style='text-align:center; font-weight:bold; color:red;'>7:00 - 12:00</p> \n\n Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication</div>",
        learnTime: "08H30 – 12H30",
        learnClass: "Salle 1",
        learnText: "PERFECTIONNEMENT BUREAUTIQUE",
        learnGoal: "Word, PowerPoint et Excel sont des logiciels utilisés au quotidien dans les entreprises. Pourtant, certaines fonctionnalités conçues pour améliorer l’efficience restent peu ou pas utilisées. Nous proposons des formations très opérationnelles qui couvrent tous les besoins et tous les niveaux de compétences pour être opérationnel en milieu professionnel.Obtenez la Certification internationale ICDL",
        learnDesc: "* 30 heures soit 6 heures par jour sur 5 jours / 08h à 14H30.Pause-café, cas pratiques, attestation de formation",
        learnGroup: "G1-G2-G3-G4-G5-G6-G7-G8-G9-G10",
    });
    localStorage.setItem('events', JSON.stringify(events));

    eventList.push({
        date: dayString,
        title: "<div style='width:100%' title='Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication'><p style='text-align:center; font-weight:bold; color:red;'>7:00 - 12:00</p> \n\n Module 1 : (1513 Personnes)Formation l’Essentiel sur l’ordinateur & sur le web et de la communication</div>",
        learnTime: "08H30 – 12H30",
        learnClass: "Salle 2",
        learnText: "PERFECTIONNEMENT BUREAUTIQUE",
        learnGoal: "Word, PowerPoint et Excel sont des logiciels utilisés au quotidien dans les entreprises. Pourtant, certaines fonctionnalités conçues pour améliorer l’efficience restent peu ou pas utilisées. Nous proposons des formations très opérationnelles qui couvrent tous les besoins et tous les niveaux de compétences pour être opérationnel en milieu professionnel.Obtenez la Certification internationale ICDL",
        learnDesc: "* 30 heures soit 6 heures par jour sur 5 jours / 08h à 14H30.Pause-café, cas pratiques, attestation de formation",
        learnGroup: "G1",
    });
    localStorage.setItem('events', JSON.stringify(events));
*/
    //events[dayString] = eventList;
    events = php_events;
}

initButtons();
initEvents();
load();