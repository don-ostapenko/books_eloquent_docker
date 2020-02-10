if (parseInt(document.getElementById("counter").innerHTML) !== 0) {
    setInterval(function () {
        countdown();
    }, 1000);
}

// isbn.oninput = function() {
//     document.getElementById('count').innerHTML = this.value.length;
// };

function countdown() {
    var i = document.getElementById("counter");
    if (parseInt(i.innerHTML) !== 0) {
        i.innerHTML = parseInt(i.innerHTML) - 1;
    }
}