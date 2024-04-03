window.jQuery = window.$ = require('jquery')
require('bootstrap');
require('trumbowyg');
require('@fortawesome/fontawesome-free/js/all');
require('datatables.net-bs4');

//Custom Functions
$(function () {

    $('.toast').toast('show');

    $('.delete').click(function(e) {
       e.preventDefault();
       if(confirm('Are you sure you want to delete this item?!')) {
            $(this).parent().submit();
       } 
    });
    
});