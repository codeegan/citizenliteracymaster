// Inject 'back to main' button
window.addEventListener('load', function() {
	// Do nothing for main page 
	if((window.location + "").endsWith('index.html')) return;
	// 1. Create the button
	var button = document.createElement("button");
	button.innerHTML = "Back to main";
	button.className = "btn-main";

	// 2. Append somewhere
	var body = document.getElementsByTagName("body")[0];
	body.appendChild(button);

	// 3. Add event handler
	button.addEventListener ("click", backToMain);

});

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

function init() {
	// Anything that you want to init ???
}

function fadeIn(){
    document.getElementsByTagName("BODY")[0].classList.add("bodyLoad");
}
