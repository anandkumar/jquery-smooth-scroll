jQuery(document).ready(function($){
    var mediaUploader;

    $('#upload_image_button').click(function(e) {
        e.preventDefault();
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#jss_scroll_to_top_image').val(attachment.url);
            $('#jss_image_preview').attr('src', attachment.url).show();
            $('#remove_image_button').show();
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

    $('#remove_image_button').click(function(e){
        e.preventDefault();
        $('#jss_scroll_to_top_image').val('');
        $('#jss_image_preview').hide();
        $(this).hide();
    });
});
