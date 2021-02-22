"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function (el) {
  return {
    top: el.getBoundingClientRect().top + document.body.scrollTop,
    left: el.getBoundingClientRect().left + document.body.scrollLeft
  };
};