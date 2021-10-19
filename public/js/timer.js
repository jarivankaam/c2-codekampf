/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/timer.js ***!
  \*******************************/
var timeEl = document.getElementById("time-el");

(function setTime() {
  var today = new Date();
  timeEl.textContent = today.toLocaleString('nl-NL');
  setTimeout(setTime, 1000);
})();
/******/ })()
;