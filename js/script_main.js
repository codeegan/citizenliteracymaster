/* Homepage Redirects */

function handwritingUrl() {
    window.location.assign("/handwriting.html")
}

function audioUrl() {
    window.location.assign("/selection.html")
}

function voiceUrl() {
    window.location.assign("/voice.html")
}

function nextUrl() {
    window.location.assign("index.html")
}

function fadeIn(){
    document.getElementsByTagName("BODY")[0].classList.add("bodyLoad");
}

/* Response */

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
