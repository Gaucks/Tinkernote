$(document).ready(function(){

    $('.collapse').collapse(); /* fonction de base pour bootsrap */

    $('#username').on("click", function(){
        $('#checkbox-hidden').fadeIn();
        $('#checkbox-hidden').delay(5000).fadeOut('slow');
    });
});

$(document).ready(function(){
    $('#latable').tablesorter();
});

/* Le secteurs pour les Pays / Regions / Departement / Ville */
$(function () {
    jQuery(document).ready(function() {
            console.log('Jquery is ready');

            $(".regionclass").change(function() {
                mafonctionchange('departement','region');
            }).trigger('change');

            $(".departementclass").change(function() {
                mafonctionchange('ville','departement');
            });

            function mafonctionchange(selecteur,selecteurparent)
            {
                $.ajax({
                    url: Routing.generate('site_rempli'),
                    type: 'POST',
                    data:
                    {
                        id : $("select."+selecteurparent+"class option:selected").val(),
                        select : selecteur
                    },
                    dataType: 'json',
                    success: function(reponse) {
                        $('.'+selecteur+'class').empty();
                         if(selecteur == "ville"){ var rel = $('.villeclass').attr('rel'); }
                         if(selecteur == "region"){ var rel = $('.regionclass').attr('rel'); }
                         if(selecteur == "departement"){ var rel = $('.departementclass').attr('rel'); }

                        $.each(reponse, function(index, element) {
                            $('.' + selecteur + 'class').append('<option value="'+element.id+'" '+mafonctionselected(rel, element.id) +'  >'+ element.nom +'</option>');

                        });

                        if (selecteur == 'departement') {
                            mafonctionchange('ville','departement');
                        }
                    },
                    error: function (request) {
                        alert(request.responseText);
                    }
                });
            }

            function mafonctionselected(rel, elementid)
            {
                if(rel == elementid)
                {
                    return "selected='selected'";
                }
                else
                {
                    return '';
                }
            }
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
                    $('.'+selecteur+'class').empty();
                    $.each(reponse, function(index, element) {
                        $('.' + selecteur + 'class').append('<option value="'+element.id+'" selected="selected">'+ element.category +'</option>');

                    });
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
        }

    });
});






