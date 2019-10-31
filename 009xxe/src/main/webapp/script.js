$(document).ready(function () {
    var basicTimeline = anime.timeline(),
        doneTimeline = anime.timeline();
    var trigger = true;

    $('form .btn').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('first')) {
            trigger = false;
            $(this).removeClass('first').addClass('active');
            basicTimeline
                .add({
                    targets: 'button',
                    width: 65,
                    paddingLeft: 17,
                    paddingRight: 17,
                    translateX: 97,
                    scale: 1.2,
                    duration: 1500
                })
                .add({
                    targets: 'form input',
                    width: 370,
                    opacity: 1,
                    duration: 2000,
                    offset: '-=1500'
                })
                .add({
                    targets: 'form button img',
                    opacity: 1,
                    translateX: 15,
                    duration: 2000,
                    offset: '-=1700',
                    complete: function(anim) {
                        trigger = true;
                    }
                })
        } else if ($(this).hasClass('active') && trigger) {
            $(this).removeClass('active').addClass('done');
            doneTimeline
                .add({
                    targets: 'button',
                    translateX: 180,
                    duration: 1500,
                    scale: 1.2
                })
                .add({
                    targets: 'button img',
                    opacity: 0,
                    duration: 1000,
                    offset: '-=1200'
                })
                .add({
                    targets: 'button',
                    width: 187,
                    scale: 1.2,
                    translateX: -23,
                    duration: 1500,
                    offset: '-=1000'
                })
                .add({
                    targets: 'form input',
                    width: 0,
                    translateX: -193,
                    duration: 1500,
                    offset: '-=1500'
                })
                .add({
                    targets: 'form button .done',
                    opacity: 1,
                    duration: 1000,
                    offset: '-=1500'
                })
        }
    });

});

function submitform(){

  var xmlData = '<?xml version="1.0" encoding="UTF-8"?>';
     xmlData+='<msg>';
     xmlData+='<name>'+$('#name').val()+'</name>';
     xmlData+='<content>'+$('#message').val()+'</content>';
     xmlData+='</msg>';
  $.ajax({
     type: "PUT",
     url: "/rest/msgs/",
     data: xmlData,
     contentType: "application/xml",
     success: function(res) {
       $('#result').text(res);
     }
  });

};