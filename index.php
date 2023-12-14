<?php
require_once ('config.php');
// https://www.youtube.com/watch?v=M4jde7THXAI&ab_channel=VicodeMedia
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Platinum Songs Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      .container{
        height: 200px;
        border: 0px solid black;
        display: flex;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
    <img src="img/logo.png" alt="logo" style="display: table;margin:0 auto; max-width: 150px;"/>  
    </div>
    <div class="container" style="margin-top: 10px;">

            
            <form action='' method="POST" style=" 
            display: block;
            width: 100px;
            margin: 0 auto;
            margin-top:10px;">
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo $login_url;?>'">Login with Google</button>
            </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>