<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <?php echo link_tag (["rel"=>"icon", "type"=>"image/png", "href"=> "public/assets/img/favicon.png"]); ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> Fuela App: <?php if(!empty($title)) {echo $title; } else { echo "Home";} ?>  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <!-- CSS Files -->
  <?php echo link_tag(["href"=>"public/assets/css/material-dashboard-icon.css","rel"=>"stylesheet"]);?>
  <?php echo link_tag(["href"=>"public/assets/css/font-awesome.min.css","rel"=>"stylesheet"]);?>
  <?php echo link_tag(["href"=>"public/assets/css/material-dashboard.css?v=2.1.2","rel"=>"stylesheet"]);?>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <?php echo link_tag(["href"=>"public/assets/demo/demo.css", "rel"=>"stylesheet"])?>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <link  />
</head>

<body class="">
  <div class="wrapper ">