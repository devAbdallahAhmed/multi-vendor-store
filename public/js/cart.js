/******/ (() => { // webpackBootstrap
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
(function ($) {
  $('.item-quantity').on('change', function (e) {
    $.ajax({
      url: "/cart/" + $(this).data('id'),
      //data-id
      method: 'put',
      data: {
        quantity: $(this).val(),
        _token: csrf_token
      }
    });
  });
})(jQuery);
(function ($) {
  $('.remove-item').on('click', function (e) {
    $.ajax({
      url: "/cart/" + $(this).data('id'),
      //data-id
      method: 'delete',
      data: {
        _token: csrf_token
      },
      success: function success(response) {
        $("#".concat(id)).remove();
      }
    });
  });
})(jQuery);
/******/ })()
;