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
    GAMEID = 1; 
    SIDE = 1;
  </script>

  <script>
       
    highUnit = null;
    moveMode = 1;

    function canUse(unit){
    	var unit.
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

    	if(highUnit==null){
		if(!blankTarget){
			console.log("highing it.");
			highUnit = clickedId;
			uiHighlightUnit(x,y);
			}
		return;
		}
	
	if(clickedId==highUnit){
		highUnit = null;
		console.log("lowing it.");
		uiLowlightUnit(x,y);
		return;
		}
	
	if(blankTarget){
		splt = highUnit.split(" ");
		var oldX = splt[0];
		var oldY = splt[1];
		var isOkay;
		var cntr = 0;
		var distX = Math.abs(oldX - x);
		var distY = Math.abs(oldY - y);
		
		if(distX>1||distY>1){
			console.log("too far away");
			isOkay = 0;
			}
		else{
			if(distX>0){
				cntr++;
				}
			if(distY>0){
				cntr++;
				}
			if(cntr==1){
				console.log("okay move");
				isOkay = 1;
				}
			else{
				console.log("non okay move");
				isOkay = 0;
				}
			}

		if(isOkay){
			sendMoveSynchro(moveMode,oldX,oldY,x,y);
			}
		
		}
	


        
    }
    
    
  </script>
  </head>
  
  <body>
    <button onclick = "renderMap()">render</button>
    <button onclick = "getGameStateSynchro()">request</button>
    <button onclick = "clearUnits()">clear units</button>
    <button onclick = "renderUnits()">render units</button>

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
