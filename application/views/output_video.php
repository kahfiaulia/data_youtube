
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

    function get_video_detail($idVideo){
        #Ambil data detail video dari playlist channel
        $apikey = 'AIzaSyBbuY-ppNRH5i9oXuNSUbnDRD_2FiALdEA'; 
        $urlGetVideoDetail = 'https://www.googleapis.com/youtube/v3/videos?part=statistics,contentDetails,snippet&id=' . $idVideo . '&key=' . $apikey;
        $value = get_curl($urlGetVideoDetail);

        $thumbnailVideo = $value['items'][0]['snippet']['thumbnails']['default']['url'];
        $judulVideo = $value['items'][0]['snippet']['title'];
        $tanggalUploadVideo = $value['items'][0]['snippet']['publishedAt'];
        $durasiVideo = new \DateInterval($value['items'][0]['contentDetails']['duration']);
        $jumlahViewVideo = $value['items'][0]['statistics']['viewCount'];
        $jumlahLikeVideo = $value['items'][0]['statistics']['likeCount'];
        $jumlahDislikeVideo = $value['items'][0]['statistics']['dislikeCount'];
        $jumlahFavoritVideo = $value['items'][0]['statistics']['favoriteCount'];
        $jumlahCommentVideo = $value['items'][0]['statistics']['commentCount'];

        echo 'ID Video: '. $idVideo. '<br>';
        echo 'Thumbnail Video: <img src='. $thumbnailVideo. ' alt=""><br>';
        echo 'Judul Video: '. $judulVideo. '<br>';
        echo 'Tanggal Upload Video:'. date('Y-m-d  h:i:sa', strtotime($tanggalUploadVideo)) . "<br>";
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
    <?php     
        get_video_detail($idVideo);
    ?>
</body>

</html>
