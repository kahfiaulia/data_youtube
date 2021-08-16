
<?php
function get_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $value = curl_exec($ch);
    curl_close($ch);

    return json_decode($value, true);
}

$apikey = 'AIzaSyBbuY-ppNRH5i9oXuNSUbnDRD_2FiALdEA';
// UCrDpcBofGGMLsAmxtjZBHlQ
	#Ambil data channel berdasarkan id channel
    $value = get_curl('https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&id=' . $id . '&key=' . $apikey);
    $id = $value['items'][0]['id'];
    $nama= $value['items'][0]['snippet']['title'];
    $fotoProfil = $value['items'][0]['snippet']['thumbnails']['medium']['url'];
    $deskripsi = $value['items'][0]['snippet']['description'];
    $tanggalPembuatan = $value['items'][0]['snippet']['publishedAt'];
    $jumlahView = $value['items'][0]['statistics']['viewCount'];
    $jumlahSubscriber = $value['items'][0]['statistics']['subscriberCount'];
    $jumlahVideo = $value['items'][0]['statistics']['videoCount'];
    #Ambil data video dari playlist channel
    $idUpload = $value['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
    
    $pageToken = '';
    $urlGetVideo = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,contentDetails&playlistId=' . $idUpload . '&key=' . $apikey . '&maxResults='. $maxResults. '&pageToken='. $pageToken;
    $value = get_curl($urlGetVideo);

    function get_video_detail($idVideo){
        #Ambil data detail video dari playlist channel
        $apikey = 'AIzaSyBbuY-ppNRH5i9oXuNSUbnDRD_2FiALdEA'; 
        $urlGetVideoDetail = 'https://www.googleapis.com/youtube/v3/videos?part=statistics,contentDetails&id=' . $idVideo . '&key=' . $apikey;
        $value = get_curl($urlGetVideoDetail);

        $durasiVideo = new \DateInterval($value['items'][0]['contentDetails']['duration']);
        $jumlahViewVideo = $value['items'][0]['statistics']['viewCount'];
        $jumlahLikeVideo = $value['items'][0]['statistics']['likeCount'];
        $jumlahDislikeVideo = $value['items'][0]['statistics']['dislikeCount'];
        $jumlahFavoritVideo = $value['items'][0]['statistics']['favoriteCount'];
        $jumlahCommentVideo = $value['items'][0]['statistics']['commentCount'];
        echo 'Durasi:'. $durasiVideo->format('%H:%i:%s'). "<br>";
        echo 'Jumlah View: '.$jumlahViewVideo.'<br>';
        echo 'Jumlah Like: '.$jumlahLikeVideo.'<br>';
        echo 'Jumlah Dislike: '.$jumlahDislikeVideo.'<br>';
        echo 'Jumlah Favorit: '.$jumlahFavoritVideo.'<br>';
        echo 'Jumlah Komentar: '.$jumlahCommentVideo.'<br>';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Channel YouTube</title>
</head>
<!-- navbar -->
<nav class="navbar navbar-dark bg-dark navbar fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand page-scroll">HOME</a>
        </div>

    </nav>
<body>
    <div class="text-center mt-5">
        <div class="fw-bold">
            <h1><?php echo $nama; ?></h1>
        </div>
            <img src="<?php echo $fotoProfil; ?>" alt="">
            <br>
        <p class="font-monospace">ID : <a style="text-decoration:none;" href="https://www.youtube.com/channel/<?php echo $id;?>"><?php echo $id;?></a></p>
    </div>
    <div class="container" style="text-align: justify;">
    <b>Deskripsi Channel</b><br>
        <?php echo $deskripsi; ?>
    </div>
    <div class="container mt-3">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <tr>
                    <th scope="row">Tanggal Pembuatan Channel</th>
                    <td><?php echo date('Y-m-d  h:i:sa', strtotime($tanggalPembuatan)); ?></td>
                </tr>
            <tr>
                <tr>
                    <th scope="row">Jumlah View Channel</th>
                    <td><?php echo $jumlahView; ?></td>
                </tr>
            <tr>
                <tr>
                    <th scope="row">Jumlah Subscriber Channel</th>
                    <td><?php echo $jumlahSubscriber; ?></td>
                </tr>
            <tr>
                <tr>
                    <th scope="row">Jumlah Video</th>
                    <td><?php echo $jumlahVideo; ?></td>
                </tr>
            <tr>
        </tbody>
    </table>
    </div>
    <?php
        $i = 0;
        $idVideo = array();
        echo '<br>'; ?>
        <div class="container">
        <table class="table table-sm table-hover" style="width: 100%">
            <thead class="text-center">
                <tr>
                <th scope="col">No.</th>
                <th scope="col">ID Video</th>
                <th scope="col" style="width: 300px">Judul</th>
                <th scope="col">Thumbnail</th>
                <th scope="col" style="width: 200px">Tanggal Upload</th>
                <th scope="col">Statistik</th>
                </tr>
            </thead>
            <?php while($i <= $maxResults-1) { 
                $pageToken = $value['nextPageToken'];
                $idVideo = $value['items'][$i]['snippet']['resourceId']['videoId'];
                $thumbnailVideo = $value['items'][$i]['snippet']['thumbnails']['default']['url'];
                $judulVideo = $value['items'][$i]['snippet']['title'];
                $tanggalUploadVideo = $value['items'][$i]['snippet']['publishedAt'];   
            ?>
            <tbody>
                <tr>
                    <th class="text-center" scope="row"><?php echo $i+1; ?></th>
                    <td><?php echo $idVideo; ?></td>
                    <td><?php echo $judulVideo; ?></td>
                    <td class="text-center"><img src="<?php echo $thumbnailVideo; ?>" alt=""></td>
                    <td class="text-center"><?php echo date('Y-m-d  h:i:sa', strtotime($tanggalUploadVideo)); ?></td>
                    <td><?php get_video_detail($idVideo); ?></td>
                </tr>
            </tbody>
            <?php 
            $i+=1;
            }
            ?>
        </table>
        </div>
    <a href="">Next</a>
</body>

<style type="text/css">
body {
  background-image: url('/data_youtube/assets/bg2.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
img {
  border-radius: 10%;
}
</style>

</html>
