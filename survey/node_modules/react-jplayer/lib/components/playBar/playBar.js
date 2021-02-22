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

var PlayBar = function PlayBar(props) {
  var width = props.smoothPlayBar ? props.smoothWidth + '%' : props.currentPercentRelative + '%';

  return _react2.default.createElement('div', {
    className: _constants.classes.PLAY_BAR,
    style: { width: width }
  });
};

PlayBar.propTypes = {
  smoothPlayBar: _propTypes2.default.bool.isRequired,
  smoothWidth: _propTypes2.default.number.isRequired,
  currentPercentRelative: _propTypes2.default.number.isRequired
};

exports.default = PlayBar;