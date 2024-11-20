<?php
$accessToken = "YOUR_FACEBOOK_PAGE_ACCESS_TOKEN";
$pageId = "YOUR_FACEBOOK_PAGE_ID";
$imageUrl = "http://yourwebsite.com/uploads/" . $file_name; // URL dari file yang diunggah

$message = "Kegiatan baru: $nama_kegiatan";
$url = "https://graph.facebook.com/$pageId/photos";

$data = [
    'url' => $imageUrl,
    'message' => $message,
    'access_token' => $accessToken,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo "Posting berhasil: " . $response;
?>
