'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _actions = require('../../actions/actions');

var _play2 = require('./play');

var _play3 = _interopRequireDefault(_play2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    paused: jPlayers[id].paused
  };
};

var mapDispatchToProps = function mapDispatchToProps(dispatch) {
  return {
    play: function play(id, paused) {
      if (paused) {
        dispatch((0, _actions.play)(id));
      } else {
        dispatch((0, _actions.pause)(id));
      }
    }
  };
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps, mapDispatchToProps)(_play3.default);