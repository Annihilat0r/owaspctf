<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creating an Image Zoom Library With Vanilla JavaScript</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="demo.css">
    <link rel="stylesheet" href="vanilla-zoom/vanilla-zoom.css">


  </head>
  <body>

    <div class="container">

        <h1>Vanilla JS Image Zoom Plugin</h1>
        <h3>
          Upload new photo:</a>
          <form action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">

      <input type="submit" value="Upload Image" name="submit">

      <center><div class="g-recaptcha" data-sitekey="6LedRrsUAAAAAEvOjJlYFYWEcN4aN24owAFQ-1kw"></center>
  </form></h3>

        <p>Select an image by clicking on the previews. Hover on the large image to inspect it in detail.</p>

        <div id="my-gallery" class="vanilla-zoom">
            <div class="sidebar">
              <?php

              $files = glob('images/*.{jpg,png,gif}', GLOB_BRACE);
              $files=array_slice($files, -3, 3, true);
              foreach($files as $file) {
                print('<img src="'.$file.'" class="small-preview">');
              }

               ?>

            </div>
            <div class="zoomed-image"></div>
        </div>

    </div>

    <script src="vanilla-zoom/vanilla-zoom.js"></script>
    <script>
        vanillaZoom.init('#my-gallery');
    </script>

    <!-- Only used for the demos ads. Please ignore and remove. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.tutorialzine.com/misc/enhance/v3.js" async></script>
  </body>
</html>
