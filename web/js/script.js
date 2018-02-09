$(document).ready(function () {

	var timeArrow1;
	var timeCircle;
	var timel;
	var timeap;
	var timeA;
	var timer1;
	var timet1;
	var timei1;
	var times;
	var timet2;
	var timee1;
	var timer2;
	var timei2;
	var timee2;
	var timee2b;
	var timefin;

	function anim() {
		delaiAnim = 50; // Délai d'apparition de chaque lettre en ms
		etape = 0; // Pas touche !!

		$("#pathArrow1").removeClass("normalFill");
		$("#pathArrow2").removeClass("normalFill");
		$("#pathArtisterie").removeClass("normalFill");
		$("#pathCircle").removeClass("normalStroke");
		$("#pathStudios").removeClass("normalFill");

		timeArrow1 = setTimeout(function () {
			$("#pathArrow1").addClass("highlight");
			$("#pathArrow2").addClass("highlight2");
			$("#pathCircle").addClass("highlightStroke");			
		}, delaiAnim * etape++);
		timel = setTimeout(function () {
			$("#pathArtisteriel").addClass("highlight2");
		}, delaiAnim * etape++);
		timeap = setTimeout(function () {
			$("#pathArtisteriel").removeClass("highlight2");
			$("#pathArtisteriel").addClass("highlight");
			$('#pathArtisterieap').addClass("highlight2");
		}, delaiAnim * etape++);
		timeA = setTimeout(function () {
			$("#pathArtisteriel").removeClass("highlight");
			$("#pathArtisterieap").removeClass("highlight2");
			$('#pathArtisterieap').addClass("highlight");
			$('#pathArtisterieA').addClass("highlight2");
		}, delaiAnim * etape++);
		timer1 = setTimeout(function () {
			$("#pathArtisterieap").removeClass("highlight");
			$("#pathArtisterieA").removeClass("highlight2");
			$('#pathArtisterieA').addClass("highlight");
			$('#pathArtisterier1').addClass("highlight2");
		}, delaiAnim * etape++);
		timet1 = setTimeout(function () {
			$('#pathArtisterieA').removeClass("highlight");
			$("#pathArtisterier1").removeClass("highlight2");
			$('#pathArtisterier1').addClass("highlight");
			$('#pathArtisteriet1').addClass("highlight2");
		}, delaiAnim * etape++);
		timei1 = setTimeout(function () {
			$("#pathArtisterier1").removeClass("highlight");
			$("#pathArtisteriet1").removeClass("highlight2");
			$('#pathArtisteriet1').addClass("highlight");
			$('#pathArtisteriei1').addClass("highlight2");
		}, delaiAnim * etape++);
		times = setTimeout(function () {
			$("#pathArtisteriet1").removeClass("highlight");
			$("#pathArtisteriei1").removeClass("highlight2");
			$('#pathArtisteriei1').addClass("highlight");
			$('#pathArtisteries').addClass("highlight2");
		}, delaiAnim * etape++);
		timet2 = setTimeout(function () {
			$("#pathArtisteriei1").removeClass("highlight");
			$("#pathArtisteries").removeClass("highlight2");
			$('#pathArtisteries').addClass("highlight");
			$('#pathArtisteriet2').addClass("highlight2");
		}, delaiAnim * etape++);
		timee1 = setTimeout(function () {
			$("#pathArtisteries").removeClass("highlight");
			$("#pathArtisteriet2").removeClass("highlight2");
			$('#pathArtisteriet2').addClass("highlight");
			$('#pathArtisteriee1').addClass("highlight2");
		}, delaiAnim * etape++);
		timer2 = setTimeout(function () {
			$("#pathArtisteriet2").removeClass("highlight");
			$("#pathArtisteriee1").removeClass("highlight2");
			$('#pathArtisteriee1').addClass("highlight");
			$('#pathArtisterier2').addClass("highlight2");
		}, delaiAnim * etape++);
		timei2 = setTimeout(function () {
			$("#pathArtisteriee1").removeClass("highlight");
			$("#pathArtisterier2").removeClass("highlight2");
			$('#pathArtisterier2').addClass("highlight");
			$('#pathArtisteriei2').addClass("highlight2");
		}, delaiAnim * etape++);
		timee2 = setTimeout(function () {
			$("#pathArtisterier2").removeClass("highlight");
			$("#pathArtisteriei2").removeClass("highlight2");
			$('#pathArtisteriei2').addClass("highlight");
			$('#pathArtisteriee2').addClass("highlight2");
		}, delaiAnim * etape++);
		timee2b = setTimeout(function () {
			$("#pathArtisterier2").removeClass("highlight");
			$("#pathArtisteriei2").removeClass("highlight");
			$('#pathArtisteriee2').removeClass("highlight2");
			$('#pathArtisteriee2').addClass("highlight");
		}, delaiAnim * etape++);
		timefin = setTimeout(function () {
			$("#pathArtisteriee2").removeClass("highlight");
			$("#pathStudios").removeClass("normalFill");
			$('#pathStudios').addClass("highlight2");
			$('#pathArtisterie').addClass("highlight");
		}, delaiAnim * etape++);
	}


	// Animation logo
	$(".logo").mouseenter(function () {
		anim();
	});
	$(".logo").mouseleave(function () {
		clearTimeout(timeArrow1);
		clearTimeout(timel);
		clearTimeout(timeap);
		clearTimeout(timeA);
		clearTimeout(timer1);
		clearTimeout(timet1);
		clearTimeout(timei1);
		clearTimeout(times);
		clearTimeout(timet2);
		clearTimeout(timee1);
		clearTimeout(timer2);
		clearTimeout(timei2);
		clearTimeout(timee2);
		clearTimeout(timee2b);
		clearTimeout(timefin);

		$("#pathArrow1").removeClass("highlight");
		$("#pathArrow2").removeClass("highlight2");
		$("#pathArtisteriel").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisterieap").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisterieA").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisterier1").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteriet1").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteriei1").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteries").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteriet2").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteriee1").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisterier2").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteriei2").removeClass("highlight").removeClass("highlight2");
		$("#pathArtisteriee2").removeClass("highlight").removeClass("highlight2");

		$('#pathArtisterie').removeClass("highlight").removeClass("highlight2");
		$('#pathStudios').removeClass("highlight2");

		$("#pathArrow1").addClass("normalFill");
		$("#pathArrow2").addClass("normalFill");
		$("#pathArtisterie").addClass("normalFill");
		$("#pathStudios").addClass("normalFill");
		$("#pathCircle").addClass("normalStroke");

	});


	// Gestion de l'apparition/disparition du menu sur scroll
	var lastScrollTop = 0;
	$(window).scroll(function (event) {
		var st = $(this).scrollTop();
		if (st > lastScrollTop) {
			// Masquage du menu
			$("#headerMenu").slideUp();
		} else {
			// Affichage du menu
			$("#headerMenu").slideDown();
		}
		lastScrollTop = st;
	});



	// initialisation de paroller.js
	$("[data-paroller-factor]").paroller();

	// Switch des icones sociales en couleur au passage de la souris
	$("#social_1").on({
		"mouseover": function () {
			this.src = '/artisterie/web/img/soundcloud_color.png';
		},
		"mouseout": function () {
			this.src = '/artisterie/web/img/soundcloud_grey.png';
		}
	});

	$("#social_2").on({
		"mouseover": function () {
			this.src = '/artisterie/web/img/youtube_color.png';
		},
		"mouseout": function () {
			this.src = '/artisterie/web/img/youtube_grey.png';
		}
	});

	$("#social_3").on({
		"mouseover": function () {
			this.src = '/artisterie/web/img/fb_color.png';
		},
		"mouseout": function () {
			this.src = '/artisterie/web/img/fb_grey.png';
		}
	});

	// Initialisation de Fancybox (affichage de la galerie) et réglages    
	$("[data-fancybox]").fancybox({
		buttons : [
			'slideShow',
			'fullScreen',
			'share',
			//'download',
			//'zoom',
			'close'
        ]
	});

	if ($(this).is(':checked')){
		$("#rowGroup").hide();
		$("#rowRoom").show();
	}

	// Lors du clic sur la checkbox, on masque le champ groupe et on affiche le champ local
	$("#user_chkbox").click(function(){
		if ($(this).is(':checked')){
			$("#rowGroup").hide();
			$("#rowRoom").show();
		} else {
			$("#rowRoom").hide();
			$("#rowGroup").show();
		}
	});

	// Gestion des pages de la galerie
	$(".imgGallery").each(function(){
		if (( $(this).attr("id") <= 0 ) || ( $(this).attr("id") > 24 )){
			$(this).hide();
		} else {
			$(this).show();
		}
	});
	
	$(".pageGallery").click(function(){
		var currentPage = $(this).attr("data-pagegallery");
		$(".imgGallery").each(function(){
			if (( $(this).attr("id") <= (currentPage-1)*24 ) || ( $(this).attr("id") > currentPage*24 )){
				$(this).hide();
			} else {
				$(this).show();
			}
		});
		
		$(".pageGallery").removeClass("active");
		$(this).addClass("active");
	});

});