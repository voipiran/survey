'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _actions = require('../../../actions/actions');

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    timeFormats: jPlayers[id].timeFormats,
    currentTime: jPlayers[id].currentTime,
    duration: jPlayers[id].duration,
    showRemainingDuration: jPlayers[id].showRemainingDuration
  };
};

var handlers = {
  setDurationText: function setDurationText(props) {
    return function () {
      var durationText = '';

      if (props.showRemainingDuration) {
        var timeRemaining = props.duration - props.currentTime;

        durationText = (timeRemaining > 0 ? '-' : '') + (0, _reactJplayerUtils.convertTime)(timeRemaining, props.timeFormats);
      } else {
        durationText = (0, _reactJplayerUtils.convertTime)(props.duration, props.timeFormats);
      }

      props.setOption(props.id, 'durationText', durationText);
    };
  },
  setCurrentTimeText: function setCurrentTimeText(props) {
    return function () {
      var currentTimeText = (0, _reactJplayerUtils.convertTime)(props.currentTime, props.timeFormats);

      props.setOption(props.id, 'currentTimeText', currentTimeText);
    };
  }
};

var lifecycle = {
  componentDidUpdate: function componentDidUpdate(prevProps) {
    if (prevProps.timeFormats !== this.props.timeFormats || prevProps.currentTime !== this.props.currentTime) {
      this.props.setCurrentTimeText();
    }

    if (prevProps.timeFormats !== this.props.timeFormats || prevProps.currentTime !== this.props.currentTime || prevProps.duration !== this.props.duration || prevProps.showRemainingDuration !== this.props.showRemainingDuration) {
      this.props.setDurationText();
    }
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setOption: _actions.setOption
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycle))((0, _recompose.renderNothing)(null));