<?php
require 'vendor/autoload.php';
use fin1te\SafeCurl\SafeCurl;
use fin1te\SafeCurl\Exception;
use fin1te\SafeCurl\Options;
use League\HTMLToMarkdown\HtmlConverter;
$markdown = '';
$html = '';
if(isset($_POST) && isset($_POST['url'])){
    $dowloaded = false;
    try {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_USERAGENT, 'Mozilla/5.0 (SafeCurl)');
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        $options = new Options();
        $whitelist = array('ip'     => array(),
            'port'   => array('80','443'),
            'domain' => array(),
            'scheme' => array('http', 'https'));

        $blacklist = array('ip'     => array('10.0.0.0/8',     '100.64.0.0/10',
                            '127.0.0.0/8',    '169.254.0.0/16', '172.16.0.0/12',
                            '192.0.0.0/29',   '192.0.2.0/24',   '192.88.99.0/24',
                            '192.168.0.0/16', '198.18.0.0/15',  '198.51.100.0/24',
                            '203.0.113.0/24', '224.0.0.0/4',    '240.0.0.0/4',
                            gethostbyname($settings['blacklist_domain']
                            )),
            'port'   => array(),
            'domain' => array(preg_quote($settings['blacklist_domain']).'\.?'),
            'scheme' => array());
        $options->setList('blacklist', $blacklist);
        $options->setList('whitelist', $whitelist);

        $data['result'] = SafeCurl::execute($_POST['url'], $curlHandle, $options);
        $dowloaded = true;
        }
        catch (fin1te\SafeCurl\Exception $e) {
                $data['result'] =  $e->getMessage();
            }

        $converter = new HtmlConverter();
        $converter->getConfig()->setOption('strip_tags', true);
        $html = $data['result'];
        $markdown = $converter->convert($html);


}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>HTML to Markdown convertor</title>
  </head>
  <body>
    <div class="container">
        <h1>You can dowload the page and convert it to makdown.</h1>

        <div class="row">
            <div class="col-md">
                <form method="post">
                  <div class="form-group">
                    <label for="exampleInputURL1">Page URL</label>
                    <input type="url" class="form-control" id="exampleInputURL1" aria-describedby="urlHelp" placeholder="Enter url" name="url" value="<?=@$_POST['url']?>">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div><div class="col-md"></div>
        </div>
        <div class="row"></div>
        <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label for="htmltext">HTML</label>:
                <textarea id="htmltext" class="form-control" rows="15"><?=htmlentities($html);?></textarea>
              </div>
            </div>
            <div class="col-md">
              <label for="markdowntext">Markdown</label>:
              <div class="form-group">
                <textarea id="markdowntext" class="form-control" rows="15"><?=htmlentities($markdown);?></textarea>
              </div>
        </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://esironal.github.io/cmtouch/lib/codemirror.css">
    <link rel="stylesheet" href="http://esironal.github.io/cmtouch/addon/hint/show-hint.css">

  </body>
</html>
