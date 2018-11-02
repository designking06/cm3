<?php
require_once('../require.php');
//comp.php
?>
<html>
<?php
getHead();
getHeader("creator");
?>
    <body class="w3-black">
    <div class="container text-center w3-padding w3-white" style="height:100%;">
        <div class="row w3-border-bottom">
        <a href="admin.php"><h2>Home</h2></a>
        </div>
        <div class="row w3-padding">

            <a href="embed.video.php">
                <div class="col-sm-12">
                  <div class="" style="max-width:100px;max-height:100px;margin:auto;">

                  </div>
                    <h3>Embed Youtube Video</h3>
                </div>
            </a>
        </div>
        <div class="row w3-padding">

            <a href="featured.video.php">
                <div class="col-sm-4">
                    <div class="" style="max-width:100px;max-height:100px;margin:auto;">
                    <img src="images/pencil.png" class="w3-image"></div>
                    <h3>Set Featured Video</h3>
                </div>
            </a>
    </div>
    </body>
<?php getFooter();?>
