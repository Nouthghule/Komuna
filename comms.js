URLsynchroState = "server_synchrostate.php";




function postRequest(message){
	httpRequest = new XMLHttpRequest();
    	httpRequest.open('POST', targetURL);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = function() {//Call a function when the state changes.
	    if(httpRequest.readyState == 4 && httpRequest.status == 200) {
	            alert(httpRequest.responseText);
		        }
		}
	httpRequest.send(message);
	console.log("sent " + message);
	}

function getGameStateSynchro(){
	message = "gameId=";
	message += GAMEID.toString();
	httpRequest = new XMLHttpRequest();
    	httpRequest.open('POST', URLsynchroState);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = function() {//Call a function when the state changes.
	    if(httpRequest.readyState == 4 && httpRequest.status == 200) {
	    		console.log("to sender gotten " + httpRequest.responceText);
			handleMessage(httpRequest.responseText);
		        }
		}
	httpRequest.send();
	console.log("sent " + message);
	}
