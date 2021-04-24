/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/access_carte.js ***!
  \**************************************/
var livraison = document.querySelector('#livraison');
var postal = document.querySelector('#postal');
livraison.addEventListener('click', function () {
  livraison.classList.add('opacity-0');
  setTimeout(function () {
    postal.classList.add('z-20');
  }, 500);
});
/******/ })()
;