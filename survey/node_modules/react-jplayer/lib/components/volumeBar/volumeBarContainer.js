'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _actions = require('../../actions/actions');

var _volumeBar = require('./volumeBar');

var _volumeBar2 = _interopRequireDefault(_volumeBar);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    verticalVolume: jPlayers[id].verticalVolume
  };
};

var handlers = {
  moveVolumeBar: function moveVolumeBar(props) {
    return function (bar, e) {
      var offset = (0, _reactJplayerUtils.getElementOffset)(bar);
      var w = bar.getBoundingClientRect().width;
      var h = bar.getBoundingClientRect().height;
      var y = h - e.clientY + offset.top;
      var x = e.clientX - offset.left;

      if (props.verticalVolume) {
        props.setVolume(props.id, y / h);
      } else {
        props.setVolume(props.id, x / w);
      }
    };
  }
};

var secondHandlers = {
  clickMoveBar: function clickMoveBar(props) {
    return function (bar, e) {
      return props.moveVolumeBar(bar, e);
    };
  },
  touchMoveBar: function touchMoveBar(props) {
    return function (bar, e) {
      // Stop page scrolling
      e.preventDefault();

      props.moveVolumeBar(bar, e.touches[0]);
    };
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setVolume: _actions.setVolume
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.withHandlers)(secondHandlers))(_volumeBar2.default);