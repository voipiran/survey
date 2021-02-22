'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Track = function Track(props) {
  return _react2.default.createElement('track', {
    'default': props.default,
    kind: props.kind,
    src: props.src,
    label: props.label,
    srcLang: props.srclang
  });
};

Track.defaultProps = {
  default: null,
  kind: null,
  label: null,
  srclang: null
};

Track.propTypes = {
  default: _propTypes2.default.bool,
  kind: _propTypes2.default.string,
  src: _propTypes2.default.string.isRequired,
  label: _propTypes2.default.string,
  srclang: _propTypes2.default.string
};

exports.default = Track;