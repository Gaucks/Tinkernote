$(document).ready(function(){

    $('select.parentcategoryclass').on('change', function(){
        if($(this).val() != ""){
            console.log('Categorie modifier');
            $('.categoryclass-form-group').removeClass('hidden');
        }
    });

    $('select.categoryclass').on('change', function(){
        $(this).css('background-color','transparent');
        $('#formulaire_extended').fadeIn('slow');

        if($(this).val() == ''){
            $('.categoryclass').css('background-color','#eee');
            $('#formulaire_extended').fadeOut('slow');
        }
    });

    /* l'ajout d'annonce */

    $('#show_localisation').on('click', function(){
       $('#formulaire_localisation').fadeIn('slow');
    });

});

/* Les selecteurs pour les categories et sous categorie des annonces */
$(function (){
    jQuery(document).ready(function(){
        console.log('Jquery à chargé les catégories');

        $(".parentcategoryclass").change(function() {
            changecategory('category','parentcategory');
        }).trigger('change');

        function changecategory(selecteur,selecteurparent)
        {
            $.ajax({
                url: Routing.generate('site_rempli_category'),
                type: 'POST',
                data:
                {
                    id : $("select."+selecteurparent+"class option:selected").val(),
                    select : selecteur
                },
                dataType: 'json',
                success: function(reponse) {

                    var styles = {
                        backgroundColor : "#fff",
                        fontStyle: "italic",
                        padding: '5px 0 5px 10px',
                        cursor: 'pointer'
                    };
                    var total = reponse.length; // Nombre de résultats ; permet d'afficher le tableau des sous-catégories avec le nombre precis de résultats

                    $('.categoryclass').attr({'disabled': false, 'size': total }).css(styles);
                    $('.'+selecteur+'class').empty();
                    //$('.' + selecteur + 'class').append('<option value="" selected="selected">Votre choix</option>');
                    $.each(reponse, function(index, element) {
                        $('.' + selecteur + 'class').append('<option value="'+element.id+'"">'+ element.category +'</option>');

                    });

                }//,
                //error: function (request) {
                //  alert(request.responseText);
                // }
            });
        }

    });
});