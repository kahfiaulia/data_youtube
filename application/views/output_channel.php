
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
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <th scope="row">Nama Channel</th>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Foto Profil Channel</th>
                <td><img src="<?php echo $fotoProfil; ?>" alt=""></td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Deskripsi Channel</th>
                <td><?php echo $deskripsi; ?></td>
            </tr>
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
    <?php
        $i = 0;
        $idVideo = array();
        echo '<br>'; ?>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">ID</th>
                <th scope="col" style="width: 500px">Judul</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Tanggal Upload</th>
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
                    <th scope="row"><?php echo $i+1; ?></th>
                    <td><?php echo $idVideo; ?></td>
                    <td><?php echo $judulVideo; ?></td>
                    <td><img src="<?php echo $thumbnailVideo; ?>" alt=""></td>
                    <td><?php echo date('Y-m-d  h:i:sa', strtotime($tanggalUploadVideo)); ?></td>
                    <td><?php get_video_detail($idVideo); ?></td>
                </tr>
            </tbody>
            <?php 
            $i+=1;
            }
            ?>
        </table>
    <a href="">Next</a>
</body>

</html>
