var encoder = new GIFEncoder();
encoder.setRepeat(0);
encoder.setDelay(0);
var grabber = 0;
var canvasArray = [];

var lock = new PatternLock('#patternHolder', {
    allowRepeat: true,
    radius: 20,
    enableSetPattern: true,
    matrix: [3, 3],
    onDraw: function (pattern) {
        $('#workshop-pattern').val(pattern);
        $('#pattern-numbers').html(pattern.split("").join("-"));
    }
});

function setLockPattern(pattern) {
    lock.setPattern(pattern);
    $('#pattern-numbers').html(pattern.split("").join("-"));
}

$('#clear-pattern').on('click', function () {
    lock.reset();
    $('#workshop-pattern').val('');
    $('#workshop-pattern-gif').val('');
    $('#pattern-numbers').html('');
});

$('#patternHolder').on('mousedown', function () {
    var grabRate = 10;
    canvasArray = [];
    encoder = new GIFEncoder();
    encoder.setRepeat(0);
    encoder.setDelay(0);
    encoder.start();
    var element = document.getElementById('patternHolder');
    grabber = setInterval(function () {
        html2canvas(element).then(function (canvas) {
            canvasArray.push(canvas);
        });
    }, grabRate);
});

$('#patternHolder').on('mouseup', function () {
    clearInterval(grabber);

    canvasArray.forEach(canvas => {
        encoder.addFrame(canvas.getContext('2d'));
    });

    encoder.finish();
    var binary_gif = encoder.stream().getData();
    var data_url = 'data:image/gif;base64,' + encode64(binary_gif);
    $('#workshop-pattern-gif').val(data_url);
    /*console.log(data_url);
    var img = document.createElement('img');
    img.src = data_url;
    document.body.appendChild(img);*/
});