'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _recompose = require('recompose');

var _constants = require('../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Poster = function Poster(_ref) {
  var src = _ref.src;
  return _react2.default.createElement('img', { className: _constants.classes.POSTER, alt: '', src: src });
};

Poster.defaultProps = {
  src: null
};

Poster.propTypes = {
  src: _propTypes2.default.string
};

exports.default = (0, _recompose.compose)((0, _recompose.branch)(function (props) {
  return props.src;
}, (0, _recompose.renderComponent)(Poster)))((0, _recompose.renderNothing)(null));