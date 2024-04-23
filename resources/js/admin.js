window.jQuery = window.$ = require('jquery');
require('bootstrap');
require('trumbowyg');
require('@fortawesome/fontawesome-free/js/all');
require('datatables.net-bs4');

// Custom Functions
$(function () {
    $('.toast').toast('show');

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?!')) {
            $(this).closest('form').submit();
        }
    });

    //  Trumbowyg editor
    $('.editor').trumbowyg({
        svgPath: route('home') + '/node_modules/trumbowyg/dist/ui/icons.svg'
    });

    // Function to handle image preview
    function handleImagePreview(input) {
        let files = input.files;
        let containerId = $(input).data('preview');
        let html = '';

        for (let file of files) {
            html += `<div class="col-4">
                        <img class="img-fluid" src="${URL.createObjectURL(file)}" />   
                    </div>`;
        }

        $(containerId).html(html);
    }

    // Function to display existing image if available
    function displayExistingImage(imageUrl, containerId) {
        if (imageUrl) {
            let html = `<div class="col-4">
                            <img class="img-fluid" src="${route('home') + imageUrl}" />   
                        </div>`;
            $(containerId).html(html);
        }
    }

    // Attach change event to all image inputs
    $('input[type="file"][data-preview]').change(function(e) {
        handleImagePreview(this);
    });

    // Display existing images
    $('[data-preview]').each(function() {
        let imageUrl = $(this).data('existing');
        let containerId = $(this).data('preview');
        displayExistingImage(imageUrl, containerId);
    });
});
