URLsynchroState = "server_synchrostate.php";
URLsynchroMove = "server_synchromove.php";




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

function sendMoveSynchro(mode,x1,y1,x2,y2){
	var message = "gameId="+GAMEID.toString() + "&";
	message += "mode="+mode.toString() + "&";
	message += "x1="+x1.toString() + "&";
	message += "y1="+y1.toString() + "&";
	message += "x2="+x2.toString() + "&";
	message += "y2="+y2.toString();

	httpRequest = new XMLHttpRequest();
    	httpRequest.open('POST', URLsynchroMove);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = function() {//Call a function when the state changes.
	    if(httpRequest.readyState == 4 && httpRequest.status == 200) {
	    		console.log("to sender gotten " + httpRequest.responseText);
			handleMessage(httpRequest.responseText);
		        }
		}
	httpRequest.send(message);
	}

function getGameStateSynchro(){
	message = "gameId=";
	message += GAMEID.toString();
	httpRequest = new XMLHttpRequest();
    	httpRequest.open('POST', URLsynchroState);
	httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = function() {//Call a function when the state changes.
	    if(httpRequest.readyState == 4 && httpRequest.status == 200) {
	    		console.log("to sender gotten " + httpRequest.responseText);
			handleMessage(httpRequest.responseText);
		        }
		}
	httpRequest.send(message);
	console.log("sent synchro : [" + message + "]");
	}
