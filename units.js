
boardSize = 14;

units = new Array(boardSize+1);
for(i=1;i<boardSize+1;i++){
	units[i] = new Array(boardSize+1);
	}
//todo add barricade array


targetURL = "gameServer.php";
evtSource = null;

function clearUnits(){
	for(i=1;i<=boardSize;i++){
		for(j=1;j<=boardSize;j++){
			units[i][j] = null;
			}
		}
	}

function renderUnits(){
	for(i=1;i<=boardSize;i++){
		for(j=1;j<=boardSize;j++){
			var baseId = i.toString() + " " + j.toString();
			var unit = units[i][j];
			if(unit==null){
				uiHideUnit(i,j);
				}
			else{
				uiShowUnit(i,j);
				uiSetUnit(i,j,unit);
				}
			}
		}
	}

function recordUnit(x,y,type,hp,moves,ammo){
	var unit = {"type": type, "hp": hp, "moves": moves, "ammo": ammo };
	units[x][y] = unit;
	}

function handleMessage(msg){
	console.log("handlemessage gotten " + msg);
	var sub = msg.split("|");
	console.log("gameid : " + sub[0]);
	if(sub[0]==GAMEID.toString){
		var list = sub[3].split(" ");
		var count = list.lenght;
		for(i=0;i<count;i++){
			var u = list[i];
			console.log("looking at " + u);
			u = u.split(";");
			recordUnit(u[0],u[1],u[2],u[3],u[4],u[5]);
			}
		renderUnits();
		}
	}

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

function requestGameState(){
	//format : S;gameId

	//todo : also send userId
	postRequest("gameId=1");
	}
