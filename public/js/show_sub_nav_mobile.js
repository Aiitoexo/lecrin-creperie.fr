/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/show_sub_nav_mobile.js ***!
  \*********************************************/
var hamburger = document.querySelector('#hamburger');
var sub_nav_mobile = document.querySelector('#sub_nav_mobile');
var close_sub_nav = document.querySelector('#close_sub_nav');
hamburger.addEventListener('click', function () {
  sub_nav_mobile.classList.remove('hidden');
});
close_sub_nav.addEventListener('click', function () {
  sub_nav_mobile.classList.add('hidden');
});
/******/ })()
;