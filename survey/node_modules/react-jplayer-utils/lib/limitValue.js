"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function (value, min, max) {
  if (value < min) {
    return min;
  }

  if (value > max) {
    return max;
  }
  return value;
};