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
  
    if($UrlArray ['status']=="READY")
	   {
		  echo " All done ! ";
	   }
	else
	   {
	   echo "please wait ,loading on progress !"."<br>";	
	
         if(array_key_exists('progress', $UrlArray['endpoints'][0]))
		 {
		    echo "Loading on progres [".$UrlArray['endpoints']['0']['progress']."%]loaded !"."<br>";	
	     }
         else
		 {
			echo"  Here java script must load the page !";
		 }	   
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
