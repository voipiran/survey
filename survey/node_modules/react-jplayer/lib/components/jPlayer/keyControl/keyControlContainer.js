'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _lodash = require('lodash.merge');

var _lodash2 = _interopRequireDefault(_lodash);

var _actions = require('../../../actions/actions');

var _constants = require('../../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    paused: jPlayers[id].paused,
    fullScreen: jPlayers[id].fullScreen,
    muted: jPlayers[id].muted,
    volume: jPlayers[id].volume,
    keyEnabled: jPlayers[id].keyEnabled,
    focused: jPlayers[id].focused,
    id: id
  };
};

var mergeProps = function mergeProps(stateProps, _ref3, _ref4) {
  var dispatch = _ref3.dispatch;
  var keyBindings = _ref4.keyBindings,
      id = _ref4.id;
  return {
    keyBindings: (0, _lodash2.default)({}, {
      play: {
        key: 80, // p
        fn: function fn() {
          return stateProps.paused ? dispatch((0, _actions.play)(id)) : dispatch((0, _actions.pause)(id));
        }
      },
      fullScreen: {
        key: 70, // f
        fn: function fn() {
          return dispatch((0, _actions.setOption)(id, 'fullScreen', !stateProps.fullScreen));
        }
      },
      mute: {
        key: 77, // m
        fn: function fn() {
          return dispatch((0, _actions.setMute)(id, !stateProps.muted));
        }
      },
      volumeUp: {
        key: 190, // .
        fn: function fn() {
          dispatch((0, _actions.setVolume)(id, stateProps.volume + 0.1));
        }
      },
      volumeDown: {
        key: 188, // ,
        fn: function fn() {
          return dispatch((0, _actions.setVolume)(id, stateProps.volume - 0.1));
        }
      },
      loop: {
        key: 76, // l
        fn: function fn() {
          return dispatch((0, _actions.setOption)(id, 'loop', !stateProps.loop));
        }
      }
    }, keyBindings),
    focused: stateProps.focused,
    keyEnabled: stateProps.keyEnabled
  };
};

var handlers = {
  onKeyDown: function onKeyDown(props) {
    return function (event) {
      if (_constants.keyIgnoredElementNames.some(function (name) {
        return name.toUpperCase() === event.target.nodeName.toUpperCase();
      }) || !props.focused || !props.keyEnabled) {
        return;
      }

      Object.keys(props.keyBindings).forEach(function (key) {
        var keyBinding = props.keyBindings[key];

        if (keyBinding.key === event.keyCode || keyBinding.key === event.key) {
          event.preventDefault();
          keyBinding.fn();
        }
      });
    };
  }
};

var lifecycle = {
  componentDidMount: function componentDidMount() {
    document.addEventListener('keydown', this.props.onKeyDown);
  },
  componentWillUnmount: function componentWillUnmount() {
    document.removeEventListener('keydown', this.props.onKeyDown);
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, null, mergeProps), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycle))((0, _recompose.renderNothing)(null));