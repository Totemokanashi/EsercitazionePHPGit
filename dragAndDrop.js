function selectFileHandler() {
  // Create a file input element
  var fileInput = document.createElement('input');
  fileInput.type = 'file';

  // Trigger the file input dialog
  fileInput.click();

  // Handle file selection
  fileInput.addEventListener('change', function (event) {
    var file = event.target.files[0];
    handleSelectedFile(file);
  });
}

function dropHandler(event) {
  event.preventDefault();

  // Get the dropped file
  var file = event.dataTransfer.files[0];

  handleSelectedFile(file);
}

function handleSelectedFile(file) {
  // Check if a file is selected
  if (file) {
    // Check file size (maximum 3MB)
    var maxSize = 3 * 1024 * 1024; // 3MB in bytes
    if (file.size > maxSize) {
      alert('File size exceeds the limit (3MB).');
      return;
    }

    // Check file extension (allow only images)
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    var extension = file.name.split('.').pop().toLowerCase();
    if (!allowedExtensions.includes(extension)) {
      alert('Invalid file extension. Allowed extensions are: jpg, jpeg, png, gif');
      return;
    }

    // Create a new FileReader instance
    var reader = new FileReader();

    // Define the onload event handler
    reader.onload = function (e) {
      // Get the base64-encoded image data
      var imageData = e.target.result;

      // Save the image to the file system
      saveImageToFileSystem(file.name, imageData);
    };

    // Read the file as Data URL (base64-encoded image)
    reader.readAsDataURL(file);
  }
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
      document.getElementById('image').src = "img/" + filename;
      document.getElementById('image-src').value = filename;
    })
    .catch(error => {
      console.error('Error saving image:', error);
      alert('Failed to upload image.');
    });
}
