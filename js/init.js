(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space





$(document).ready(function() {
    $('select').material_select();
  });

$(document).ready(function() {
    Materialize.updateTextFields();
  });
$(document).ready(function(){
    $('ul.tabs').tabs();
  });
$(document).ready(function(){
    $('ul.tabs').tabs('select_tab', 'tab_id');
  });


(function($){
  $(function(){

    /*$('.button-collapse').sideNav();
    $('.parallax').parallax();
	$('.scrollspy').scrollSpy();*/
	


    


    
	$('.slider').slider({full_width: true});
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({'edge': 'left'});
    $('.datepicker').pickadate({selectYears: 20});
    $('select').not('.disabled').material_select();

  }); // end of document ready
})(jQuery); // end of jQuery name space


