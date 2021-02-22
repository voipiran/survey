'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _actions = require('../../actions/actions');

var _playbackRateBar = require('./playbackRateBar');

var _playbackRateBar2 = _interopRequireDefault(_playbackRateBar);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    verticalPlaybackRate: jPlayers[id].verticalPlaybackRate,
    minPlaybackRate: jPlayers[id].minPlaybackRate,
    maxPlaybackRate: jPlayers[id].maxPlaybackRate
  };
};

var handlers = {
  movePlaybackRate: function movePlaybackRate(props) {
    return function (bar, e) {
      var offset = (0, _reactJplayerUtils.getElementOffset)(bar);
      var w = bar.getBoundingClientRect().width;
      var h = bar.getBoundingClientRect().height;
      var x = e.clientX - offset.left;
      var y = h - e.clientY + offset.top;
      var ratio = void 0;

      if (props.verticalPlaybackRate) {
        ratio = y / h;
      } else {
        ratio = x / w;
      }

      var playbackRate = ratio * (props.maxPlaybackRate - props.minPlaybackRate) + props.minPlaybackRate;

      props.setOption(props.id, 'playbackRate', playbackRate);
    };
  }
};

var secondHandlers = {
  clickMoveBar: function clickMoveBar(props) {
    return function (bar, e) {
      return props.movePlaybackRate(bar, e);
    };
  },
  touchMoveBar: function touchMoveBar(props) {
    return function (bar, e) {
      // Stop page scrolling
      e.preventDefault();

      props.movePlaybackRate(bar, e.touches[0]);
    };
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setOption: _actions.setOption
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.withHandlers)(secondHandlers))(_playbackRateBar2.default);