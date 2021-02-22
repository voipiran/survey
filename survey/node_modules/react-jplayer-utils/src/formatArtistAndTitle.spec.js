import expect from 'expect';

import formatArtistAndTitle from './formatArtistAndTitle';

describe('formatArtistAndTitle', () => {
  describe('when title is not null', () => {
    it('and artist is null it renders title', () => {
      const titleText = formatArtistAndTitle(null, 'Bubble');

      expect(titleText).toBe('Bubble');
    });

    it('and artist is not null it renders title and artist', () => {
      const titleText = formatArtistAndTitle('Kalimba', 'Bubble');

      expect(titleText).toBe('Kalimba - Bubble');
    });
  });

  it('when title is null it just renders the artist', () => {
    const titleText = formatArtistAndTitle('Kalimba', null);

    expect(titleText).toBe('Kalimba');
  });

  it('when artist and title are null it renders an empty string', () => {
    const titleText = formatArtistAndTitle(null, null);

    expect(titleText).toBe('');
  });
});
