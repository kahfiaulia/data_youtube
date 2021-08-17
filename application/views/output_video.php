
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
          <a href="https://data-youtube.herokuapp.com/" class="navbar-brand page-scroll">HOME</a>
        </div>
    </nav>

<body>
    <div class="text-center mt-5">
        <div class="fw-bold">
            <h3><?php echo $judulVideo; ?></h3>
        </div>
        <img src="<?php echo $thumbnailVideo; ?>" alt="" style="width:200px">
            <br>
        <p class="font-monospace">ID : <a style="text-decoration:none;" href="https://www.youtube.com/watch?v=<?php echo $idVideo; ?>"><?php echo $idVideo; ?></a></p>
    </div>
    <div class="container mt-3">
    <div class="row">
    <div class="column">
    <table class="table table-bordered border-info">
        <tbody>
            <tr>
            <tr>
                <th scope="row">Judul Video</th>
                <td><?php echo $judulVideo; ?></td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Tanggal Upload Video</th>
                <td><?php echo date('Y-m-d  h:i:sa', strtotime($tanggalUploadVideo)); ?></td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Durasi</th>
                <td><?php echo $durasiVideo->format('%H:%i:%s'); ?></td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Jumlah View Video</th>
                <td><?php echo $jumlahViewVideo; ?></td>
            </tr>
            <tr>
            </tbody>
    </table>
    </div>
    <div class="column">
        <table class="table table-bordered border-info">
            <tbody>
                <tr>
                    <tr>
                        <th scope="row">Jumlah Like Video</th>
                        <td><?php echo $jumlahLikeVideo; ?></td>
                    </tr>
                <tr>
                    <tr>
                        <th scope="row">Jumlah Dislike Video</th>
                        <td><?php echo $jumlahDislikeVideo; ?></td>
                    </tr>
                <tr>
                    <tr>
                        <th scope="row">Jumlah Favorit Video</th>
                        <td><?php echo $jumlahFavoritVideo; ?></td>
                    </tr>
                <tr>
                    <tr>
                        <th scope="row">Jumlah Komentar Video</th>
                        <td><?php echo $jumlahCommentVideo; ?></td>
                    </tr>
                <tr>
            </tbody>
        </table>
    </div>
</div>
    </div>
</body>
<!-- footer -->
<footer>
      <div class="container text-center">
        <div class="row">
          <div class="col-sm-12">
            <p>&copy; copyright 2021 | built by. <a href="#">ME</a>.</p>
          </div>
        </div>
        <div class="row">
        </div>
      </div>
    </footer>
    <!-- akhir footer -->

<style type="text/css">
body {
  background-image: url('/assets/bg2.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
img {
  border-radius: 10%;
}
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
footer {
  position: fixed;
  left: 0;
  bottom: 0px;
  width: 100%;
  height: 40px;
  background-color: #333;
  padding-top: 10px;
  text-align: center;
  }
footer p {
  color: #aaa;
  font-size: 0.9em;
}
nav{
  transition: transform 500ms ease-in-out;
}
</style>

</html>
