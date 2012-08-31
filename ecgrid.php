<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="dcterms.created" content="Fri, 31 Aug 2012 04:00:09 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title></title>
    <link rel="Stylesheet" type="text/css" href="css/smoothDivScroll.css" />
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script> 
   <script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
   <script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
   <script src="js/jquery.smoothdivscroll-1.2-min.js" type="text/javascript"></script>
   <style type="text/css">

		#ticker
		{
			width:100%;
			height: 100px;
			position: relative;
		}
	
        #ticker span {
            background-color: #E0E096;
            border-bottom: 1px solid;
            border-top: 1px solid;
            color: #000000;
            display: block;
            float: left;
            font-family: Times,'Times New Roman',Georgia,Serif;
            font-size: 27px;
            font-weight: bold;
            padding: 0 0 0 38px;
            white-space: nowrap;
            }
        #cloud {
            border: 1px solid;
            display: block;
            margin: 20px;
            padding: 20px;
            width: 722px;
            }    
        span:before
            {
            content: url(images/bullet_39x39.gif)
            }
       
	</style>
  </head>
  <body>
 <?php 
 function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
// curl_setopt(CURLOPT_RETURNTRANSFER, true);
 $header = get_data ('http://netopsdev.ecgrid.com/tools/ticker/header.htm');
 $ticker = get_data ('http://netopsdev.ecgrid.com/tools/ticker/tpstream.ticker.htm');;
 $cloud = get_data ('http://netopsdev.ecgrid.com/tools/ticker/tpstream.cloud.htm');
 $trans_ticker = get_data ('http://netopsdev.ecgrid.com/tools/ticker/transstream.ticker.htm');
 $trans_cloud = get_data ('http://netopsdev.ecgrid.com/tools/ticker/transstream.cloud.htm');

 ?>
 <div id="header">
 <?php echo $header ?>
 </div>
 <div id = 'ticker'>
  <?php echo $ticker ?>
 </div>
 <div id = 'cloud'>
  <?php echo $cloud ?>
 </div>
 <script type="text/javascript">
		// Initialize the plugin with no custom options
		$(document).ready(function () {
			// None of the options are set
			$("div#ticker").smoothDivScroll({
				autoScrollingMode: "onstart",
                hotSpotScrolling: false
			});
		});
</script>
  </body>
</html>