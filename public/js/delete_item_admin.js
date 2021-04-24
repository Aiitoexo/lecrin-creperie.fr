/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/delete_item_admin.js ***!
  \*******************************************/
var button_delete = document.querySelectorAll('.delete_item');
var modals_items = document.querySelectorAll('.modal_item');
var button_cancel = document.querySelectorAll('.cancel_modal');

var _loop = function _loop(i) {
  button_delete[i].addEventListener('click', function () {
    modals_items[i].classList.remove('hidden');
  });
};

for (var i = 0; i < button_delete.length; i++) {
  _loop(i);
}

var _loop2 = function _loop2(j) {
  button_cancel[j].addEventListener('click', function () {
    modals_items[j].classList.add('hidden');
  });
};

for (var j = 0; j < button_delete.length; j++) {
  _loop2(j);
}

var all_button_details = document.querySelectorAll('.button_details');
var all_details = document.querySelectorAll('.details');

var _loop3 = function _loop3(_i) {
  all_button_details[_i].addEventListener('click', function () {
    all_details[_i].classList.toggle('hidden');
  });
};

for (var _i = 0; _i < all_button_details.length; _i++) {
  _loop3(_i);
}
/******/ })()
;