let recordButton = document.getElementById('record');
let stopButton = document.getElementById('stop');
let playButton = document.getElementById('play');


let audio = new Audio();
playButton.disabled;

const audioContext = window.AudioContext || webKit.AudioContext;

const audioCtx = new AudioContext();

const audioConstraints = {
    audio: true,
    video: false
};
let chunks = [];

successCallBack = function (audioStream) {

    let mediaRecorder = new MediaRecorder(audioStream);

    recordButton.onclick = function () {
        mediaRecorder.start();
        setTimeout(function () {
            mediaRecorder.stop();
        }, 3000);
        document.getElementById("left-load").classList.add("left-load-block-animation");
        document.getElementById("right-load").classList.add("right-load-block-animation");
        setTimeout(function () {
            
            document.getElementById("left-load").classList.remove("left-load-block-animation");
            document.getElementById("right-load").classList.remove("right-load-block-animation");


            // Test API
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    var response = JSON.parse(this.responseText);

                    // To Remove on prod
                    console.log(response.status);

                    if (response.status === true) {

                        var element = document.getElementById("response-correct-container");
                        element.classList.remove("reverse-active");
                        var element = document.getElementById("response-correct-wrapper");
                        element.classList.remove("inactive");
                        var element = document.getElementById("response-correct-container");
                        element.classList.add("correct-active");
                        var element = document.getElementById("response-correct-wrapper");
                        element.classList.add("correct-wrapper");

                    } else {
                        var element = document.getElementById("response-incorrect-container");
                        element.classList.remove("reverse-active");
                        var element = document.getElementById("response-incorrect-wrapper");
                        element.classList.remove("inactive");
                        var element = document.getElementById("response-incorrect-container");
                        element.classList.add("incorrect-active");
                        var element = document.getElementById("response-incorrect-wrapper");
                        element.classList.add("incorrect-wrapper");
                    };
                }
            };
            xmlhttp.open("GET", "response.json", true);
            xmlhttp.send();

        }, 3001);

    }

    // Not needed as stop is set above after Timeout function
    //stopButton.onclick = function () {
    //    mediaRecorder.stop();
    //}


    mediaRecorder.onstop = function (e) {

        let blob = new Blob(chunks, {
            'type': 'audio/ogg; codecs=opus'
        });
        chunks = [];
        const audioURL = window.URL.createObjectURL(blob);
        audio.src = audioURL;
        playButton.enabled;
        console.log(blob);
    }

    playButton.onclick = function () {
        audio.play();
    }

    mediaRecorder.ondataavailable = function (e) {
        chunks.push(e.data);
    }
}

function errorCallBack(streamError) {}


if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia(audioConstraints).then(successCallBack, errorCallBack);
} else {}
