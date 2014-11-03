$(document).ready(function(){

    $('.collapse').collapse(); /* fonction de base pour bootsrap */
    $('#latable').tablesorter();

    $('#username').on("click", function(){
        $('#checkbox-hidden').fadeIn();
        $('#checkbox-hidden').delay(5000).fadeOut('slow');
    });

    $('#fos_user_profile_form_postal, #tinkernote_sitebundle_annonce_postal').on("keyup", function(){

        var currlength = $(this).val().length;

        if(currlength >= 2){
            $('img.ajax-loader').show();
        }

        if(currlength === 5)
        {
            $.ajax({
                url: Routing.generate('site_rempli_postal',{cp: $(this).val()}),
                type: 'get',
                beforeSend: function() {
                    console.log('BeforeSend en cours...');
                },
                success: function(data){
                    $('img.ajax-loader').hide();
                    $('.ville').empty();
                    $.each(data.villepostal, function(index, value) {
                        if(value.id == ''){
                            $(".ville, .postal").css({'background-color':'#FDE4E1',
                                                      'border':'1px solid #FBD3C6',
                                                      'color': '#B10009'}); // Couleur à modifier rouge clair pas trop agressif
                        }
                        else{
                            $(".ville, .postal").css({'background-color':'#FFFFFF',
                                'border':'1px solid #ccc',
                                'color': '#858585'});
                        }
                        $('.ville').append($('<option>', { value: value.id , text: value.nom }));
                    });
                },
                error: function(request){
                    console.log('Il y a une erreur...');
                    alert(request.responseText);
                }
            });
        }
        else{
            $('.villepostal').val('');
        }

    });

    var relVilleId = $('#tinkernote_sitebundle_annonce_ville').attr('rel');
    $('#tinkernote_sitebundle_annonce_ville option[value='+relVilleId+']').attr("selected", "selected");

});




/* Le secteurs pour les Pays / Regions / Departement / Ville */
$(function () {
    jQuery(document).ready(function() {
            console.log('Jquery is ready for City');

            $(".regionclass").change(function() {
                mafonctionchange('departement','region');
            }).trigger('change');

           /* $(".departementclass").change(function() {
                mafonctionchange('ville','departement');
            });
*/
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
                        $('#fos_user_profile_form_postal').val('');
                         //if(selecteur == "ville"){ var rel = $('.villeclass').attr('rel'); }
                         if(selecteur == "region"){ var rel = $('.regionclass').attr('rel'); }
                         //if(selecteur == "departement"){ var rel = $('.departementclass').attr('rel'); }

                        $.each(reponse, function(index, element) {
                            $('.' + selecteur + 'class').append('<option value="'+element.id+'" '+mafonctionselected(rel, element.id) +'  >'+ element.nom +'</option>');

                        });

                       /* if (selecteur == 'departement') {
                            mafonctionchange('ville','departement');
                        }*/
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