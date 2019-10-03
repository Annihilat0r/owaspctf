var body = '<main>	<header class="navbar">';
		body+='<input class="url" type="text" value="https://www.instagram.com/p/B2tn96foQEG/" placeholder="Paste address here">';
    body+='<button class="search" id="extractHtml">Render</button></header>';
	body+='<section class="result"><div class="no-image"></div>';
    body+='<p>On this page you can download images or <b>public</b> videos from Instagram accounts, in the application you can go to the image and to the right <b>(the 3 points)</b> in the menu you give it to copy image and paste it or if you are on the computer you just have to Copy the link.</p><p>To save an image from the mobile phone, press and hold until the menu comes out and then download the image if it is from the computer, simply right click save image.</p>';
body+='<p>To save a video from your mobile, click on the 3 dots and download and if you are on the computer, right click and save as.</p><p>This page does not save any information do not worry :).</p></section><footer>Made width ♥ <br>    If your link does not work - send it to me    <form action="feedback.php"></form>    <form action="feedback.php" method="post">      <input type="text" name="link">     <div class="g-recaptcha" data-sitekey="6LedRrsUAAAAAEvOjJlYFYWEcN4aN24owAFQ-1kw"></div> <input type="submit" name="">    </form></footer></main>';
// insert in body
document.body.innerHTML = body;

var render = document.querySelector('.result');

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('extractHtml')
          .addEventListener('click', function () {extractHtml()});
});


// create video
function createVideo(data){
  var v = document.createElement('video');
  v.id = "instavideo";
  v.src = data.content; // data.content
  v.controls = true;
  v.autoplay = true;

  // create info
  var info = document.createElement('p');
  info.textContent = "Click the right button on video and select save as.";

  render.innerHTML = ""; // clear body
  render.appendChild(v); // append video
  render.appendChild(info); // append link
};
// create image
function createImg(data){
  // create image
  var i = document.createElement('img');
  i.id = "instaImg";
  i.src = data.content;
  render.innerHTML = ""; // clear body
  render.appendChild(i); // append image
  }
function createDescription(data){
  // create info
  var info = document.createElement('p');
  info.innerHTML = data.content;
  render.appendChild(info); // append link

};

// extract html
function extractHtml() {

  render.innerHTML = "<div class='no-image'></div>";
  // get input value
  var url = document.querySelector('input').value;

  if (url) {

function reqListener () {
      render.innerHTML = this.responseText;
      // wait, find meta and create video or image
      var w = setTimeout(function(){
        var d = document.querySelector('meta[property="og:description"]');
        var v = document.querySelector('meta[property="og:video"]');
        if (v) {
          createVideo(v);
          createDescription(d);
        } else {
          var img = document.querySelector('meta[property="og:image"]');
          if (img) {
            createImg(img);
            createDescription(d);
          } else {
            document.body.innerHTML = body;
            alert('Error extracting Instagram image / video.');
          };
        }
        clearTimeout(w);
      }, 200);
    };
  var instaReq = new XMLHttpRequest();
instaReq.onload = reqListener;
instaReq.open("get", url, true);
instaReq.send();
} else {
    document.querySelector('input').setAttribute('placeholder', 'Invalid address, use a good');

  }
};

if (location.hash){
  document.querySelector('input').value="https://www.instagram.com/"+location.hash.substring(1);
  extractHtml();
}
