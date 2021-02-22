'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

/* eslint-disable no-console */
var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    error: jPlayers[id].error
  };
};

var lifecycleFunctions = {
  logError: function logError() {
    console.error(this.props.error);
  },
  componentDidUpdate: function componentDidUpdate(prevProps) {
    if (prevProps.error !== this.props.error) {
      this.logError();
    }
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps), (0, _recompose.lifecycle)(lifecycleFunctions))((0, _recompose.renderNothing)(null));