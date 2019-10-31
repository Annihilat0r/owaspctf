 $("#login-button").click(function(event){
		 event.preventDefault();


     postForm('/check.php')
       .then(data => check(data))
       .catch(error => console.error(error))

});




function postForm(url) {
  const formData = new FormData(document.querySelector('form'))
  $('form').fadeOut(1000);
  return fetch(url, {
    method: 'POST', // or 'PUT'
    body: formData  // a FormData will automatically set the 'Content-Type'
  })

  .then(response => response.text())

}

function check(data){
   if(data=="Wrong credentials"){
     $('form').fadeIn(1000);
     $('#answer').text(data);
     setTimeout(function(){ $('#answer').text("Input your username and password"); }, 3000);
   }else{
     $('.wrapper').addClass('form-success');
     $('#answer').text(data);
   }


}
