<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFORMAT: Planning des formations</title>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/planning_calendar/style.css') }}">
  </head>
  <body>
    
    <div id="container">
      <div id="header">
        <div id="monthDisplay"></div>
        <div id="calendarTitle">Formations plannifiées</div>
		
        <div>
		 
          <button id="appBackButton" onclick="history.back()">Retour</button>
          <button id="backButton">Précédent</button>
          <button id="nextButton">Suivant</button>
        </div>
      </div>

      <div id="weekdays">
        <div>Dim</div>
        <div>Lun</div>
        <div>Mar</div>
        <div>Mer</div>
        <div>Jeu</div>
        <div>Ven</div>
        <div>Sam</div>
      </div>

      <div id="calendar">
	  </div>
    </div>

    <div id="newEventModal">
      <h2>New Event</h2>

      <input id="eventTitleInput" placeholder="Event Title" />

      <button id="saveButton">Save</button>
      <button id="cancelButton">Cancel</button>
    </div>

    <div id="deleteEventModal">
      <h2>Event</h2>

      <p id="eventText"></p>

      <button id="deleteButton">Delete</button>
      <button id="closeButton">Close</button>
    </div>
	
	 <div id="showEventModal">
   <p>
		  <strong>Titre: </strong>
		  <span id="learnText"></span>
	  </p>
	  <p>
		  <strong>Objectif: </strong>
		  <span id="learnGoal"></span>
	  </p>
   <p>
		  <strong>Heures: </strong>
		  <span id="learnTime"></span>
	  </p>
	  
	  <p>
		  <strong>Groupes: </strong>
		  <span id="learnGroup"></span>
	  </p> 
	  <p>
		  <strong>Site: </strong>
		  <span id="learnClass"></span>
	  </p>
	  
	  <p>
		  <strong>Infos :</strong>
		  <span id="learnDesc"></span>
	  </p>

      <button id="exitButton">Fermer</button>
    </div>  

    <div id="modalBackDrop"></div>

    <script src="{{ asset('assets/jquery/jquery-3.6.0.min.js') }}"></script>
    <script>
      var php_events = <?php echo  isset($events) ? json_encode($events) : [] ?>;
      var switch_events_route = "<?=route('listPlannings.get_events_plannings') ?>";
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    </script>
    <script src="{{ asset('assets/planning_calendar/script.js') }}"></script>

  </body>
</html>
