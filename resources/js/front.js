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
        
    });

    // For Categories secction
    $(document).ready(function() 
    {
        // Form submission
        $('#filterForm').on('submit', function(e) 
        {
            e.preventDefault();
            // Serialize form data
            var formData = $(this).serialize();
            // Get the current AJAX URL of the DataTable
            var dataTable = $('#category-table').DataTable();
            var ajaxUrl = dataTable.ajax.url();
            var newUrl;
            if (ajaxUrl.includes('?')) {
                newUrl = ajaxUrl + '&' + formData;
            } else {
                newUrl = ajaxUrl + '?' + formData;
            }
            dataTable.ajax.url(newUrl).load();
        });
    });

    function resetForm() 
    {
        $('input[name="status"]').prop('checked', false);
        $('input[name="type"]').prop('checked', false);
        window.location.reload();
    }