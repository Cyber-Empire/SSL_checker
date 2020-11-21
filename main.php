<?php

error_reporting(0);
if(isset($_GET['submit']))
{
 if(empty($_GET['url']))
   {
	  echo '<script>alert("Url Field is Empty")</script>'; 
   }
 else
   {
	   $urlContents = file_get_contents("https://api.ssllabs.com/api/v3/analyze?host=".$_GET['url']."&all=on");
       $UrlArray = json_decode($urlContents, true); 
	  // print_r($UrlArray);
	   echo"<br>";
	
  
  
	   
     if($UrlArray ['status']=="READY" || $UrlArray['endpoints'][0][statusMessage]=="Ready")
	    {
		   echo "<font color =#42f545> All done ✔ </font>"."<br>";
	   echo "Result for --"."<font color = #f56642>".$_GET['url']."</font>"." -- is as follows :<br>"; 
	   
	   $CertificateVersion= $UrlArray['criteriaVersion'];
	   echo "<font color=#14B8CD>Certificate version</font>".":".$CertificateVersion."<br>";
	   
	   $ServerName = $UrlArray['endpoints'][0]['serverName'];
	   echo "<font color=#14B8CD>ServerName</font>" .":".$ServerName."<br>";
	  $ipadd=$UrlArray['endpoints'][0]['ipAddress'];
	  echo "<font color=#14B8CD>Ip address </font>".":".$ipadd."<br>";
	  $grade = $UrlArray['endpoints'][0]['grade'];
	  echo "<font color=#14B8CD>Certificate grade </font>".":".$grade."<br>";
	  $id = $UrlArray['endpoints'][0]['details']['certChains'][0]['id'];
	  echo "<font color=#14B8CD>Certificate identification</font>".":".$id."<br>";
	  $openSsl = $UrlArray['endpoints'][0]['details']['openSslCcs'];
	  echo "<font color=#14B8CD>Certificate  CVE-2014-0224 test</font>".":".$openSsl."<br>";
	  $openSSLLucky = $UrlArray['endpoints'][0]['details']['openSSLLuckyMinus20'];
	  echo "<font color=#14B8CD>Certificate CVE-2016-2107 test </font>".":".$openSSLLucky."<br>";
	  $ticketbleed = $UrlArray['endpoints'][0]['details']['ticketbleed'];
	  echo "<font color=#14B8CD> Certificate ticketbleed CVE-2016-9244 test</font>".":".$ticketbleed."<br>";
	echo"Test results can be"."<font color=#eb4034 >(-1 test failed),(0 unknown),(2 vulnerable and insecure)</font>";
	    }
     
	  
	  elseif($UrlArray ['status']=="Unable to resolve domain name" || $UrlArray ['status']=="ERROR"  )
	  {
		  echo "Undefined URL!!";
	  }
	  else
	    {
	       echo "please wait ,loading on progress ,lt may take a while !"."<br>";
		   $counter = 0;
		   $counter += $UrlArray['endpoints']['0']['progress'];
		   echo "Loading on progres [".$counter."%]loaded !"."<br>";	
             header("refresh:10");
			 // refreshing the page each 10 second
 
	    }
  
	}
}

?>


<!doctype html>
<html>
<head>
<title>SSL_Checker</title>
<style>
.main{
	text-align:center;
}
	
</style>
</head>

<div class ="main">
  <h1>Enter Your URL</h1>
   <form class="content"  action ="test.php" method="GET">
    <input type="text" name = "url" placeholder = "www.something.com">
     <button type="submit" name="submit">Check</button>
    </form>
	<img src ="https://media.giphy.com/media/lo5HLcAPFSgTZNTpAn/giphy.gif">
 </div>
 </body>
</html>
