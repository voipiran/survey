'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _recompose = require('recompose');

var _media = require('./media');

var _media2 = _interopRequireDefault(_media);

var _actions = require('../../actions/actions');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    loop: jPlayers[id].loop,
    src: jPlayers[id].src,
    playHeadPercent: jPlayers[id].playHeadPercent,
    paused: jPlayers[id].paused,
    defaultPlaybackRate: jPlayers[id].defaultPlaybackRate,
    playbackRate: jPlayers[id].playbackRate,
    preload: jPlayers[id].preload,
    volume: jPlayers[id].volume,
    muted: jPlayers[id].muted,
    autoplay: jPlayers[id].autoplay,
    newTime: jPlayers[id].newTime,
    tracks: jPlayers[id].media.tracks
  };
};

var handlers = function handlers() {
  var currentMedia = void 0;

  var getSeekableEnd = function getSeekableEnd() {
    if (currentMedia.seekable.length > 0) {
      return currentMedia.seekable.end(currentMedia.seekable.length - 1);
    }

    return NaN;
  };
  var getCurrentPercentRelative = function getCurrentPercentRelative() {
    return (0, _reactJplayerUtils.toPercentage)(currentMedia.currentTime, getSeekableEnd());
  };
  var getSeekPercent = function getSeekPercent() {
    return (0, _reactJplayerUtils.toPercentage)(getSeekableEnd(), currentMedia.duration);
  };

  return {
    setCurrentMedia: function setCurrentMedia() {
      return function (ref) {
        currentMedia = ref;
      };
    },
    updateMediaStatus: function updateMediaStatus(props) {
      return function () {
        var currentPercentAbsolute = (0, _reactJplayerUtils.toPercentage)(currentMedia.currentTime, currentMedia.duration);

        // Is infinite when live streaming
        if (isFinite(currentMedia.duration)) {
          props.setOption(props.id, 'duration', currentMedia.duration);
        }

        props.setOption(props.id, 'currentPercentRelative', getCurrentPercentRelative());
        props.setOption(props.id, 'seekPercent', getSeekPercent());
        props.setOption(props.id, 'currentPercentAbsolute', currentPercentAbsolute);
        props.setOption(props.id, 'currentTime', currentMedia.currentTime);
        props.setOption(props.id, 'playbackRate', currentMedia.playbackRate);
      };
    },
    updateMediaSrc: function updateMediaSrc(props) {
      return function () {
        if (props.src !== null) {
          currentMedia.src = props.src;
        }
      };
    },
    updateMediaTime: function updateMediaTime(props) {
      return function () {
        currentMedia.currentTime = props.newTime;
        props.setOption(props.id, 'newTime', null);
      };
    },
    updateMediaTimeAfterSeeking: function updateMediaTimeAfterSeeking(props) {
      return function () {
        var seekableEnd = getSeekableEnd();

        // TODO: Investigate why some .mp3 urls don't fire media events enough (http://www.davidgagne.net/m/song.mp3).
        // Hasn't fully loaded the song????
        if (isFinite(seekableEnd)) {
          currentMedia.currentTime = (0, _reactJplayerUtils.toRelativePercentage)(props.playHeadPercent, seekableEnd);

          /* Media events don't fire fast enough to give a smooth animation
            when dragging so we update it here as well, same problem as above? */
          props.setOption(props.id, 'currentPercentRelative', getCurrentPercentRelative());
        }
      };
    },
    updateMediaPlayState: function updateMediaPlayState(props) {
      return function () {
        if (props.paused) {
          currentMedia.pause();
        } else {
          currentMedia.play();
        }
      };
    },
    updateOtherMediaValues: function updateOtherMediaValues(props) {
      return function () {
        currentMedia.defaultPlaybackRate = props.defaultPlaybackRate;
        currentMedia.playbackRate = props.playbackRate;
        currentMedia.preload = props.preload;
        currentMedia.volume = props.volume;
        currentMedia.muted = props.muted;
        currentMedia.autoplay = props.autoplay;
        currentMedia.loop = props.loop;
      };
    }
  };
};

var lifecycle = {
  componentDidMount: function componentDidMount() {
    if (this.props.src !== null) {
      this.props.updateMediaSrc();
    }

    this.props.updateOtherMediaValues();
  },
  componentDidUpdate: function componentDidUpdate(prevProps) {
    if (prevProps.src !== this.props.src) {
      this.props.updateMediaSrc();
    }

    if (this.props.newTime !== null) {
      this.props.updateMediaTime();
    }

    if (prevProps.playHeadPercent !== this.props.playHeadPercent) {
      this.props.updateMediaTimeAfterSeeking();
    }

    this.props.updateMediaPlayState();
    this.props.updateOtherMediaValues();
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setOption: _actions.setOption
}), (0, _recompose.withHandlers)(handlers), (0, _recompose.lifecycle)(lifecycle))(_media2.default);