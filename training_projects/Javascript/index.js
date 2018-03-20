var time = document.getElementsByTagName('time')[0],
milliseconds = 0, seconds = 0,
t;

function add() {
    milliseconds++;
    if (milliseconds >= 100) {
        milliseconds = 0;
        seconds++;
    }
    time.textContent = (seconds ? (seconds > 9 ? seconds : "0" + seconds) : "00") + "." + (milliseconds > 9 ? milliseconds : "0" + milliseconds);
    timer();
}

function timer() {
    t = setTimeout(add, 10);
}


function newShape() {
    var dim = Math.floor((Math.random() * 200) + 50)
    var head = Math.floor(Math.random() * 81) + "%"
    var left = Math.floor(Math.random() * 81) + "%"
    var colR = Math.floor(Math.random() * 256)
    var colG = Math.floor(Math.random() * 256)
    var colB = Math.floor(Math.random() * 256)

    if (Math.random() > 0.5) {
        document.getElementById("shape").style.borderRadius = "50%";
    } else {
        document.getElementById("shape").style.borderRadius = "0%";
    }

    document.getElementById("shape").style.display = "block";
    document.getElementById("shape").style.height = dim;
    document.getElementById("shape").style.width = dim;
    document.getElementById("shape").style.top = head;
    document.getElementById("shape").style.left = left;
    document.getElementById("shape").style.backgroundColor = "rgb(" + colR + "," + colG + "," + colB + ")";
    timer();
}

function delay() {
    setTimeout(newShape, Math.random() * 2000);
    milliseconds = 0, seconds = 0;
}

delay();
document.getElementById("shape").onclick = function() {
    document.getElementById("shape").style.display = "none";
    clearTimeout(t);
    delay();
}
