export default (artist, title) => {
  let titleText = '';

  if (artist) {
    titleText += `${artist}`;
  }

  if (title) {
    if (artist) {
      titleText += ' - ';
    }
    titleText += `${title}`;
  }

  return titleText;
};
