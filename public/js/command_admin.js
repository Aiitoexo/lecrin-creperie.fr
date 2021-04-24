/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/command_admin.js ***!
  \***************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function getCommandEmporter() {
  axios.get('command/emporter').then(function (response) {
    var html = response.data.reverse().reduce(function (carry, command) {
      var items = '';

      var _iterator = _createForOfIteratorHelper(command.command),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var item = _step.value;
          items += "<div class=\"col-span-1 flex\">\n                            <p>".concat(item.name, "</p>\n                            <p class=\"ml-2\">x").concat(item.quantity, "</p>\n                          </div>");
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      var adresse = "\n                        <div class=\"col-span-3 pr-2\">\n                            <p>".concat(command.adresse, "</p>\n                            <p>").concat(command.city, "</p>\n                            <p>").concat(command.postal, "</p>\n                        </div>\n            ");
      return carry += "\n                     <div class=\"w-full h-auto bg-white shadow-2xl rounded px-6 py-3 my-6\">\n                        <div class=\"flex justify-between items-center pb-3\">\n                            <p>Commande n\xB0 ".concat(command.reference, "</p>\n                            <p>").concat(command.type_command, "</p>\n                            <p>").concat(command.price, "</p>\n                            <a class=\"button\" href=\"command/complete?id=").concat(command.id, "\">Commande pr\xEAte</a>\n                        </div>\n                        <div class=\"grid grid-cols-2 pt-3 border-t border-gray-800\">\n                            <div class=\"grid grid-cols-5 gap-x-8 col-span-1\">\n                                <div class=\"col-span-2 pr-2\">\n                                    <p>").concat(command.last_name, " ").concat(command.first_name, "</p>\n                                    <p>").concat(command.mail, "</p>\n                                    <p>").concat(command.phone, "</p>\n                                </div>\n\n                                ").concat(command.adresse !== null ? adresse : '', "\n                            </div>\n\n                            <div class=\"col-span-1 grid grid-cols-2 bg-gray-300 rounded p-2\">\n                                ").concat(items, "\n                            </div>\n                        </div>\n                    </div>\n            ");
    }, '');
    var element = document.getElementById('all_command_emporter');
    element.innerHTML = html;
  })["catch"](function (error) {//TODO: error
  });
}

;

function getCommandLivraison() {
  axios.get('command/livraison').then(function (response) {
    var html = response.data.reverse().reduce(function (carry, command) {
      var items = '';

      var _iterator2 = _createForOfIteratorHelper(command.command),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var item = _step2.value;
          items += "<div class=\"col-span-1 flex\">\n                            <p>".concat(item.name, "</p>\n                            <p class=\"ml-2\">x").concat(item.quantity, "</p>\n                          </div>");
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      var adresse = "\n                        <div class=\"col-span-3 pr-2\">\n                            <p>".concat(command.adresse, "</p>\n                            <p>").concat(command.city, "</p>\n                            <p>").concat(command.postal, "</p>\n                        </div>\n            ");
      return carry += "\n                     <div class=\"w-full h-auto bg-white shadow-2xl rounded px-6 py-3 my-6\">\n                        <div class=\"flex justify-between items-center pb-3\">\n                            <p>Commande n\xB0 ".concat(command.reference, "</p>\n                            <p>").concat(command.type_command, "</p>\n                            <p>").concat(command.price, "</p>\n                            <a class=\"button\" href=\"command/complete?id=").concat(command.id, "\">Commande pr\xEAte</a>\n                        </div>\n                        <div class=\"grid grid-cols-2 pt-3 border-t border-gray-800\">\n                            <div class=\"grid grid-cols-5 gap-x-8 col-span-1\">\n                                <div class=\"col-span-2 pr-2\">\n                                    <p>").concat(command.last_name, " ").concat(command.first_name, "</p>\n                                    <p>").concat(command.mail, "</p>\n                                    <p>").concat(command.phone, "</p>\n                                </div>\n\n                                ").concat(command.adresse !== null ? adresse : '', "\n                            </div>\n\n                            <div class=\"col-span-1 grid grid-cols-2 bg-gray-300 rounded p-2\">\n                                ").concat(items, "\n                            </div>\n                        </div>\n                    </div>\n            ");
    }, '');
    var element = document.getElementById('all_command_livraison');
    element.innerHTML = html;
  })["catch"](function (error) {//TODO: error
  });
}

;
getCommandEmporter();
setInterval(getCommandEmporter(), getCommandLivraison(), 3000);
/******/ })()
;