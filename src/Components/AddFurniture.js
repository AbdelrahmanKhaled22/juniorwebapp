import React, { useState } from 'react';

const AddFurniture = ({ attributes, handleInputChange }) => {
  
  const [dimensions, setDimensions] = useState({
    height: '',
    width: '',
    length: ''
  });

  const onlyNums = (event) => {

    // Allow only digits 0-9
    const allowedCharacters = /[0-9]/; 

    if (!allowedCharacters.test(event.data)) { // Check if the entered character is not allowed
      
      // Prevent default action (input)
      event.preventDefault(); 
    }
  };

  const noNums = (event) => {

    // Allow only digits 0-9
    const forbiddenCharacters = /[0-9]/; 
  
    
    if (forbiddenCharacters.test(event.data)) { // Check if the entered character is forbidden
      
      // Prevent default action (input)
      event.preventDefault(); 
    }
  };
  
  const handleDimensionChange = (e) => {
    const { name, value } = e.target;
    const newDimensions = { ...dimensions, [name]: value };
    setDimensions(newDimensions);

    // Update the concatenated dimensions in attributes
    const concatenatedDimensions = `${newDimensions.height}x${newDimensions.width}x${newDimensions.length}`;
    handleInputChange({
      target: {
        name: 'attributes.dimensions',
        value: concatenatedDimensions
      }
    });
  };

  return (
    <div>
      <label htmlFor="material">Material:</label>
      <input type="text" id="material" name="attributes.material" value={attributes.material || ''} onChange={handleInputChange} onBeforeInput={noNums}/>

      <label htmlFor="height">{"Height (CM)"}</label>
      <input type="number" id="height" name="height" value={dimensions.height} onChange={handleDimensionChange} onBeforeInput={onlyNums} required />

      <label htmlFor="width">{"Width (CM)"}</label>
      <input type="number" id="width" name="width" value={dimensions.width} onChange={handleDimensionChange} onBeforeInput={onlyNums} required />

      <label htmlFor="length">{"Length (CM)"}</label>
      <input type="number" id="length" name="length" value={dimensions.length} onChange={handleDimensionChange} onBeforeInput={onlyNums} required />

      <p>{"Please enter dimensions in HxWxL format"}</p>

    </div>
  );
};

export default AddFurniture;
