'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _recompose = require('recompose');

var _reactJplayerUtils = require('react-jplayer-utils');

var _states = require('./states/states');

var _states2 = _interopRequireDefault(_states);

var _jPlayer = require('./jPlayer');

var _jPlayer2 = _interopRequireDefault(_jPlayer);

var _actions = require('../../actions/actions');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, ownProps) {
  var jPlayers = _ref.jPlayers;
  var id = ownProps.id,
      keyBindings = ownProps.keyBindings,
      children = ownProps.children,
      className = ownProps.className;


  return {
    media: jPlayers[id].media,
    fullScreen: jPlayers[id].fullScreen,
    paused: jPlayers[id].paused,
    startGuiFadeOut: jPlayers[id].startGuiFadeOut,
    keyBindings: keyBindings,
    id: id,
    children: children,
    className: (0, _states2.default)(jPlayers[id], ownProps.states, className)
  };
};

var handlers = {
  onMouseMoveCapture: function onMouseMoveCapture(props) {
    return function () {
      if (props.fullScreen) {
        if (props.paused || props.startGuiFadeOut) {
          props.setOption(props.id, 'startGuiFadeOut', false);
        } else {
          props.setOption(props.id, 'startGuiFadeOut', true);
        }
      }
    };
  }
};

var lifecycle = {
  componentDidMount: function componentDidMount() {
    if (Object.keys(this.props.media.sources).length > 0) {
      this.props.setMedia(this.props.id, this.props.media);
    }

    this.props.setOption(this.props.id, 'volumeSupported', (0, _reactJplayerUtils.canSetVolume)());
  }
};

exports.default = (0, _recompose.compose)((0, _recompose.withContext)({ id: _propTypes2.default.string }, function (_ref2) {
  var id = _ref2.id;
  return { id: id };
}), (0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setMedia: _actions.setMedia,
  setOption: _actions.setOption
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycle))(_jPlayer2.default);