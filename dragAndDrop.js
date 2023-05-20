
    function dropHandler(event) {
      event.preventDefault();

      // Get the dropped file
      var file = event.dataTransfer.files[0];

      // Create a new FileReader instance
      var reader = new FileReader();

      // Define the onload event handler
      reader.onload = function (e) {
        // Get the base64-encoded image data
        var imageData = e.target.result;

        // Perform any necessary processing or validation here
        // ...

        // Save the image to the file system
        saveImageToFileSystem(file.name, imageData);
      };

      // Read the dropped file as Data URL (base64-encoded image)
      reader.readAsDataURL(file);
    }

    function dragOverHandler(event) {
      event.preventDefault();
      event.target.classList.add("dragover");
    }

    function dragLeaveHandler(event) {
      event.preventDefault();
      event.target.classList.remove("dragover");
    }

    function saveImageToFileSystem(filename, imageData) {
        const requestOptions = {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ filename: filename, imageData: imageData })
        };
      
        // Send the image data to the server for saving
        fetch('/save-image.php', requestOptions)
          .then(response => response.json())
          .then(data => {
            console.log('Image saved:', data);
            alert('Image saved successfully!');
          })
          .catch(error => {
            console.error('Error saving image:', error);
            alert('Failed to save image.');
          });
      }
      