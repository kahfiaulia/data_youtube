<?php

    $apikey = 'AIzaSyBbuY-ppNRH5i9oXuNSUbnDRD_2FiALdEA'; 
    $id = 'UCrDpcBofGGMLsAmxtjZBHlQ';
    $googleApiUrl = 'https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&id=' . $id . '&key=' . $apikey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $value = json_decode(json_encode($data), true);
    
    $id = $value['items'][0]['id'];
    $nama= $value['items'][0]['snippet']['title'];
    $fotoProfil = $value['items'][0]['snippet']['thumbnails']['medium']['url'];
    $deskripsi = $value['items'][0]['snippet']['description'];
    $tanggalPembuatan = $value['items'][0]['snippet']['publishedAt'];
    $jumlahView = $value['items'][0]['statistics']['viewCount'];
    $jumlahSubscriber = $value['items'][0]['statistics']['subscriberCount'];
    $jumlahVideo = $value['items'][0]['statistics']['videoCount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Channel YouTube</title>
</head>
<body>
    <table class="table table-bordered">
    <tbody>
        <tr>
        <th scope="row">ID Channel</th>
        <td><?php echo $id;?></td>
        </tr>
        <tr>
        <th scope="row">Nama Channel</th>
        <td><?php echo $nama;?></td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Foto Profil Channel</th>
        <td><img src="<?php echo $fotoProfil;?>" alt=""></td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Deskripsi Channel</th>
        <td><?php echo $deskripsi;?></td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Tanggal Pembuatan Channel</th>
        <td><?php echo $tanggalPembuatan;?></td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Jumlah View Channel</th>
        <td><?php echo $jumlahView;?></td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Jumlah Subscriber Channel</th>
        <td><?php echo $jumlahSubscriber;?></td>
        </tr>
        <tr>
        <tr>
        <th scope="row">Jumlah Video</th>
        <td><?php echo $jumlahVideo;?></td>
        </tr>
        <tr>
    </tbody>
    </table>
</body>
</html>