'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _screenfull = require('screenfull');

var _screenfull2 = _interopRequireDefault(_screenfull);

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _actions = require('../../../actions/actions');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    fullScreen: jPlayers[id].fullScreen
  };
};

var handlers = {
  closeFullScreenListener: function closeFullScreenListener(props) {
    return function () {
      if (!_screenfull2.default.isFullscreen && props.fullScreen) {
        props.setOption(props.id, 'fullScreen', false);
      }
    };
  }
};

var lifecycleFunctions = {
  requestFullScreen: function requestFullScreen() {
    if (this.props.fullScreen) {
      if (_screenfull2.default.enabled) {
        _screenfull2.default.request(this.props.jPlayer);
      }
      // Legacy browsers don't implement full screen api
      // Safari 5.1 doesn't hide the other elements even with fullscreen api
      document.body.style.visibility = 'hidden';
    }
  },
  exitFullScreen: function exitFullScreen() {
    if (!this.props.fullScreen) {
      if (_screenfull2.default.enabled) {
        _screenfull2.default.exit();
      }
      document.body.style.visibility = 'visible';
    }
  },
  componentDidMount: function componentDidMount() {
    if (_screenfull2.default.enabled) {
      document.addEventListener(_screenfull2.default.raw.fullscreenchange, this.props.closeFullScreenListener);
    }
    this.requestFullScreen();
  },
  componentDidUpdate: function componentDidUpdate(prevProps) {
    this.requestFullScreen();
    if (prevProps.fullScreen !== this.props.fullScreen) {
      this.exitFullScreen();
    }
  },
  componentWillUnmount: function componentWillUnmount() {
    if (_screenfull2.default.enabled) {
      document.removeEventListener(_screenfull2.default.raw.fullscreenchange, this.props.closeFullScreenListener);
    }
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setOption: _actions.setOption
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycleFunctions))((0, _recompose.renderNothing)(null));