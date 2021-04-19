//Aloha Bar Script by Melissa Cabral

//WP runs jquery in noconflict mode - $ is undefined
jQuery(document).ready(function( $ ){
	// $ is defined here
	//add a dismiss button
	$("<span class='howdy-dismiss'>&times;</span>").appendTo("#mmc-howdy-bar");

	//click event
	$("#mmc-howdy-bar").on( 'click', '.howdy-dismiss', function(){
		//hide the bar
		$("#mmc-howdy-bar").fadeOut();
	} );
});