<?php
  $result = "";
   $error = "";
  if($_GET['url']){
  
  $urlContents = file_get_contents("https://api.ssllabs.com/api/v3/analyze?host=".urlencode($_GET['url'])."&all=on");
     $UrlArray = json_decode($urlContents, true);    
      // print_r($UrlArray);
	   if($UrlArray['status']== "READY" || "IN_PROGRESS")
	   {
	   $result = "Result for --".$_GET['url']." -- is as follows :<br>"; 
	   $CertificateVersion= $UrlArray['criteriaVersion'];
	   $result.= "Certificate version  ->".$CertificateVersion."<br>";
	   $ServerName = $UrlArray['endpoints'][0]['serverName'];
	   $result.="Servername-> ".$ServerName."<br>";
	  $ipadd=$UrlArray['endpoints'][0]['ipAddress'];
	  $result .= "Ip Address ->".$ipadd."<br>";
	  $grade = $UrlArray['endpoints'][0]['grade'];
	  $id = $UrlArray['endpoints'][0]['details']['certChains'][0]['id'];
	  $result.="Cert id  ->".$id."<br>";
	  $Ciphersuites = $UrlArray['endpoints'][0]['details']['suites'][0]['list'][0]['q'];
	  $result.="Flag for suite insecure or weak. Not present if suite is strong or good (0 insecure,1 weak)->".$Ciphersuites."<br>";
	  $result .= "Cert grade has possible values: A+, A-, A-F, T (no trust) and M (certificate name mismatch),your grade is ->".$grade."<br>";
	  $openSsl = $UrlArray['endpoints'][0]['details']['openSslCcs'];
	  $result .= "Result of the CVE-2014-0224 test(-1 test failed,0 unknown,1 not vulnerable,2 possibly vulnerable,3 vulnerable and exploitable) ->".$openSsl."<br>"; 
	  $openSSLLucky = $UrlArray['endpoints'][0]['details']['openSSLLuckyMinus20'];
	  $result .= " Result of the CVE-2016-2107 test(-1 test failed,0 unknown,1 not vulnerable,2 vulnerable and insecure) ->".$openSSLLucky."<br>";
	  $ticketbleed = $UrlArray['endpoints'][0]['details']['ticketbleed'];
	  $result .= "Result of the ticketbleed CVE-2016-9244 test(-1 test failed,0 unknown,1 not vulnerable,2 vulnerable and insecure,3 not vulnerable but a similar bug detected) ->".$ticketbleed."<br>";
	  
	   }
	   else
	   {
		   $error = "domain name undefined !";
	   }
    } 


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>SLL_checker</title>
	<style type="text/css">
	
	body{
		background : none;
	}
	.container{
		text-align : center;
		margin-top:100px;
		
	
	}
	html{
		background :url(https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80) no-repeat center center fixed ;
		--webkit-background-size:cover;
		-moz-background-size:cover;
		-o-background-size:cover;
		background-size:cover;
	}
	
	
	<!--making the background image fix -->
	</style>
	
  </head>
  <body>
  
   
   <div class = "container">
   <h1 style = "color :white"> What is  your URL ;) </h1>
   
   <form>
  
  <div class="form-group">
    <label for="url" style = "color :white">Go ahead type it !</label>
    <input type="text" class="form-control" id = "url"  name = "url" placeholder="www.Something.com">
  </div>
   <button type="submit" class="btn btn-primary" >Submit</button>
</form>
<div id="output"><?php 
              
              if ($result) {
                  
                  echo '<div class="alert alert-success" role="alert">
  '.$result.'
</div>';
                  
              } else if ($error) {
                  
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                  
              }
              
              ?></div>
    </div>
  
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
