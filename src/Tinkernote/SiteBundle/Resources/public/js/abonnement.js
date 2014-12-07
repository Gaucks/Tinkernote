$(document).ready(function() {

// Ajouter et retirer un abonnement dans la partie board

    $('.btn-board-add-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        addBoardAbonnement(rel, $(this));

    });
    $('.btn-board-remove-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        removeBoardAbonnement(rel, $(this));

    });

    function addBoardAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_add_followed', {followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.addClass('btn-blue');
            },
            success: function () {
                button.parent().slideUp();
            },
            error: function () {
                console.log('Y\'a une erreur lors de de l\'ajout d\'abonnement...');
            }

        });
    }

    function removeBoardAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_remove_followed', {followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.addClass('btn-blue');
            },
            success: function () {
                button.parent().parent().parent().parent().parent().slideUp();
            },
            error: function () {
                console.log('Y\'a une erreur lors de de la suppression d\'abonnement...');
            }

        });
    }

// Ajouter et retirer un abonnement dans la partie annonce

    $('.btn-annonce-add-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        addAnnonceAbonnement(rel, $(this));

    });
    $('.btn-annonce-remove-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        removeAnnonceAbonnement(rel, $(this));

    });

    function addAnnonceAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_add_followed', {followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.removeClass('btn-blue').addClass('btn-warning').html('<i class="fa fa-refresh"></i> ........');
            },
            success: function () {
                button.removeClass('btn-annonce-add-abonnement').addClass('btn-annonce-remove-abonnement')
                      .html('<i class="fa fa-eraser"></i> Se désabonner');
            },
            error: function () {
                console.log('Y\'a une erreur lors de de l\'ajout d\'abonnement...');
            }

        });
    }

    function removeAnnonceAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_remove_followed', {followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.html('<i class="fa fa-refresh"></i> ........');
            },
            success: function () {
                button.removeClass('btn-annonce-remove-abonnement').addClass('btn-annonce-add-abonnement').html('<i class="fa fa-bookmark"></i> S\'abonner');
            },
            error: function () {
                console.log('Y\'a une erreur lors de de la suppression d\'abonnement...');
            }

        });
    }


});