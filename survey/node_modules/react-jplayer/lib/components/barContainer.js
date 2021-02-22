'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _bar = require('./bar');

var _bar2 = _interopRequireDefault(_bar);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    barDrag: jPlayers[id].barDrag
  };
};

var handlers = function handlers() {
  var bar = void 0;
  var dragging = void 0;

  return {
    setBar: function setBar() {
      return function (ref) {
        bar = ref;
      };
    },
    onClick: function onClick(props) {
      return function (e) {
        return props.clickMoveBar(bar, e);
      };
    },
    onTouchStart: function onTouchStart() {
      return function () {
        dragging = true;
      };
    },
    onTouchMove: function onTouchMove(props) {
      return function (e) {
        if (props.barDrag && dragging) {
          props.touchMoveBar(bar, e);
        }
      };
    },
    onTouchEnd: function onTouchEnd() {
      return function () {
        dragging = false;
      };
    },
    onMouseMove: function onMouseMove(props) {
      return function (e) {
        if (props.barDrag && dragging) {
          props.clickMoveBar(bar, e);
        }
      };
    },
    onMouseDown: function onMouseDown() {
      return function () {
        dragging = true;
      };
    },
    onMouseUp: function onMouseUp() {
      return function () {
        dragging = false;
      };
    }
  };
};

var lifecycle = {
  componentDidMount: function componentDidMount() {
    document.addEventListener('mouseup', this.props.onMouseUp);
    document.addEventListener('mousemove', this.props.onMouseMove);
    document.addEventListener('touchmove', this.props.onTouchMove, { passive: false });
    document.addEventListener('touchend', this.props.onTouchEnd);
  },
  componentWillUnmount: function componentWillUnmount() {
    document.removeEventListener('mouseup', this.props.onMouseUp);
    document.removeEventListener('mousemove', this.props.onMouseMove);
    document.removeEventListener('touchmove', this.props.onTouchMove);
    document.removeEventListener('touchend', this.props.onTouchEnd);
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycle))(_bar2.default);