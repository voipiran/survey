// Some IOS versions don't allow manually changing volume or mute
export default () => {
  const audio = new window.Audio();
  audio.volume = 0.5;

  return audio.volume === 0.5;
};
