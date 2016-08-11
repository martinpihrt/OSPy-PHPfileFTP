<?php
include "stavy.php"; 

if(isset($_POST['tlacitko']))
  {
    $akce = $_POST['tlacitko'];  
  
    for( $i= 1 ; $i <= $output ; $i++ ){         // station xx ON
      if ($akce == "Z$i") { $prikaz = "Z$i"; }
      }

    for( $i= 1 ; $i <= $output ; $i++ ){         // station xx OFF
      if ($akce == "V$i") { $prikaz = "V$i"; }
      }

    if ($akce == "manu"){ $prikaz = "MA"; }      // manual ON
    if ($akce == "auto"){ $prikaz = "AU"; }      // scheduler ON
    if ($akce == "stop"){ $prikaz = "STOP"; }    // system stop
    if ($akce == "start"){ $prikaz = "START"; }  // system start

    for( $i= 1 ; $i <= $program ; $i++ ){        // run now program xx
      if ($akce == "P$i") { $prikaz = "P$i"; }
      }
    
 
    $fh = fopen('data.txt', 'w+');               // save to file data.txt
    fwrite($fh, $prikaz);
    fclose($fh);

}    
?>

<html>
<head>
<meta name="viewport" content="width=640, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta http-equiv="refresh" content="60">
</head>

<body>   
<?php echo "<H1>D&aacute;lkov&eacute; ovl&aacute;d&aacute;n&iacute;</H1>";
      echo "<fieldset><legend><H2>" . $cas . "</h2></legend>";
      $fh = fopen('data.txt', 'r');
      if (fgets($fh) == 'OK') {  echo "OK - &#268;ek&aacute;m na p&#345;&iacute;kaz..."; } else {  echo "Pracuji - &#269;ekejte... "; } 
      fclose($fh);
      if ($prikaz != '') {       echo "Odesl&aacute;n p&#345;&iacute;kaz: " . $prikaz . ".<br>"; }
      echo "</fieldset>";
?>


<form action="" method="post">

<fieldset>
<legend> 
   <H2>Syst&eacute;m</h2>   
</legend>
<?php   echo "<b>ID:</b> " . $id . "<br>";   
        echo "<b>Verze:</b> " . $ver . "<br>"; 
        echo "<b>CPU:</b> " . $cpu . " &deg;"; 
        echo "" . $unit . "<br>"; 
        echo "<b>IP lok&aacute;lu:</b> http"; if ($ssl=='1') { echo ("s"); } 
        echo "://" . $ip . ":"; 
        echo "" . $port . "<br>"; 
        echo "<b>Verze OSPy:</b> " . $ver . "<br>";
        echo "<b>V provozu:</b> " . $up . "<br>"; 
        if ($ups!=""){
          echo "<b>Nap&aacute;jen&iacute; ze s&iacute;t&#283; (UPS):</b> ";  if ($ups=='1'){ echo ("<font color='Red'>chyba 230V! jedu na UPS</font>"); } else { echo ("<font color='Green'>v po&#345;&aacute;dku</font>"); }}
        if ($press!=""){
          echo "<br><b>Tlak vody (&#269;idlo):</b> ";  if ($press=='1'){ echo ("<font color='Red'>bez tlaku</font>"); } else { echo ("<font color='Green'>v po&#345;&aacute;dku</font>"); }}
        if ($tank!=""){
          echo "<br><b>N&aacute;dr&#382; s vodou:</b> " . $tank . " (cm)"; } 
        if ($raindel!=""){
          echo "<br><b>D&eacute;&#353;&#357;ov&eacute; zpo&#382;den&iacute;:</b><font color='Red'> " . $raindel . "</font>"; } 
        echo "<br><b>D&eacute;&#353;&#357;ov&eacute; &#269;idlo: </b>";  if ($rain=='1'){ echo ("<font color='Red'>pr&#353;&iacute;</font><br>"); } else { echo ("<font color='Green'>bez de&#353;t&#283;</font><br>"); }
        if ($lastrun!=""){
          echo "<br><b>Naposledy b&#283;&#382;el:</b> " . $lastrun . "<br><br>"; } else { echo "<br><br>"; }
        if ($system=='0'){ echo ("<button name=\"tlacitko\" value=\"stop\"><h3><font color='Red'>Zastavit syst&eacute;m</font></h3></button>"); }  else { echo ("<button name=\"tlacitko\" value=\"start\"><h3>Spustit syst&eacute;m</h3></button>"); }   
  
        echo "<b>&nbsp; Syst&eacute;m:</b> ";  if ($system=='0'){ echo ("povolen"); } else { echo ("zastaven"); }
        echo "&nbsp;";
        if ($schedul=='1'){ echo ("<button name=\"tlacitko\" value=\"manu\"><h3>P&#345;epnout na ru&#269;n&iacute;</h3></button>"); } else { echo ("<button name=\"tlacitko\" value=\"auto\"><h3>P&#345;epnout na pl&aacute;nova&#269;</h3></button>"); }
        echo "&nbsp;<b>Ovl&aacute;d&aacute;n&iacute;:</b> ";  if ($schedul=='1'){ echo ("pl&aacute;nova&#269;"); } else { echo ("ru&#269;n&#283;"); }  
        echo "<br>";
?>
</fieldset>

<fieldset>
<legend> 
   <h2>Program</h2>
</legend>
   <?php
   for( $i= 1 ; $i <= $program ; $i++ ){
     echo "<button name=\"tlacitko\" value=\"P$i\"><h3>Spustit program " . $i .  "</h3></button>";
     echo "&nbsp;<b>N&aacute;zev:</b> " . $progname[$i-1] . "<br>"; } 
   ?>
</fieldset>

<?php
  for( $i= 1 ; $i <= $output ; $i++ ){
    echo "<fieldset><legend>";
    echo "<h2>Stanice: " . $name[$i-1] . "</h2>"; 
    echo "</legend>";
    if ($state[$i-1]=='1'){ echo ("<button name=\"tlacitko\" value=\"V$i\"><h3>Vypnout</h3></button>"); } else { echo ("<button name=\"tlacitko\" value=\"Z$i\"><h3>Zapnout</h3></button>"); }  
    echo "&nbsp;<b>Stav:</b> "; if ($state[$i-1]=='1') { echo ("ZAPNUTO"); } else { echo ("VYPNUTO"); } 
    if ($masterstat!=''){
      if ($masterstat==$i-1){ echo "&nbsp;<font color='Gray'>(hlavn&iacute; stanice)</font>";} 
      }
    echo "</fieldset>";
    }
?>
  
</form>
<p>&copy; <a href="https://www.pihrt.com">Pihrt.com</a> AUTOMAT OSPy. </p> 
<p>Pro plugin <a href="https://pihrt.com/elektronika/248-moje-rapsberry-pi-zavlazovani-zahrady">Remote FTP Control</a> automatu <a href="https://github.com/martinpihrt/OSPy">OpenSprinkler</a> OSPy. </p> 
</body>
</html>
