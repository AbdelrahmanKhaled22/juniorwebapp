import React, { useState } from 'react';

const AddFurniture = ({ attributes, handleInputChange }) => {
  const [dimensions, setDimensions] = useState({
    height: '',
    width: '',
    length: ''
  });

  const handleBeforeInput = (event) => {
    if (/[0-9]/.test(event.data)) {
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
      <input type="text" id="material" name="attributes.material" value={attributes.material || ''} onChange={handleInputChange} onBeforeInput={handleBeforeInput} />

      <label htmlFor="height">Height:</label>
      <input type="number" id="height" name="height" value={dimensions.height} onChange={handleDimensionChange} />

      <label htmlFor="width">Width:</label>
      <input type="number" id="width" name="width" value={dimensions.width} onChange={handleDimensionChange} />

      <label htmlFor="length">Length:</label>
      <input type="number" id="length" name="length" value={dimensions.length} onChange={handleDimensionChange} />
    </div>
  );
};

export default AddFurniture;
