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

var BrowserUnsupported = function BrowserUnsupported(_ref) {
  var children = _ref.children;
  return _react2.default.createElement(
    'div',
    { className: _constants.classes.NO_BROWSER_SUPPORT },
    children
  );
};

var defaultChildren = _react2.default.createElement(
  'div',
  null,
  _react2.default.createElement(
    'h4',
    null,
    'Browser Unsupported'
  ),
  'Your browser does not support this media file. To play the media you will need to update your browser to a more recent version.'
);

BrowserUnsupported.defaultProps = {
  children: defaultChildren
};

BrowserUnsupported.propTypes = {
  children: _propTypes2.default.node
};

exports.default = (0, _recompose.compose)((0, _recompose.branch)(function (props) {
  return props.nonSupported;
}, (0, _recompose.renderComponent)(BrowserUnsupported)))((0, _recompose.renderNothing)(null));