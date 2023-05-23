function selectFileHandler() {
  // Crea un file input per prender il file
  var fileInput = document.createElement('input');
  fileInput.type = 'file';

  // Apre la finestra del file input
  fileInput.click();

  // Controlla la selezione del file
  fileInput.addEventListener('change', function (event) {
    var file = event.target.files[0];
    handleSelectedFile(file);
  });
}

function dropHandler(event) {
  event.preventDefault();

  // Prende il file trascinato
  var file = event.dataTransfer.files[0];

  handleSelectedFile(file);
}

function handleSelectedFile(file) {
  // Controlla se un file é selezionato
  if (file) {
    // Controlla la grandezza del file (massimo 3MB)
    var maxSize = 3 * 1024 * 1024; // 3MB in bytes
    if (file.size > maxSize) {
      alert('File size exceeds the limit (3MB).');
      return;
    }

    // Controlla l'estensione del file (ammesse solo immagini)
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    var extension = file.name.split('.').pop().toLowerCase();
    if (!allowedExtensions.includes(extension)) {
      alert('Invalid file extension. Allowed extensions are: jpg, jpeg, png, gif');
      return;
    }

    // Crea un file reader
    var reader = new FileReader();

    // Definisce il comportamento all'avvio del reader
    reader.onload = function (e) {
      // Prende i dati dell'immagine
      var imageData = e.target.result;

      // Salva l'immagine sul server
      saveImageToFileSystem(file.name, imageData);
    };

    // Prende i file tramite URL in BASE64
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

  // Manda l'immagine da salvare al server cosi che il php possa salvarla
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
