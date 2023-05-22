<?php
// Retrieve the raw request body
$requestBody = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($requestBody, true);

if ($data === null || !isset($data['filename']) || !isset($data['imageData'])) {
  // Invalid request data
  $response = array('success' => false, 'message' => 'Invalid request data.');
  echo json_encode($response);
  exit;
}

// Retrieve the data sent from the client-side
$filename = $data['filename'];
$imageData = $data['imageData'];

// Remove the data URL prefix
$parts = explode(',', $imageData);
$imageData = base64_decode($parts[1]);

$filename = $filename;

// Save the image to the file system
if (file_put_contents($filename, $imageData)) {
  // Image saved successfully
  $response = array('success' => true, 'message' => 'Image saved successfully as '.$filename);
  echo json_encode($response);
} else {
  // Failed to save the image
  $response = array('success' => false, 'message' => 'Failed to save the image.');
  echo json_encode($response);
}
?>