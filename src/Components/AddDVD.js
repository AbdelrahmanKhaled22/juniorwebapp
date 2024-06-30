
import React from 'react';

const AddDVD = ({ attributes, handleInputChange }) => {


  const handleBeforeInput = (event) => {
    const allowedCharacters = /[0-9]/; // Allow only digits 0-9
  
    // Check if the entered character is not allowed
    if (!allowedCharacters.test(event.data)) {
      event.preventDefault(); // Prevent default action (input)
    }
  };


  return (
    <div>
      <label htmlFor="size">{"Size (MB)"}</label>
      <input type="number" step="1" id="size" name="attributes.size" value={attributes.size || ''} onChange={handleInputChange} onBeforeInput={handleBeforeInput} required />

      <p>{"Please provide size in megabytes"}</p>  
    </div>
  );
};

export default AddDVD;
