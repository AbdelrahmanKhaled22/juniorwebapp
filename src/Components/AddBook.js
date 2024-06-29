
import React from 'react';

const AddBook = ({ attributes, handleInputChange }) => {
  return (
    <div>
      <label htmlFor="author">{"Author"}</label>
      <input type="text" id="author" name="attributes.author" value={attributes.author || ''} onChange={handleInputChange} />
      
      <label htmlFor="weight">{"Weight (KG)"}</label>
      <input type="text" id="weight" name="attributes.weight" value={attributes.weight || ''} onChange={handleInputChange} />
    
      <p>{"Please provide weight in kilograms"}</p>
    </div>
  );
};

export default AddBook;
