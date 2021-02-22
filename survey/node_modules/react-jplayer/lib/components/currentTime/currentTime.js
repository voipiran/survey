'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _constants = require('../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var CurrentTime = function CurrentTime(_ref) {
  var currentTimeText = _ref.currentTimeText;
  return _react2.default.createElement(
    'div',
    { className: _constants.classes.CURRENT_TIME },
    currentTimeText
  );
};

CurrentTime.propTypes = {
  currentTimeText: _propTypes2.default.string.isRequired
};

exports.default = CurrentTime;