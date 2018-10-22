var canvas = document.getElementById("canvas");
var context = canvas.getContext('2d');
context.fillStyle = '#fff';
context.fillRect(0, 0, canvas.width, canvas.height);

var signaturePad = new SignaturePad(canvas, {
    minWidth: 2,
    maxWidth: 3,
    backgroundColor: "rgb(255,255,255)",
    penColor: "navy"
});
var encoder = new GIFEncoder();
encoder.setRepeat(0);
encoder.setDelay(0);
var grabber = 0;

function resizeCanvas() {
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    signaturePad.clear();
    /*var content = $('#workshop-pattern').val();
    signaturePad.fromDataURL(content);*/
}

window.addEventListener("resize", resizeCanvas);
resizeCanvas();

$('#clear-canvas').on('click', function () {
    signaturePad.clear();
    $('#workshop-pattern').val(null);
});

$('canvas').on('mousedown', function () {
    var context = canvas.getContext('2d');
    var grabRate = 100; // Miliseconds. 500 = half a second
    var count = 0;

    encoder = new GIFEncoder();
    encoder.setRepeat(0);
    encoder.setDelay(0);
    encoder.setTransparent('0xFFFFFF');
    encoder.start();

    grabber = setInterval(function () {
        count++;
        encoder.addFrame(context);
    }, grabRate);
});

$('canvas').on('mouseup', function () {
    /*var content = signaturePad.toDataURL();
    $('#workshop-pattern').val(content);*/
    clearInterval(grabber);
    encoder.finish();
    var binary_gif = encoder.stream().getData();
    var data_url = 'data:image/gif;base64,' + encode64(binary_gif);
    $('#workshop-pattern').val(data_url);
});

$(document).ready(function () {
    
});
