<?php
function get_curl($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, true);
}

$result = get_curl('https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&id=UCrDpcBofGGMLsAmxtjZBHlQ&key=AIzaSyB5CexAxWjzUn8c0g-iQheIRkKB6zreFjQ');

$id = $result['items'][0]['id'];
$nama= $result['items'][0]['snippet']['title'];
$fotoProfil = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$deskripsi = $result['items'][0]['snippet']['description'];
$tanggalPembuatan = $result['items'][0]['snippet']['publishedAt'];
$jumlahView = $result['items'][0]['statistics']['viewCount'];
$jumlahSubscriber = $result['items'][0]['statistics']['subscriberCount'];
$jumlahVideo = $result['items'][0]['statistics']['videoCount'];
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