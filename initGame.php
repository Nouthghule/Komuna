<?php

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>boardtest</title>

  <script src = "uiUtils.js"></script>
  <script src = "units.js"></script>
  <script src = "comms.js"></script>


  <script>
	
	
	
	function prepare(){
		renderMap();
		clearUnits();
		renderUnits();
		updateDesc();
		}

	window.onload = prepare;
	
	left_barricade = 5;
	left_unit      = 10;
	placingUnit    = 1;

	function getNewUnit(){
		var unit = {"type": 2, "hp": 12, "moves": 0, "ammo": 0};
		return unit;
		}

	function switchState(){
		placingUnit = 1 - placingUnit;
		updateDesc();
		}
	
	function updateDesc(){
			if(placingUnit){
				document.getElementById("stateDesc").innerHTML = "jednotku";			
				}
			else{
				document.getElementById("stateDesc").innerHTML = "barikadu";			
				}
			document.getElementById("barCnt").innerHTML = left_unit;
			document.getElementById("unitCnt").innerHTML = left_barricade;
			}



	function doClick(clickedId) {
		console.log("gotten click at " +clickedId);
		var splt = clickedId.split(" ");
		var x = parseInt(splt[0]);
		var y = parseInt(splt[1]);

		var blankTarget = 0;

		if(units[x][y]==null){
			blankTarget = 1;
			}

		if(placingUnit){
			if(blankTarget&&(left_unit>0)){
				var unit = getNewUnit();
				units[x][y] = unit;
				renderUnits();
				left_unit = left_unit-1;
				updateDesc();
				}
			else{
				units[x][y] = null;
				renderUnits();
				left_unit = left_unit+l;
				updateDesc();
				}
			}
		}




  </script>
  </head>
  
  <body>

    Momentalne umistujes <span id="stateDesc"></span>    <button onclick = "switchState()">Zmenit</button> <br>
    Jeste muzes umistit : <span id="barCnt"></span> jednotek a <span id="unitCnt"></span> barikad. <br>

    <?php
    $row = 1;
    $col = 1;
    $maxRow = 14;
    $maxCol = 14;
    $A = "A";
    $D = "D";
    $M = "M";
    $T = "T";
    $B = "B";
    $L = "L";
    $R = "R";
    
    
    echo "<table id='boardTable' align = 'center' style = 'border-style : solid' border = 1 cellpadding=3>\n"; 
    do {
      echo "<tr>";
      $col = 1;
      do {
        echo "<td align = 'center' id='$col $row$B' style='border-style:solid;width:60px;height:60px'>" ;
        echo "<span style='opacity : 1' id='$col $row' onclick='doClick(this.id)'>";
        echo "<table border = 0 id='$col $row$T' bgcolor='#00FF00'>";
        $sum = $col+$row;
        echo "<tr><td id='$col $row$A'>$sum</td><td></td><td id='$col $row$D'>d</td></tr>";
        echo "<tr><td id='$col $row$L'>¤</td><td id='$col $row$M'>m</td><td id='$col $row$R'>¤</td></tr>";
        echo "</table>"; 
        echo "</span  ></td>";
        $col = $col + 1;
        } while($col <= $maxCol);
      echo("</tr>");
    $row++;
    } while($row <= $maxRow);
    echo "</table>"

    ?>
  
  </body>
</html>
