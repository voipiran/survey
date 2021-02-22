'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _title = require('./title');

var _title2 = _interopRequireDefault(_title);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    title: (0, _reactJplayerUtils.formatArtistAndTitle)(jPlayers[id].media.artist, jPlayers[id].media.title)
  };
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps)(_title2.default);