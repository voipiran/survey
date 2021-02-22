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

var Download = function Download(_ref) {
  var url = _ref.url,
      children = _ref.children;
  return _react2.default.createElement(
    'a',
    {
      className: _constants.classes.DOWNLOAD,
      href: url,
      download: true,
      target: '_blank',
      rel: 'noopener noreferrer'
    },
    children
  );
};

Download.defaultProps = {
  url: null
};

Download.propTypes = {
  children: _propTypes2.default.node.isRequired,
  url: _propTypes2.default.string
};

exports.default = (0, _recompose.compose)((0, _recompose.branch)(function (props) {
  return props.free;
}, (0, _recompose.renderComponent)(Download)))((0, _recompose.renderNothing)(null));