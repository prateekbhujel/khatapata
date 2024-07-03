window.jQuery = window.$ = require('jquery');
require('bootstrap');
require('trumbowyg');
require('@fortawesome/fontawesome-free/js/all');
require('datatables.net-bs4');

$(function () {
    $('.toast').toast('show');
    
    // Event delegation for delete buttons
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?!')) {
            $(this).closest('form').submit();
        }
    });

    // // For Categories section
    // $(document).ready(function() {
    //     // Form submission
    //     $('#filterForm').on('submit', function(e) {
    //         e.preventDefault();
    //         // Serialize form data
    //         var formData = $(this).serialize();
    //         // Get the current AJAX URL of the DataTable
    //         var dataTable = $('#category-table').DataTable();
    //         var ajaxUrl = dataTable.ajax.url();
    //         var newUrl;
    //         if (ajaxUrl.includes('?')) {
    //             newUrl = ajaxUrl + '&' + formData;
    //         } else {
    //             newUrl = ajaxUrl + '?' + formData;
    //         }
    //         dataTable.ajax.url(newUrl).load();
    //     });
    // });

    // function resetForm() {
    //     $('input[name="status"]').prop('checked', false);
    //     $('input[name="type"]').prop('checked', false);
    //     window.location.reload();
    // }

    // For Receipts Images
    $('#images').change(function(e) {
        let files = e.target.files;
        let html = '';

        for (let file of files) {
            html += `<div class="col-4">
                        <img class="img-fluid" src="${URL.createObjectURL(file)}" />   
                    </div>`;
        }

        $('#img-container').html(html);
    });

    $(document).on('click', '.img-delete', function(e) {
        e.preventDefault();

        if (confirm("Are you Sure you want to delete this image?")) {
            let id = $(this).data('id');
            let file = $(this).data('file');
            let csrf_token = $("meta[name='csrf_token']").attr('content');
            let msg = '';
            let img_col = $(this).parents('.col-4').first();

            $.ajax({
                // url: route('user.income.image', [id, file]),
                method: 'delete',
                data: {
                    _token: csrf_token
                }
            }).done(function(resp){
                img_col.remove();
                msg = `<div class="toast align-items-center text-bg-success border-0 mt-3" role="alert" aria-live="assertive" araia-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${resp.success}
                                </div>
                                <button type="button" class="btn-close-white me-2 auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                      </div>`;
            }).fail(function(resp){
                msg = `<div class="toast align-items-center text-bg-danger border-0 mt-3" role="alert" aria-live="assertive" araia-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${JSON.parse(resp.responseText).error}
                                </div>
                                <button type="button" class="btn-close-white me-2 auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>`;
            }).always(function() {
                $('#toast-container').html(msg);
                $('.toast').toast('show');
            });
        }
    });
});
