/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/show_section_menu.js ***!
  \*******************************************/
var all_button_section = document.querySelectorAll('#button_section');
var all_section = document.querySelectorAll('#section');

var _loop = function _loop(i) {
  all_button_section[i].addEventListener('click', function () {
    for (var j = 0; j < all_section.length; j++) {
      all_section[j].classList.remove('hidden');
      all_button_section[j].classList.remove('bg-yellow-500', 'text-gray-800');
      all_button_section[j].classList.add('bg-gray-800', 'text-white');
      all_section[j].classList.add('hidden');
    }

    all_section[i].classList.remove('hidden');
    all_button_section[i].classList.remove('bg-gray-800', 'text-white');
    all_button_section[i].classList.add('bg-yellow-500', 'text-gray-800');
  });
};

for (var i = 0; i < all_button_section.length; i++) {
  _loop(i);
}

var inputs_quantity = document.querySelectorAll('.quantity');
var buttons_less = document.querySelectorAll('.less');
var buttons_more = document.querySelectorAll('.more');

var _loop2 = function _loop2(_i) {
  buttons_less[_i].addEventListener('click', function () {
    if (inputs_quantity[_i].value > 1) {
      inputs_quantity[_i].value = parseInt(inputs_quantity[_i].value) - 1;
    }
  });
};

for (var _i = 0; _i < buttons_less.length; _i++) {
  _loop2(_i);
}

var _loop3 = function _loop3(_i2) {
  buttons_more[_i2].addEventListener('click', function () {
    if (inputs_quantity[_i2].value < 100) {
      inputs_quantity[_i2].value = parseInt(inputs_quantity[_i2].value) + 1;
    }
  });
};

for (var _i2 = 0; _i2 < buttons_more.length; _i2++) {
  _loop3(_i2);
}

var button_modal = document.querySelectorAll('#button_modal');
var modal_type_command = document.querySelector('#modal_type_command');

for (var _i3 = 0; _i3 < button_modal.length; _i3++) {
  button_modal[_i3].addEventListener('click', function () {
    modal_type_command.classList.remove('hidden');
  });
}
/******/ })()
;