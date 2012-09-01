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

		.ticker
		{
			width:800px;
			height: 40px;
			position: relative;
            display:block;
            overflow:hidden;
		}
	
        .ticker span {
            color: #000000;
            display: block;
            float: left;
            font-family: Times,'Times New Roman',Georgia,Serif;
            font-size: 27px;
            font-weight: bold;
            padding: 0 0 0 38px;
            white-space: nowrap;
            }
              
        
       #tic_r {
       color:red;
       }
       #tic_s {
       color:green;
       }
       #cloud.ticker, #trans_cloud.ticker{
       height: 56px;
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
// $header = get_data ('http://netopsdev.ecgrid.com/tools/ticker/header.htm');
 $ticker = get_data ('http://netopsdev.ecgrid.com/tools/ticker/tpstream.ticker.htm');
 $cloud = get_data ('http://netopsdev.ecgrid.com/tools/ticker/tpstream.cloud.htm');
 $trans_ticker = get_data ('http://netopsdev.ecgrid.com/tools/ticker/transstream.ticker.htm');
 $trans_cloud = get_data ('http://netopsdev.ecgrid.com/tools/ticker/transstream.cloud.htm');

 ?>
 <div id="header">
 </div>
 <div id = "raw_ticker" class = "raw_ticker  ">
    <div id="ticker" class ="ticker ticker_left2right">
     </div>
</div>    
 <div id = "raw_cloud" class = "raw_ticker">
    <div id="cloud" class ="ticker">
    
    </div>
</div>  
 <div id = "raw_trans_ticker" class = "raw_ticker">
    <div id="trans_ticker" class ="ticker">
    
    </div>
</div> 
 <div id = "raw_trans_cloud" class = "raw_ticker">
    <div id="trans_cloud" class ="ticker ticker_left2right">
    
    </div>
</div> 
 <div id = "debug">
    <div id = "db_0"></div>
    <div id = "db_1"></div>
    <div id = "db_2"></div>
    <div id = "db_3"></div>
 </div>
 <script type="text/javascript">
		// Initialize the plugin with no custom option
		// Initialize the plugin with no custom options
//		$(document).ready(function () {
//			// None of the options are set
//			$("div#ticker").smoothDivScroll({
//				autoScrollingMode: "onstart",
 //               hotSpotScrolling: false
//			});
//		});
</script>
<script type="text/javascript">
var TICKER_CONTENT = new Array();
TICKER_CONTENT[0] = "<?php echo $ticker; ?>";
TICKER_CONTENT[1] = "<?php echo $cloud; ?>";
TICKER_CONTENT[2] = "<?php echo $trans_ticker; ?>";
TICKER_CONTENT[3] = "<?php echo $trans_cloud; ?>";
TICKER_SPEED = 3;
TICKER_STYLE = "font-family:Arial; font-size:12px; color:#444444";
TICKER_PAUSED = false;

 ticker_start(0);

function ticker_start() {
    $(".ticker").each(function(i) {
        
        var tickerSupported = false;
        TICKER_WIDTH = $(this).find("table").width();
        RAW_WIDTH = $(this).width();
        var img = "";//"<img src=ticker_space.gif width="+TICKER_WIDTH+" height=0>";

    //	// Firefox
        if (navigator.userAgent.indexOf("Firefox")!=-1 || navigator.userAgent.indexOf("Safari")!=-1) {
            $(this).html("<TABLE  cellspacing='0' cellpadding='0' width='100%'><TR><TD nowrap='nowrap'>"+img+"<SPAN style='"+TICKER_STYLE+"' class='TICKER_BODY' width='100%'>&nbsp;</SPAN>"+img+"</TD></TR></TABLE>");
            tickerSupported = true;
           } 
        // IE
        if (navigator.userAgent.indexOf("MSIE")!=-1 && navigator.userAgent.indexOf("Opera")==-1) {
     //   $(this).html ("<DIV nowrap='nowrap' style='width:100%;'>"+img+"<SPAN style='"+TICKER_STYLE+"' ID='TICKER_BODY' width='100%'></SPAN>"+img+"</DIV>");
            tickerSupported = true;
        }
        if(!tickerSupported) document.getElementById("ticker").outerHTML = ""; else {
         //  $(this).hasClass("ticker_left2right") ?  $(this).scrollLeft( RAW_WIDTH ) : $(this).scrollLeft( 0 ); 
           $(this).find(".TICKER_BODY").html(TICKER_CONTENT[i]); //$(".ticker").innerHTML;
          //  document.getElementById(this).style.display="block";
          
        }
       i += 1; 
    });
     TICKER_tick(0);
}

function TICKER_tick(i) {
    $(".ticker").each(function(i) {
        TICKER_WIDTH = $(this).find("table").width() - $(this).width();
        $(this).hasClass("ticker_left2right") ? increment = TICKER_SPEED * -1 : increment = TICKER_SPEED * 1;
        $(this).scrollLeft( increment + $(this).scrollLeft() ); 
        if((increment < 0 ) && $(this).scrollLeft() <= 0) $(this).scrollLeft( TICKER_WIDTH );
        if((increment > 0 ) && $(this).scrollLeft() >= TICKER_WIDTH-1 ) $(this).scrollLeft(0);
        $("#debug").find("#db_"+i).html("<p> scrollLeft for: "+i+" is : "+$(this).scrollLeft());
   
       
    });
     window.setTimeout("TICKER_tick(0)", 30);
}
</script>
  </body>
</html>