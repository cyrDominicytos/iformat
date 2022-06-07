function getLocation(name) {
    var location = calendar.schedule.locations.where(function(item) {

        return (item.name === name)
    }).items()[0];

    // create a new location object and add it to the schedule's location collection
    if (!location) {
        location = new p.Location();
        location.name = name;
        calendar.schedule.locations.add(location);
    }
    return location;
}

var p = MindFusion.Scheduling;

//create a new calendar instance
var calendar = new p.Calendar(document.getElementById("calendar"));

calendar.theme = "peach";
var date = p.DateTime.today();
//initialized
// add some items to the schedule items collection
for (var i = 0; i < 15; i++) {
    item = new p.Item();
    item.startTime = p.DateTime.addMinutes(date, 2);
    item.endTime = p.DateTime.addHours(item.startTime, 2);
    item.subject = "08h-12H";


    // add a custom css class to some items
    if (i % 5 == 0) {
        item.cssClass = "myItemClass";
        item.details = "Formation l’Essentiel sur l’ordinateur & sur le web et de la communication";
    }
    calendar.schedule.items.add(item);
}




/*var date = p.DateTime.today();
// create a new item
var item = new p.Item();
item.subject = "Birthday Celebration";
item.startTime = date;
item.endTime = p.DateTime.addDays(date.clone(), 1);
item.allDayEvent = true;
item.location = getLocation(item.subject);
//End initialized

var task;
// create a task
task = new p.Task();
task.subject = "Math Test";
task.dueDate = p.DateTime.today().addDays(10);
task.details = "Learn well Molecular Biology by M. Robertson";
//the exam would probably take a total of up to 5 hours
task.estimatedDuration = 300;
task.priority = p.TaskPriority.High;
//add it to the schedule.tasks collection
calendar.schedule.tasks.add(task);*/


calendar.selectionEnd.addEventListener(handleSelection);
calendar.headerClick.addEventListener(handleHeaderClick);

//visualize the calendar
calendar.render();

function handleHeaderClick(sender, args) {
    if (sender.currentView === p.CalendarView.Timetable) {
        sender.date = sender.timetableSettings.dates.items()[0];
        sender.currentView = p.CalendarView.SingleMonth;
    }
}

function handleSelection(sender, args) {
    if (sender.currentView === p.CalendarView.SingleMonth) {
        //cancel the default behavior
        args.cancel = true;

        var start = args.startTime;
        var end = args.endTime;

        //clear all dates from the timetable
        sender.timetableSettings.dates.clear();

        while (start < end) {
            sender.timetableSettings.dates.add(start);
            start = p.DateTime.addDays(start, 1);

        }

        sender.currentView = p.CalendarView.Timetable;
    }


}