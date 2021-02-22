"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

// Some IOS versions don't allow manually changing volume or mute
exports.default = function () {
  var audio = new window.Audio();
  audio.volume = 0.5;

  return audio.volume === 0.5;
};