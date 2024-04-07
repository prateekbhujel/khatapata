window.jQuery = window.$ = require('jquery')
require('bootstrap');
require('trumbowyg');
require('@fortawesome/fontawesome-free/js/all');
require('datatables.net-bs4');

//Custom Functions
$(function () {

    $('.toast').toast('show');
    
    // Event delegation for delete buttons
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?!')) {
            $(this).closest('form').submit();
        }
    });
    
    $('.editor').trumbowyg({
        svgPath: route('home') + '/node_modules/trumbowyg/dist/ui/icons.svg'
    });
});