/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************!*\
  !*** ./blocks/events.js ***!
  \**************************/
wp.blocks.registerBlockType("blockville/events", {
  title: "Events",
  edit: function () {
    return wp.element.createElement("div", {
      className: "events-block"
    }, "Events Placeholder");
  },
  save: function () {
    return null;
    //returns null because I want 100% php processesing
  }
});
/******/ })()
;
//# sourceMappingURL=events.js.map