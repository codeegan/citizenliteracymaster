
/* Splash Screen */

function spalshHide() {
    document.getElementById("splash").classList.add("opacity");
}

function spalshDisplay() {
    document.getElementById("splash").style.display = "none";
}


/* Homepage Redirects */

function backToMain() {
	window.location.assign("index.html");
}

function handwritingUrl() {
    window.location.assign("handwriting.html");
}

function audioUrl() {
    window.location.assign("audio.html");
}

function voiceUrl() {
    window.location.assign("voice.html");
}

function selectionUrl() {
	window.location.assign("selection.html");
}

function nextUrl() {
    window.location.assign("index.html")
}


function init() {
	// Anything that you want to init ???
}

function fadeIn(){
    document.getElementsByTagName("BODY")[0].classList.add("bodyLoad");
}


/* Responses */

 function retryCorrect(){
     
     var element = document.getElementById("response-correct-container");
     element.classList.add("reverse-active");
     
     var element = document.getElementById("response-correct-container");
     element.classList.remove("correct-active");
     
     delay();
     
     function delay() {
        setTimeout(function(){
           var element = document.getElementById("response-correct-wrapper");
            element.classList.add("inactive");
        }, 500);
     };
   
 }

 function retryIncorrect(){
     
     var element = document.getElementById("response-incorrect-container");
     element.classList.add("reverse-active-incorrect");
     
     var element = document.getElementById("response-incorrect-container");
     element.classList.remove("incorrect-active");
     
     delay();
     
     function delay() {
        setTimeout(function(){
           var element = document.getElementById("response-incorrect-wrapper");
            element.classList.add("inactive");
        }, 500);
     };
   
 }