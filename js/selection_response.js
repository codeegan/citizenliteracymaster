var audioClip = document.getElementById("myAudio");

function playAudio() {
    audioClip.play();
}

function pauseAudio() {
    audioClip.pause();
}


function response1() {
    var response = document.getElementById("option1").value;
    var responseObj = {
        result: response
    };
    var JSONString = JSON.stringify(responseObj);
    console.log(JSONString);
    check();
};

function response2() {
    var response = document.getElementById("option2").value;
    var responseObj = {
        result: response
    };
    var JSONString = JSON.stringify(responseObj);
    console.log(JSONString);
    check();
};

function response3() {
    var response = document.getElementById("option3").value;
    var responseObj = {
        result: response
    };
    var JSONString = JSON.stringify(responseObj);
    console.log(JSONString);
    check();
};

function response4() {
    var response = document.getElementById("option4").value;
    var responseObj = {
        result: response
    };
    var JSONString = JSON.stringify(responseObj);
    console.log(JSONString);
    check();
};

function response5() {
    var response = document.getElementById("option5").value;
    var responseObj = {
        result: response
    };
    var JSONString = JSON.stringify(responseObj);
    console.log(JSONString);
    check();
};

function response6() {
    var response = document.getElementById("option6").value;
    var responseObj = {
        result: response
    };
    var JSONString = JSON.stringify(responseObj);
    console.log(JSONString);
    check();
};

// add check function to each response function 

function check() {

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
};
