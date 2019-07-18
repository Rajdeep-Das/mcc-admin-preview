<?php

// Convert values into number


$file_name = $_FILES['fileToUpload']['name'];
$file_size = $_FILES['fileToUpload']['size'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];
$file_type = $_FILES['fileToUpload']['type'];

// Extract the file extension
$file_name_ext=explode('.',$_FILES['fileToUpload']['name']);
$file_name_ext=end($file_name_ext);
$file_ext = strtolower($file_name_ext);

$maxImageWidth = 520; 	// Max width for the image
$maxImageHeight = 390;  // Max height for the image
$ratio = 0;  			// Used for aspect ratio; currently not in use

		// Used for aspect ratio; currently not in use

if(empty($_FILES["fileToUpload"]))
{
	echo "Image field cannot be empty.";
	return;
}

// Reject non-image files
if((getimagesize($_FILES['fileToUpload']['tmp_name'])) == false)
{
	echo "Kindly select an image file of accepted format.";
	return;
}
echo $file_type;
// // Get image dimensions and type
// list($imagewidth, $imageheight, $imageType) = getimagesize($_FILES['fileToUpload']['tmp_name']); 

// // Create a true-color blank-image/place-holder of desired dimension
// $newImage = imagecreatetruecolor($maxImageWidth,$maxImageHeight);	

// $imageType = image_type_to_mime_type($imageType);
// $source=imagecreatefromjpeg($_FILES['fileToUpload']['tmp_name']); 
// //imagecopyresampled($newImage,$source,0,0,$x_co,$y_co,$maxImageWidth,$maxImageHeight,$widthCropped,$heightCropped);
// $image = 'image';
// $image = $image.'.jpg';
// $imageWrite = "./images/$image";
// // Write the '$newImage' in disk
// imagejpeg($newImage,$imageWrite,75);
?>