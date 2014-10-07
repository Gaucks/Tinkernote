$(document).ready(function(){

    $('.collapse').collapse(); /* fonction de base pour bootsrap */

    $('#username').on("click", function(){
        $('#checkbox-hidden').fadeIn();
    });


    /* Fonction pour le popup de la wish list */
    $('#wish-list-add').on("click", function(){
       $('.notification').animate({ 'right' : '0px'});
       $('.notification').delay(5000).animate({'right': '-300px'});
    });

    $('#latable').tablesorter();

});



