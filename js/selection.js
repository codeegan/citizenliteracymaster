function postSelection(letter) {
	const API_URL = 'receive_selection.php';
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var response = JSON.parse(this.responseText);
            
            //Remove on prod
            console.log(response.status);

            if (response.status === true) {
                //success state
				
				// Don't forget to remove class that we will not use anymore 
                document.getElementById("response-container").classList.remove("incorrect");
				// After that append new class (same thing but in reverse for 'fail state')
				document.getElementById("response-container").classList.add("correct");				
            } else {
                //fail state
                document.getElementById("response-container").classList.remove("correct");
				document.getElementById("response-container").classList.add("incorrect");				
            };
        }
    };
	// Send async request 
    xmlhttp.open("POST", API_URL, true);
	// We want to send data as json
	xmlhttp.setRequestHeader("Content-Type", "application/json");
	// post values
    xmlhttp.send(JSON.stringify( { selectedLetter: letter } ));
}