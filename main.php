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
	   $time = $UrlArray['endpoints']['0']['duration'];
	   $time = number_format($time/60000,2);
	   echo  "<font color=#14B8CD>Duration of Tests </font>".":".$time."<font color=#14B8CD>minutes</font>"."<br>";
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
	  if($openSsl == 1)
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2014-0224 test</font> : not vulnerable"."<br>";  
	  }
	  elseif($openSsl == -1)
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2014-0224 test</font> : test failed (vulnerable)"."<br>";  
	  }
	   elseif($openSsl == 2)
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2014-0224 test</font> : possibly vulnerable, but not exploitable"."<br>";  
	  }
	    elseif($openSsl == 3)
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2014-0224 test</font> : vulnerable and exploitable"."<br>";  
	  }
	    else
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2014-0224 test</font> : unkown"."<br>";  
	  }
	  
	  
	  
	  $openSSLLucky = $UrlArray['endpoints'][0]['details']['openSSLLuckyMinus20'];
	 
	  if($openSSLLucky == 1)
	  { 
		echo "<font color=#14B8CD>Certificate  CVE-2016-2107 test</font> : not vulnerable"."<br>";  
	  }
	  elseif($openSSLLucky== -1)
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2016-2107 test</font> : test failed (vulnerable)"."<br>";  
	  }
	   elseif($openSSLLucky== 2)
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2016-2107 test</font> : possibly vulnerable, but not exploitable"."<br>";  
	  }
	   
	   else
	  {
		echo "<font color=#14B8CD>Certificate  CVE-2016-2107 test</font> : unkown"."<br>";  
	  }
	  
	  
	  $ticketbleed = $UrlArray['endpoints'][0]['details']['ticketbleed'];
	  
	 if($ticketbleed == 1)
	  {
		echo "<font color=#14B8CD>Certificate ticketbleed CVE-2016-9244 test</font> : not vulnerable"."<br>";  
	  }
	  elseif($ticketbleed == -1)
	  {
		echo "<font color=#14B8CD>Certificate ticketbleed CVE-2016-9244 test</font> : test failed (vulnerable)"."<br>";  
	  }
	   elseif($ticketbleed == 2)
	  {
		echo "<font color=#14B8CD>Certificate ticketbleed CVE-2016-9244 test</font> : possibly vulnerable, but not exploitable"."<br>";  
	  }
	    elseif($ticketbleed == 3)
	  {
		echo "<font color=#14B8CD>Certificate ticketbleed CVE-2016-9244 test</font> : vulnerable and exploitable"."<br>";  
	  }
	    else
	  {
		echo "<font color=#14B8CD>Certificate ticketbleed CVE-2016-9244 test</font> : unkown"."<br>";  
	  }
	  
	  
	  $bleichenbacher = $UrlArray['endpoints'][0]['details']['bleichenbacher'];
     if($bleichenbacher == 1)
	  {
		echo "<font color=#14B8CD> Results of the Return Of Bleichenbacher's Oracle Threat (ROBOT) test:</font> : not vulnerable"."<br>";  
	  }
	  elseif($bleichenbacher == -1)
	  {
		echo "<font color=#14B8CD> Results of the Return Of Bleichenbacher's Oracle Threat (ROBOT) test:</font> : test failed (vulnerable)"."<br>";  
	  }
	   elseif($bleichenbacher == 2)
	  {
		echo "<font color=#14B8CD> Results of the Return Of Bleichenbacher's Oracle Threat (ROBOT) test:</font> : vulnerable (weak oracle)"."<br>";  
	  }
	    elseif($bleichenbacher == 3)
	  {
		echo "<font color=#14B8CD> Results of the Return Of Bleichenbacher's Oracle Threat (ROBOT) test:</font> : vulnerable (strong oracle)"."<br>";  
	  }
	    elseif($bleichenbacher == 4)
	  {
		echo "<font color=#14B8CD> Results of the Return Of Bleichenbacher's Oracle Threat (ROBOT) test:</font> : inconsistent results"."<br>";  
	  }
	   else
	  {
		echo "<font color=#14B8CD>Certificate ticketbleed CVE-2016-9244 test</font> : unkown"."<br>";  
	  }
	  
	  
	  
	  
	  $dhUsesKnownPrimes= $UrlArray['endpoints'][0]['details']['dhUsesKnownPrimes'];
	  if($dhUsesKnownPrimes == 0)
	  {
		echo "<font color=#14B8CD> whether the server uses known DH primes. Not present if the server doesn't support the DH key exchange:</font> : no"."<br>";  
	  }
	  elseif($dhUsesKnownPrimes == 1)
	  {
		echo "<font color=#14B8CD>whether the server uses known DH primes. Not present if the server doesn't support the DH key exchange</font>: yes, but they're not weak"."<br>";  
	  }
	   elseif($dhUsesKnownPrimes == 2)
	  {
		echo "<font color=#14B8CD>whether the server uses known DH primes. Not present if the server doesn't support the DH key exchange:</font> : yes, but they're  weak"."<br>";  
	  }
	   
	
	    
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
           $testStatus = $UrlArray['endpoints']['0']['statusDetails'];
		   echo "Description of the operation currently in progress  : ".$testStatus;
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
	margin-top:200px;
}
.gif{
	text-align:center;
}
.logo-footer{
	height :100px;
	widtgh:100px;
}
.world{
	height :100px;
	widtgh:100px;
}

	

	
</style>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   <a class="navbar-brand" href="https://www.vik.bme.hu/">
    <img src="https://www.bme.hu/sites/default/files/mediakit/bme_logo_nagy.jpg"  style="width:180px">
	 <a class="navbar-brand" href="contact_form.php">contact us</a>
  </a>
 
</nav>
<div class ="main">
  <h1 style="font-family:Fantasy;">Enter your URL<img class = "world" src = "https://cdn.iconscout.com/icon/free/png-512/earth-global-globe-international-map-planet-world-2-12510.png">
   </h1>
  <form class="content"  action ="test.php" method="GET">
    <input type="text" name = "url" placeholder = "www.something.com">
     <button  class="btn btn-primary"  type="submit" name="submit">Check</button>
    </form>
	 </div>
	 <div class = gif>
	 <img src = "https://media.giphy.com/media/feN0YJbVs0fwA/giphy.gif">
	 </div>
	 <!-- Footer -->
        <footer>
        	<div class="footer-top">
		        <div class="container">
		        	<div class="row">
		        		<div class="col-md-4 col-lg-4 footer-about wow fadeInUp">
		        			<img class="logo-footer" src="https://www.bme.hu/sites/default/files/mediakit/bme_logo_nagy.jpg"  >
		        			<p>
		        				This is project aim's to check the certifcate of domains and test them to see if the their servers are protected against the different type of cyber attacks .
		        			</p>
		        			
	                    </div>
		        		<div class="col-md-4 col-lg-4 offset-lg-1 footer-contact wow fadeInDown">
		        			<h3>Contact</h3>
		                	<p><i class="fas fa-map-marker-alt"></i> 1111 Budapest,
Műegyetem rkp. 3.</p>
		                	<p><i class="fas fa-phone"></i> Phone: +36702605558</p>
		                	<p><i class="fas fa-envelope"></i> Email: <a href="amiralikhamseh01@gmail.com">amiralikhamseh01@gmail.com</a></p>
		                	
	                    </div>
	                    <div class="col-md-4 col-lg-3 footer-social wow fadeInUp">
	                    	<h3>Follow us</h3>
	                    	<p>
	                    		<a href="https://www.vik.bme.hu/"><i class="fab fa-facebook"></i></a> 
								<a href="https://www.vik.bme.hu/"><i class="fab fa-twitter"></i></a> 
								<a href="https://www.vik.bme.hu/"><i class="fab fa-instagram"></i></a> 
								<a href="https://www.vik.bme.hu/"><i class="fab fa-pinterest"></i></a>
	                    	</p>
	                    </div>
		            </div>
		        </div>
	        </div>
	        <div class="footer-bottom">
	        	<div class="container">
	        		<div class="row">
	           			<div class="col-md-5 footer-copyright">
	                    	<p>&copy; Amirali Khamseh 2020</p>
	                    
	           		</div>
	        	</div>
	        </div>
        </footer>
 </body>
</html>
