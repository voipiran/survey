'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _recompose = require('recompose');

var _reactJplayerUtils = require('react-jplayer-utils');

var _bufferBar = require('./bufferBar');

var _bufferBar2 = _interopRequireDefault(_bufferBar);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    bufferedTimeRanges: jPlayers[id].bufferedTimeRanges,
    duration: jPlayers[id].duration,
    bufferColour: jPlayers[id].bufferColour
  };
};

var handlers = function handlers() {
  var canvas = void 0;

  return {
    setCanvas: function setCanvas() {
      return function (ref) {
        canvas = ref;
      };
    },
    clearBuffer: function clearBuffer() {
      return function () {
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
      };
    },
    fillBufferPartially: function fillBufferPartially(props) {
      return function () {
        var modifier = canvas.width / props.duration;
        var context = canvas.getContext('2d');

        props.bufferedTimeRanges.forEach(function (bufferedTimeRange) {
          var startX = bufferedTimeRange.start * modifier;
          var endX = bufferedTimeRange.end * modifier;
          var width = endX - startX;

          context.fillStyle = props.bufferColour;
          context.fillRect(startX, 0, width, canvas.height);
        });
      };
    }
  };
};

var lifecycle = {
  componentDidUpdate: function componentDidUpdate(prevProps) {
    if (prevProps.bufferedTimeRanges !== this.props.bufferedTimeRanges) {
      if (this.props.bufferedTimeRanges.length === 0) {
        this.props.clearBuffer();
      }
      this.props.fillBufferPartially();
    }
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycle))(_bufferBar2.default);