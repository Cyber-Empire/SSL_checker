<?php


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
	   //print_r($UrlArray);
	   echo"<br>";
	
  
  
	   
     if($UrlArray ['status']=="READY")
	    {
		   echo " All done ! ";
		   $flag = true ; 
	
	    }
      /*elseif($UrlArray ['status']=="IN_PROGRESS")
       {
		     
	       echo "Loading on progres [".$UrlArray['endpoints']['0']['progress']."%]loaded !"."<br>";	
	   }*/ 
	   
	   // the problem here is progress , which some times is appearing at first some times not 
	  
	  elseif($UrlArray ['status']=="Unable to resolve domain name" || $UrlArray ['status']=="ERROR" || $UrlArray ['status']=="DNS" )
	  {
		  echo "Undefined URL!!";
	  }
	  else
	    {
	       echo "please wait ,loading on progress !"."<br>";
             header("refresh: 5");
			 // refreshing the page each 5 second
 
	    }
  
	}
}

?>


<!doctype html>
<html>
<head>
<style>
.main{
	text-align:center;
}
	
</style>
</head>
<body>

<div class ="main">
  <h1>Enter Your URL</h1>
   <form class="content"  action ="test.php" method="GET">
    <input type="text" name = "url" placeholder = "www.something.com">
     <button type="submit" name="submit">Check</button>
    </form>
 </div>
 </body>
</html>
