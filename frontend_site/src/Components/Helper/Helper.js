import React from 'react';

export const WordsEllipsis = ({ text }) => {
    console.log(text)
  const words = text?.split(' ');
  const truncatedText = words.length > 20 ? words.slice(0, 20).join(' ') + '...' : text;

  return truncatedText;
};


