var uploader = new plupload.Uploader({
    runtimes: 'html5,flash',
    containes: 'plupload',
    browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
    drop_element:"droparea",
    url: 'http://localhost/Tinkernote/web/app_dev.php/upload-file',
    multipart: true,
    urlstream_upload:true,
    multipart_params:{directory:'http://localhost/Tinkernote/web/test'},
    max_file_size: '5mb',
    filters: {
        mime_types: [
            { title: 'Images files', extensions: 'jpg,png,jpeg,gif' },
            { title: 'Zip files',    extensions: 'zip' }
        ]
    }
});

uploader.init();

// Le fichier est ajouté
uploader.bind('FilesAdded',function(up,files){
    var filelist =$('#fieldset');
    for(var i in files){
        var file = files[i];
        filelist.prepend('<div id="'+file.id+'" class="file">'+file.name+'('+plupload.formatSize(file.size)+')'+'<div class="progressbar"><div class="progress"></div></div></div>');
    }
    $('#droparea').removeClass('hover');
});

// Le fichier est en cours d'envoie
uploader.bind('UploadProgress',function(up,file){
    $('#'+file.id).find('.progress').css('width', file.percent+'%');
});

// Le fichier est envoyé
uploader.bind('FileUploaded', function(up, file, response){
    data = $.parseJSON(response.response);
    if(data.error){
        alert(data.message);
        $('#'+file.id).remove();
    }
});

uploader.bind('Error', function(up, err){
    alert(err.message)
    $('#droparea').removeClass('hover');
    uploader.refresh();
});

// On click sur star upload
document.getElementById('start-upload').onclick = function() {
    uploader.start();
};


jQuery(function($){

    $('#droparea').bind({
        dragover: function(e){
            $(this).addClass('hover');
        },
        dragleave: function(e){
            $(this).removeClass('hover');
        }
    });
});