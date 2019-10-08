
<html>
<head>
  <meta charset="utf-8">
  <title>Consultation</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/consultations.css">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/b4a00e2cdb.js"></script>
<!--  <script type="text/javascript" src="js/consultation_comment.js"></script>-->
  <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="intro">
  <div class="css_intro">
    <div>
      <?php if ($controller=='welcome' | $controller=='consultation_detail'){?>
      <h1 class="header_title">Consultations</h1>
      <?php } elseif ($controller=='public_consultation'){?>
      <h1 class="header_title">Public Consultation</h1>
      <?php } elseif ($controller=='consultation_comment'){?>
      <h1 class="header_title">Thread - <?php echo ucfirst($thread);?> Consultation</h1>
      <?php }?>
      <p class="header_intro" style="width: 80%">Through public consultations you can express your view on the scope, priorities and
        added value of EU action for new initiatives, or evaluations of existing policies and laws.<br><br></p>
    </div>
  </div>
</div>
<div style="padding: 0px">
  <nav class="css_intro">
    <ul>
      <li><a href="" id="Home">Home</a></li>
      <li>&nbsp;&gt;&nbsp; </li>
      <?php if ($controller=='welcome'){?>
        <li>Consultations</li>
      <?php }?>
      <?php if ($controller=='consultation_detail' | $controller=='public_consultation' | $controller=='consultation_comment'){?>
        <li><a href="./index.php" target="_self" id="Consultations">Consultations</a></li>
      <?php }?>
      <?php if ($controller=='consultation_detail'){?>
        <li>&nbsp;&gt;&nbsp; </li>
        <li>Consultation details</li>
      <?php }?>
      <?php if ($controller=='public_consultation' | $controller=='consultation_comment'){?>
        <li>&nbsp;&gt;&nbsp; </li>
        <li><a href="./index.php?c=consultation_detail&m=index&c_id=<?php echo $c_id;?>" id="Consultation_detail">Consultation details</a></li>
      <?php }?>
      <?php if ($controller=='public_consultation'){?>
        <li>&nbsp;&gt;&nbsp; </li>
        <li>Public Consultation</li>
      <?php }?>
      <?php if ($controller=='consultation_comment'){?>
        <li>&nbsp;&gt;&nbsp; </li>
        <li><a href="./index.php?c=public_consultation&m=index&c_id=<?php echo $c_id;?>" id="Consultation_detail">Public Consultation</a></li>
      <?php }?>
      <?php if ($controller=='consultation_comment'){?>
        <li>&nbsp;&gt;&nbsp; </li>
        <li><?php echo ucfirst($thread);?> Consultation</li>
      <?php }?>
    </ul>
    <br><br><hr>
  </nav>
</div>
