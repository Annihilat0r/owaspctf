function handleFiles(files) {
  ([...files]).forEach(uploadFile)
}

function uploadFile(file) {
  let url = 'upload.php'
  let formData = new FormData()

  formData.append('file', file);

  fetch(url, {
    method: 'POST',
    body: formData
  })
  .then(() => { /* Готово. Информируем пользователя */ })
  .catch(() => { /* Ошибка. Информируем пользователя */ })
}


$(function () {

    var totalTime = 6, // seconds
        percent = 0,
        $sIcon = $('.success-icon'),
        $sText = $('.success-text'),
        $info = $('.timer-info'),
        $bar = $('.timer-bar'),
        $dropZone = $('.drop-zone'),
        dropZone = $('.drop-zone')[0],
        width = $dropZone.width(),
        countdown,
        countdownOver = false;

    var startCountdown = function () {
        $dropZone.css('border', 'none');
        $dropZone.addClass('timer-bar-wrapper');
        $info.text('0%');
        countdown = setInterval(updateBar, 25);
    };

    $(window).resize(function () {
        if (countdownOver) {
            width = $dropZone.width();
            $dropZone.css('height', width);
        }
    });

    var fileStatus = function () {
        $sIcon
            .addClass('up')
            .delay(250)
            .fadeTo(250, 1, 'swing');
        $sText
            .text('File uploaded')
            .delay(500)
            .fadeTo(350, 1, 'swing');
        $dropZone.css('transition', 'none');
    };

    var triggerFinish = function () {
        $dropZone
            .css('height', width)
            .addClass('expand');
        $info.fadeTo(250, 0, 'swing');
        setTimeout(fileStatus, 700);
    };

    var stopCountdown = function () {
        clearInterval(countdown);
        $('.timer-info').text('100%');
        triggerFinish();
    };

    var updateBar = function () {
        percent++;
        // /40, because it's called every 25ms
        // -> 25ms * 40 = 1 sec
        var per = (100 * percent / totalTime) / 40;
        $bar.css('width', per + '%');
        $info
            .css('left', per + '%')
            .text(per.toFixed(1) + '%');
        if (per >= 100) {
            stopCountdown();
            countdownOver = true;
        }
    };


    dropZone.addEventListener('dragover', function (e) {
        
        e.stopPropagation();
        e.preventDefault();
    });
    dropZone.addEventListener('drop', function (e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        e.stopPropagation();
        e.preventDefault();
        handleFiles(files);
        setTimeout(startCountdown, 250)
    });
});
