<!DOCTYPE html>
<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<!-- navbar -->
<nav class="navbar navbar-dark bg-dark navbar fixed-top ">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand page-scroll">HOME</a>
        </div>

    </nav>
    <!-- akhir navbar -->
    <body>
<form action ="/main/data_channel" method ="post">
<div class="container mb-5">
<h4 class="text-center mt-5">Search By ID Channel</h4>
  <div class="search1">
    <div class="form-group mb-0" >
      <input type="text" class="form-control text-center" id="id_channel" name="id_channel" placeholder="Insert ID Channel">
    </div>
    <div class="form-group mb-2 text-center">
      <label for="max_results" class="form-label mb-0">&</label>
      <input type="number" min="1" max="50" class="form-control text-center" id="max_results" name="max_results" placeholder="Max Number of Results (1-50)">
    </div>
    <div class="text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
</div>  

<hr class="solid">

<form action ="/main/data_video" method ="post" class="form-inline">
  <div class="container">
    <h4 class="text-center mt-3">Search By ID Video</h4>
      <div class="search1">
        <div class="form-group mb-2">
          <input type="text" class="form-control text-center" id="id_video" name="id_video" placeholder="Insert ID Video">
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-primary mb-3 ">Submit</button >
        </div>
</form>
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

  <!--css-->
<style type="text/css">
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
.search1 {
        margin: 10px auto 0px auto;
        width: 600px;
        padding: 10px;
        border: 1px solid #ccc;}
hr.solid {
  margin: 0 100px 50px 100px;
  border-top: 3px solid #000;
}
body {
  background-image: url('/assets/bg.jpg');
  background-repeat: no-repeatbg;
  background-attachment: fixed;
  background-size: cover;
}
</style>
</html>