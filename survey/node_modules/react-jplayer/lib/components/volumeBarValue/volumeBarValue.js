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

var VolumeBarValue = function VolumeBarValue(_ref) {
  var muted = _ref.muted,
      volume = _ref.volume,
      verticalVolume = _ref.verticalVolume;

  var volumeBarValuePercentage = (muted ? 0 : volume * 100) + '%';
  var style = {
    width: !verticalVolume ? volumeBarValuePercentage : null,
    height: verticalVolume ? volumeBarValuePercentage : null
  };

  return _react2.default.createElement('div', { className: _constants.classes.VOLUME_BAR_VALUE, style: style });
};

VolumeBarValue.propTypes = {
  muted: _propTypes2.default.bool.isRequired,
  volume: _propTypes2.default.number.isRequired,
  verticalVolume: _propTypes2.default.bool.isRequired
};

exports.default = VolumeBarValue;