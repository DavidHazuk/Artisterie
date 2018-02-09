$(document).ready(function () {
	// La page est chargée, on peut entrer notre code

	////////////////////////////////////////////////////
	// Gestion de la check box sur le formulaire Membre
	////////////////////////////////////////////////////
	if ($("#user_chkbox").is(":checked")) {
		// Utilisateur individuel, le local est obligatoire
		$("#user_room").prop('required',true);
		$("#user_group").prop('required',false);
	} else {
		// Utilisateur en groupe, le groupe est obligatoire
		$("#user_room").prop('required',false);
		$("#user_group").prop('required',true);
	}

	// Gestion des required en fonction du type d'utilisateur
	$("#user_chkbox").click(function(){
		if ($(this).is(":checked")) {
			// Utilisateur individuel, le local est obligatoire
			$("#user_room").prop('required',true);
			$("#user_group").prop('required',false);
		} else {
			// Utilisateur en groupe, le groupe est obligatoire
			$("#user_room").prop('required',false);
			$("#user_group").prop('required',true);
		}
	});

	////////////////////////////////////////////////////
	// Gestion de la suppression par drop
	////////////////////////////////////////////////////
	// Initialisation de la structure pour position de la souris
	var currentMousePos = {
		x: -1,
		y: -1
	};

	// Récupération de la position de la souris
	$(document).on("mousemove", function (event) {
		currentMousePos.x = event.pageX;
		currentMousePos.y = event.pageY;
	});

	// Fonction qui indique si la souris est dans l'élément
	function isElemOverDiv() {
		var elementHTML = jQuery('#calendar');
		// Calcul des tailles de l'élément surveillé
		var ofs = elementHTML.offset();
		var x1 = ofs.left;
		var x2 = ofs.left + elementHTML.outerWidth(true);
		var y1 = ofs.top;
		var y2 = ofs.top + elementHTML.outerHeight(true);
//		console.log("x1 " + x1 + " x2 " + x2 + " y1 " + y1 + " y2 " + y2);
//		console.log("mousex " + currentMousePos.x + " mousey " + currentMousePos.y);
		if (currentMousePos.x < x1 || currentMousePos.x > x2 || currentMousePos.y < y1 || currentMousePos.y > y2) {
//			console.log("true");
			return true;
		}
//		console.log("false");
		return false;
	}


	////////////////////////////////////////////////////
	// Lors de la fermeture de la fenêtre modale, rafraichissement de la page
	////////////////////////////////////////////////////
	$('#fullCalModal').on('hide.bs.modal', function (e) {
		location.reload();
	})

	////////////////////////////////////////////////////
	// Fonction qui gère le submit du form d'ajout/modification d'évènement
	////////////////////////////////////////////////////
	$(document).on('submit', '#formEvent', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: $(this).attr('action'),
			data: $(this).serialize(), // sérialisation du formulaire
			success: function (response)
			{
				if (response === 'valid') {
					// Fermeture de la modale
					$("#btnClose").click();
				} else {
					// Erreur, récupération de la réponse sous forme HTML
					// pour affichage du message d'erreur
					$('#modalContent').html(response);
				}
			}
		})
//		.done(function(){
//			alert('ok');
//		})
//		.fail(function(){
//			alert('erreur appel ajax');
//		})
				;
	}
	);

	////////////////////////////////////////////////////
	// Pour afficher le calendrier
	////////////////////////////////////////////////////
	$('#calendar').fullCalendar({
		// Choix des boutons affichés au dessus du planning
		header: {
			left: 'today',
			center: 'title',
			right: 'month,agendaWeek  prev,next'
		},
		// Créneaux d'1h seulement
		slotDuration: '01:00:00',
		// Choix de la vue affichée par défaut
		defaultView: 'month',
		height: 500,
		// Zone temporelle
		timezone: ('Europe/Paris'),
		locale: 'fr',
		// Heures d'ouverture
		businessHours: {
			start: '18:00',
			end: '23:00',
			dow: [1, 2, 3, 4, 5, 6, 7]
		},
		// Désactivation des évènements sur une journée entière
		allDayDefault: false,
		// Les évènements sont modifiables et "bougeables"
		editable: true,
		droppable: true,
		// Source des évènements
		events: 'http://localhost/artisterie/web/api/events',
		// Affichage des évènements
		eventRender: function (event, element) {
			// Changement de la couleur de fond en fonction du room concerné
			element.css({"background-color": event.txtRoomColor});

			// Modification du texte du titre de l'évènemnt
			element.find('.fc-title').append("<br>Dans " + event.txtRoomName + '<br>Par ' + event.txtGroupName);
		},
		// Gestion du clic sur un évènement (pour modification)
		eventClick: function (event, jsEvent, view) {
			if (event.editable) {
				// Si l'évènement concerne mon groupe
				startHour = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
				endHour = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
				day = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD");
				// Appel ajax pour récupérer le formulaire d'édition de l'event
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: 'http://localhost/artisterie/web/admin/event/' + event.id + '/edit',
					data: 'day=' + day + '&startHour=' + startHour + '&endHour=' + endHour,
					success: function (response)
					{
						// Récupération de la réponse sous forme HTML
						$('#modalContent').html(response);
					}
				});
				// Affichage de la modale avec le contenu HTML récupéré
				$('#fullCalModal').modal();
			}
		},

		// Gestion de la sélection
		selectable: true,
		selectHelper: true,
		select: function (start, end, allDay) {
			// Appel ajax pour récupérer le formulaire d'ajout de l'event
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'http://localhost/artisterie/web/admin/event/add',
				data: 'day=' + $.fullCalendar.formatDate(start, "YYYY-MM-DD"),
				success: function (response)
				{
					// Récupération de la réponse sous forme HTML
					$('#modalContent').html(response);
				}
			});
			// Affichage de la modale avec le contenu HTML récupéré
			$('#fullCalModal').modal();
		},
		eventDragStop: function (event, jsEvent, ui, view) {
			if (isElemOverDiv()) {
				var con = confirm('Souhaitez-vous vraiment supprimer cet évènement ?');
				if (con == true) {
					// Appel ajax pour récupérer le formulaire d'édition de l'event
					$.ajax({
						type: 'POST',
						dataType: 'html',
						url: 'http://localhost/artisterie/web/admin/event/' + event.id + '/delete',
						success: function (response)
						{
							$('#calendar').fullCalendar('refetchEvents');
						}
					});
				}
			}
		},
		// Lors du déplacement d'un évènement
		eventDrop: function (event, delta) {
			startHour = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
			endHour = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
			day = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD");
			// Appel ajax pour récupérer le formulaire d'édition de l'event
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'http://localhost/artisterie/web/admin/event/' + event.id + '/edit',
				data: 'day=' + day + '&startHour=' + startHour + '&endHour=' + endHour,
				success: function (response)
				{
					// Récupération de la réponse sous forme HTML
					$('#modalContent').html(response);
					$('#event_day').val(day);
				}
			});
			// Affichage de la modale avec le contenu HTML récupéré
			$('#fullCalModal').modal();
		},
		// Lors du redimensionnement d'un évènement
		eventResize: function (event) {
			startHour = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
			endHour = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
			day = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD");
			// Appel ajax pour récupérer le formulaire d'édition de l'event
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'http://localhost/artisterie/web/admin/event/' + event.id + '/edit',
				data: 'day=' + day + '&startHour=' + startHour + '&endHour=' + endHour,
				success: function (response)
				{
					// Récupération de la réponse sous forme HTML
					$('#modalContent').html(response);
					$('#event_day').val(day);
				}
			});
			// Affichage de la modale avec le contenu HTML récupéré
			$('#fullCalModal').modal();
		}
	});

	// Initialisation des color picker
	$(".color").colorPicker(/* optinal options */);

});