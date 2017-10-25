colorKomunard = "#ff0000";
colorSoldier  = "#99bbff";
colorHighlight= "#ff00ff";
colorBackgroundNormal = "#ffffff";
colorBackgroundHouse = "#b3b3b3";
colorBackgroundHq = "#ff9999";
colorBackgroundSpawn = "#80ff80";
colorBackgroundBarricade = "#802b00";
borderSizeEmpty = "1px";
borderSizeWall = "10px";
loadedChar = "¤";
unloadedChar = " ";

/*
unit layout
---------------
| A  |   |  D |
| L  | M |  R |
---------------
*/

function uiHideUnit(x,y){
	var id = x + " " + y + "T"; 
	//document.getElementById(id).style.opacity = 0;
	document.getElementById(id).style.visibility="hidden";
	}
function uiShowUnit(x,y){
	var id = x + " " + y + "T";
	document.getElementById(id).style.visibility="visible"; 
	//document.getElementById(id).style.opacity = 1;
	}

function uiHighlightUnit(x,y){
	var id = x + " " + y + "T";
	console.log("highlight at " + id);
	document.getElementById(id).style.backgroundColor = colorHighlight;
	}

function uiLowlightUnit(x,y){
	var id = x + " " + y + "T";
	var unit = units[x][y];
	var color = "";
	if(unit.type == "2"){
		color = colorKomunard;
		}
	else{
		color = colorSoldier;
		}
	document.getElementById(id).style.backgroundColor = color;
	}

function uiSetUnit(x,y,unit){
	var rootId = x + " " + y;
	var defense = parseInt(unit.hp) % 4;
	var attack = Math.floor(parseInt(unit.hp)/4);
	if(defense!=0){
		attack++;
		}
	if(defense==0){
		defense=4;
		}
	var color;
	var ammoChar = loadedChar;
	if(unit.ammo == 0){
		ammoChar = unloadedChar;
		}
	if(unit.type == "2"){
		color = colorKomunard;
		}
	else{
		color = colorSoldier;
		}
	document.getElementById(rootId+"T").style.backgroundColor = color;
	document.getElementById(rootId+"A").innerHTML = attack;
	document.getElementById(rootId+"D").innerHTML = defense;
	if(unit.type==1){
		document.getElementById(rootId+"M").innerHTML = unit.moves;
		}
	document.getElementById(rootId+"R").innerHTML = ammoChar;
	document.getElementById(rootId+"L").innerHTML = ammoChar;
	}
function uiSetBarricade(x,y,flag){
	var rootId = x + " " + y;
	document.getElementById(rootId+"B").style.backgroundColor = colorBackgroundBarricade;
	}
function renderMap(){
	var str = returnMap();
	var arr = str.split(" ");
	var posInArr = 0;
	var i = 1
	
	for(;i<=14;i++){
		var j = 1;
		for(;j<=14;j++){
			var subStr = arr[posInArr];
			var styleStr = "";
			for(var x = 0;x<=3;x++){
				if(subStr[x]=="1"){
					styleStr+=borderSizeWall;
					}
				else{
					styleStr+=borderSizeEmpty;
					}
				styleStr+= " ";
				}
			var color = colorBackgroundNormal;
			if(subStr[5]==1){
				color = colorBackgroundHq;
				}
			else if(subStr[4]==1){
				color = colorBackgroundHouse;
				}
			else if(subStr[6]==1){
				color = colorBackgroundSpawn;
				}
			var id = j.toString() + " " + i.toString() + "B";
	//		window.alert("looking at " + id);
			cell = document.getElementById(id);
			cell.style.borderWidth = styleStr;
			cell.style.backgroundColor = color;

			posInArr++;
			}
		}
	}
function returnMap(){
	//neskutecna prasarna, sorry ! Nechtelo se mi resit stahovani souboru ze serveru.
	//vyznam bitu v poradi : zed nahore, zed vpravo, zed dole, zed vlevo, je uvnitr domu, je HQ, je Spawn
	map = 
	"1001000 1000000 1000000 1000000 1000000 1010000 1010000 1010000 1010000 1000000 1000000 1000001 1000000 1100000 " +
	"0001000 0000000 0010000 0010000 0000000 1010100 1010100 1010100 1110100 0001000 0000000 0000000 0010000 0110000 " +
	"0001000 0100000 1001100 1000100 0000000 1010000 1010000 1010000 1000000 0000000 0100000 0011100 1010100 1100100 " +
	"0001000 0100000 0011100 0110100 0101000 1001100 1000100 1100100 0001000 0010000 0010000 1010000 1000000 0100000 " +
	"0011000 0000000 1000000 1000000 0100000 0011100 0000100 0110100 0101000 1011100 1000100 1100100 0011000 0100000 " +
	"1001100 0000000 0100000 0101100 0001000 1000000 0010000 1010000 0000000 1100000 0001100 0000100 1100100 0101000 " +
	"0111100 0001000 0100000 0101100 0001000 0000000 1000110 1100110 0001000 0000000 0100000 0001100 0000100 0100000 " +
	"1001001 0000000 0000000 0100100 0001000 0100000 0001110 0100110 0001000 0000000 0110000 0001100 0100100 0101000 " +
	"0011000 0010000 0100000 0111100 0001000 0100000 0011110 0010110 0000000 0100000 1011100 0010100 0110100 0101000 " +
	"1001100 1100100 0001000 1000000 0000000 0010000 1000000 1000000 0000000 0000000 1010000 1010000 1010000 0100000 " +
	"0011100 0100100 0001000 0100000 0001100 1100100 0001000 0010000 0010000 0100000 1011100 1000100 1010100 0100000 " +
	"1011000 0010000 0000000 0100000 0011100 0100100 0001000 1000100 1000100 0000000 1000000 0110100 1001000 0100000 " +
	"1011100 1010100 0000000 0000000 1000000 0000000 0100000 0011100 0110100 0001000 0000000 1000000 0000000 0100000 " +
	"1011000 1010000 0010000 0010000 0010000 0010000 0010000 1010000 1010000 0010000 0010000 0010000 0010000 0110001 ";
	
	return map;
	}


