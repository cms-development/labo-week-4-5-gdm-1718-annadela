import React from 'react';

const DetailPage = ({ match }) => {
  const {
    params: { id },
  } = match;

  return (
    <div>
      <ul className="header">
          <li><a href="/">Home</a></li>
          <li><a href="/add">Add</a></li>
        </ul>
      details van creatures met id <strong>{id}</strong>
    </div>
  );
};

export default DetailPage;