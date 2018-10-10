window.addEventListener('load', function() {
	const API_URL = 'receive_voice.php';
	var player = document.getElementById('player');
	var recordButton = document.getElementById('record');
	var stopButton = document.getElementById('stop');
	var playButton = document.getElementById('play');
	var soundClips = document.getElementById('soundClips');
	
	stopButton.disabled = true;
	
	try {
		const audioConstraints = {audio: true, video: false};
		let chunks = [];
		
		// Cross platform UserMedia
		navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
		var mediaRecorder;
		
		var handleSuccess = function(stream) {
			console.log('Success');

			var options;
			if (MediaRecorder.isTypeSupported('audio/webm;codecs=opus')) {
				options = {mimeType: 'audio/webm;codecs=opus'};
			} else if(MediaRecorder.isTypeSupported('audio/webm')) {
				options = {mimeType: 'audio/webm'};
			} else if(MediaRecorder.isTypeSupported('audio/webm;codecs=pcm')) {
				options = {mimeType: 'audio/webm;codecs=pcm'};
			} else if (MediaRecorder.isTypeSupported('audio/ogg;codecs=opus')) {
				options = {mimeType: 'audio/ogg;codecs=opus'};
			}
			else { throw "Unsuported media type"; }
			
			console.log("Options: ", options);
			
			mediaRecorder = new MediaRecorder(stream, options);
			
			recordButton.onclick = function() {
				mediaRecorder.start();
				recordButton.disabled = true;
				stopButton.disabled = false;
			}

			stopButton.onclick = function() {
				mediaRecorder.stop();
				recordButton.disabled = false;
				stopButton.disabled = true;
			}
			
			mediaRecorder.ondataavailable = function(e) {
				chunks.push(e.data);
				console.log(e);
			}
			
			
			mediaRecorder.onstop = function(e) {
				console.log("data available after MediaRecorder.stop() called.");

				var clipName = prompt('Enter a name for your sound clip');

				var clipContainer = document.createElement('article');
				var clipLabel = document.createElement('p');
				var audio = document.createElement('audio');
				var deleteButton = document.createElement('button');
				var uploadButton = document.createElement('button');
				

				clipContainer.classList.add('clip');
				audio.setAttribute('controls', '');
				uploadButton.innerHTML = "Upload";
				uploadButton.className = 'btn-main';
				deleteButton.innerHTML = "Delete";				
				clipLabel.innerHTML = clipName;

				clipContainer.appendChild(audio);
				clipContainer.appendChild(clipLabel);
				clipContainer.appendChild(uploadButton);
				clipContainer.appendChild(deleteButton);
				soundClips.appendChild(clipContainer);

				audio.controls = true;
				var blob = new Blob(chunks, { 'type' : options.mimeType });
				chunks = [];
				
				var audioURL = ( window.URL || window.webkitURL ).createObjectURL(blob);
				audio.src = audioURL;

				uploadButton.onclick = function(e) {
					// Get previous node text (filename)
					var filename = this.previousSibling.innerHTML;
					
					// Create and execute ajax request 
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							console.log(this.responseText);
							var response = JSON.parse(this.responseText);
						   
							// To Remove on prod
							console.log(response.status);

							if (response.status === true) {
								alert("Save Ok. Filename: " + response.name)
							} else {
								//show try again
								console.log(response.error);
							};
						}
					};
					// Make an form data object and send them to the remote server
					var formData = new FormData();
					formData.append("voice_file", blob, filename);
					xmlhttp.open("POST", API_URL, true);
					xmlhttp.send(formData);
				}
				
				deleteButton.onclick = function(e) {
					evtTgt = e.target;
					evtTgt.parentNode.parentNode.removeChild(evtTgt.parentNode);
				}
				console.log(blob);
			}
			
		};

		function handleError(error) {
			console.log('err callback: ', error);
		}
		
		
		navigator.mediaDevices.getUserMedia({ audio: true, video: false })
			.then(handleSuccess)
			.catch(handleError);
			
	} catch(err) {
		console.log(e);
		alert('Opps.. Your browser do not support audio API');
	}
			
}, false);