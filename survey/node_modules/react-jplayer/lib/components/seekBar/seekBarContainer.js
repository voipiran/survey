'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _recompose = require('recompose');

var _reactJplayerUtils = require('react-jplayer-utils');

var _actions = require('../../actions/actions');

var _seekBar = require('./seekBar');

var _seekBar2 = _interopRequireDefault(_seekBar);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    seekPercent: jPlayers[id].seekPercent
  };
};

var handlers = {
  movePlayHead: function movePlayHead(props) {
    return function (bar, e) {
      var offset = (0, _reactJplayerUtils.getElementOffset)(bar);
      var x = e.clientX - offset.left;
      var w = bar.getBoundingClientRect().width;
      var percentage = 100 * (x / w);

      props.setPlayHead(props.id, percentage);
    };
  }
};

var secondHandlers = {
  clickMoveBar: function clickMoveBar(props) {
    return function (bar, e) {
      return props.movePlayHead(bar, e);
    };
  },
  touchMoveBar: function touchMoveBar(props) {
    return function (bar, e) {
      // Stop page scrolling
      e.preventDefault();

      props.movePlayHead(bar, e.touches[0]);
    };
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setPlayHead: _actions.setPlayHead
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.withHandlers)(secondHandlers))(_seekBar2.default);