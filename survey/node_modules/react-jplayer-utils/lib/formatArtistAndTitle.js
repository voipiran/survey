'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function (artist, title) {
  var titleText = '';

  if (artist) {
    titleText += '' + artist;
  }

  if (title) {
    if (artist) {
      titleText += ' - ';
    }
    titleText += '' + title;
  }

  return titleText;
};