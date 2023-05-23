<?php
// Prende il body della request
$requestBody = file_get_contents('php://input');

// decodifica la richiesta JSON
$data = json_decode($requestBody, true);

if ($data === null || !isset($data['filename']) || !isset($data['imageData'])) {
  // Richiesta errata
  $response = array('success' => false, 'message' => 'Invalid request data.');
  echo json_encode($response);
  exit;
}

// Prende l'immagine mandata dal client
$filename = $data['filename'];
$imageData = $data['imageData'];

// Rimuove l'URL dal nome del file
$parts = explode(',', $imageData);
$imageData = base64_decode($parts[1]);

// Controlla la grandezza del file e rifiuta il file se troppo grande
$maxFileSize = 3 * 1024 * 1024; // 3MB in bytes
if (strlen($imageData) > $maxFileSize) {
  $response = array('success' => false, 'message' => 'File size exceeds the limit.');
  echo json_encode($response);
  exit;
}

// Controlla l'estensione del file (solo estensioni per immagini)
$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
$extension = pathinfo($filename, PATHINFO_EXTENSION);
if (!in_array(strtolower($extension), $allowedExtensions)) {
  $response = array('success' => false, 'message' => 'Invalid file extension.');
  echo json_encode($response);
  exit;
}

$filename = "img/" . $filename;

// Salva l'immagine sul server nella cartella /var/www/html/img
if (file_put_contents($filename, $imageData)) {
  // Immagine salvata con successo
  $response = array('success' => true, 'message' => 'Image saved successfully as ' . $filename);
  echo json_encode($response);
} else {
  // Error salvataggio immagine fallito
  $response = array('success' => false, 'message' => 'Failed to save the image.');
  echo json_encode($response);
}
?>