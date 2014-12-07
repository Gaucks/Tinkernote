$(document).ready(function(){

    $('.collapse').collapse(); /* fonction de base pour bootsrap */
    $('#latable').tablesorter();

    $('#username').on("click", function(){
        $('#checkbox-hidden').fadeIn();
        $('#checkbox-hidden').delay(5000).fadeOut('slow');
    });

    var relVilleId = $('#tinkernote_sitebundle_annonce_ville').attr('rel');
    $('#tinkernote_sitebundle_annonce_ville option[value='+relVilleId+']').attr("selected", "selected");

    $('#fos_user_profile_form_postal, #tinkernote_sitebundle_annonce_postal, #fos_user_registration_form_postal').on("keyup", function(){

        var currlength = $(this).val().length;

        if(currlength >= 2){
            $('img.ajax-loader').show();
        }

        if(currlength >= 2)
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

                        $('.ville').append($("<option></option>")
                                    .attr('value', value.id)
                                    .text(value.postal+' - '+value.nom)
                        );

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

    $('#btn-add-pic-two, #btn-add-pic-three, #btn-add-pic-four').addClass('disabled btn-warning');

    /* Afficher les images en prévisualisation */

    function readURL(input, inputrel, parent) {
        if (input.files && input.files[0]) {
            var rel = '#blah'+inputrel;
            var reader = new FileReader();
            var hideDiv = '#pic'+inputrel;

            var btn1 = 'btn-add-pic-one';
            var btn2 = 'btn-add-pic-two';
            var btn3 = 'btn-add-pic-three';

            reader.onload = function (e) {
                $(hideDiv).hide();
                $(rel).removeClass('hidden').attr('src', e.target.result);

                if(parent == btn1 ){
                    $('#btn-add-pic-two').removeClass('disabled btn-warning');
                }

                if(parent == btn2 ){
                    $('#btn-add-pic-three').removeClass('disabled btn-warning');
                }

                if(parent == btn3 ){
                    $('#btn-add-pic-four').removeClass('disabled btn-warning');
                }

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#tinkernote_sitebundle_annonce_picture_file, #tinkernote_sitebundle_annonce_picturetwo_file, #tinkernote_sitebundle_annonce_picturethree_file, #tinkernote_sitebundle_annonce_picturefour_file ").change(function(){
        readURL(this, $(this).parent().parent().attr('rel'), $(this).parent().parent().parent().attr('id'));
    });

    /* La partie modal box*/
    $('#modal-btn-write-message').on('click', function(){
        $('#contactByMessageForm').show();
    });

    /* La partie pour les message flashbag */
    $('.flash-notice').each(function(){
        $(this).css('top', 65 * $(this).index() + 'px');
        $(this).animate({'left': '0px' });
        $(this).delay(6000).animate({'left': '-350px' });
    });

    $('.flash-notice').click(function(){
       $(this).hide();
    });
    /////////////////////////////////////////

    /* La partie what'up */
    $('.box-whatsUp textarea').on("keyup", function () {
        $(this).css({height: '100px', 'border-radius': '4px'});
        $('.box-whatsUp-sub').show();
    });

});
