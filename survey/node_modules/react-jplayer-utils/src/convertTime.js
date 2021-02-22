export default (seconds, timeFormats) => {
  if (isNaN(seconds)) {
    return '';
  }
  const myTime = new Date(seconds * 1000);

  const hour = myTime.getUTCHours();
  const min = timeFormats.showHour ? myTime.getUTCMinutes() : myTime.getUTCMinutes() + (hour * 60);
  const sec = timeFormats.showMin ? myTime.getUTCSeconds() : myTime.getUTCSeconds() + (min * 60);
  const strHour = (timeFormats.padHour && hour < 10) ? `0${hour}` : hour;
  const strMin = (timeFormats.padMin && min < 10) ? `0${min}` : min;
  const strSec = (timeFormats.padSec && sec < 10) ? `0${sec}` : sec;

  let strTime = '';
  strTime += timeFormats.showHour ? strHour + timeFormats.sepHour : '';
  strTime += timeFormats.showMin ? strMin + timeFormats.sepMin : '';
  strTime += timeFormats.showSec ? strSec + timeFormats.sepSec : '';

  return strTime;
};
