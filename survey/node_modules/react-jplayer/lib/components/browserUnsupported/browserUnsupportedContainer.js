'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _browserUnsupported = require('./browserUnsupported');

var _browserUnsupported2 = _interopRequireDefault(_browserUnsupported);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    nonSupported: jPlayers[id].mediaSettings.nonSupported
  };
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps)(_browserUnsupported2.default);