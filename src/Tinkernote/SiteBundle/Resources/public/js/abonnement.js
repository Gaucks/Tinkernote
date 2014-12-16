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
            url: Routing.generate('board_add_followed', { followed: rel}),
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

// Ajouter et retirer un abonnement dans la partie annonce sur les régions

    $('.btn-region-add-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        addRegionAbonnement(rel, $(this));

    });
    $('.btn-region-remove-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        removeRegionAbonnement(rel, $(this));

    });

    function addRegionAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_add_region_followed', {followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.removeClass('btn-blue').addClass('btn-warning').html('<i class="fa fa-refresh"></i> ........');
            },
            success: function () {
                button.removeClass('btn-region-add-abonnement').addClass('btn-remove-region-abonnement')
                    .html(' <span class="glyphicon glyphicon-flag"></span> Se désabonner');
            },
            error: function () {
                console.log('Y\'a une erreur lors de de l\'ajout d\'abonnement...');
            }

        });
    }

    function removeRegionAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_remove_region_followed', {followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.html('<i class="fa fa-refresh"></i> ........');
            },
            success: function () {
                button.removeClass('btn-region-remove-abonnement').addClass('btn-region-add-abonnement').html(' <span class="glyphicon glyphicon-flag"></span> S\'abonner');
            },
            error: function () {
                console.log('Y\'a une erreur lors de de la suppression d\'abonnement...');
            }

        });
    }


// Ajouter un abonnement dans la partie annonce pour les propositions d'utilisateur


    $('.btn-annonce-propose-add-abonnement').on('click', function () {

        var rel = $(this).attr('rel');

        addAnnonceProposeAbonnement(rel, $(this));

    });

    function addAnnonceProposeAbonnement(rel, button) {

        $.ajax({
            url: Routing.generate('board_add_followed', { followed: rel}),
            type: 'get',
            beforeSend: function () {
                button.html('<i class="fa fa-refresh"></i> Abonnement en cours... ');
            },
            success: function () {
                button.slideUp();
            },
            error: function () {
                console.log('Y\'a une erreur lors de de l\'ajout d\'abonnement...');
            }

        });
    }

});