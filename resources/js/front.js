window.jQuery = window.$ = require('jquery');
require('bootstrap');
require('trumbowyg');
require('@fortawesome/fontawesome-free/js/all');
require('datatables.net-bs4');

$(function () {
    initializeToasts();
    handleDeleteButtons();
    handleImageUpload('#images', '#img-container');
    handleImageDeletion('.img-delete-income', 'user.income.delete');
    handleImageDeletion('.img-delete-expense', 'user.expense.delete');
});

function initializeToasts() {
    $('.toast').toast('show');
}

function handleDeleteButtons() {
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?!')) {
            $(this).closest('form').submit();
        }
    });
}

function handleImageUpload(inputSelector, containerSelector) {
    $(inputSelector).change(function(e) {
        let files = e.target.files;
        let html = '';

        for (let file of files) {
            html += `<div class="col-4">
                        <img class="img-fluid" src="${URL.createObjectURL(file)}" />   
                    </div>`;
        }

        $(containerSelector).html(html);
    });
}

function handleImageDeletion(selector, routeName) {
    $(document).on('click', selector, function(e) {
        e.preventDefault();

        if (confirm("Are you sure you want to delete this image?")) {
            let id = $(this).data('id');
            let file = $(this).data('file');
            let csrf_token = $("meta[name='csrf_token']").attr('content');
            let msg = '';
            let img_col = $(this).parents('.col-4').first();

            $.ajax({
                url: route(routeName, [id, file]),
                method: 'delete',
                data: {
                    _token: csrf_token
                }
            }).done(function(resp){
                img_col.remove();
                msg = `<div class="toast align-items-center text-bg-success border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${resp.success}
                                </div>
                                <button type="button" class="btn-close-white me-2 auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                      </div>`;
            }).fail(function(resp){
                msg = `<div class="toast align-items-center text-bg-danger border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
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
}
