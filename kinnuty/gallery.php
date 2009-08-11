<html>
<head> 
<link href="style/galleria.css" media='screen' rel='stylesheet' type='text/css'/>
<link href="style/galleria.css" rel="stylesheet" type="text/css" media="screen">
	<script type="text/javascript" src="http://dharmmotyar.googlecode.com/svn/trunk/js/jquery.min.js"></script>
	<script type="text/javascript" src="http://dharmmotyar.googlecode.com/svn/trunk/js/jquery.galleria.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('.gallery_demo_unstyled').addClass('gallery_demo'); // adds new class name to maintain degradability
		$('.nav').css('display','none'); // hides the nav initially
		
		$('ul.gallery_demo').galleria({
			history   : false, // deactivates the history object for bookmarking, back-button etc.
			clickNext : false, // helper for making the image clickable. Let's not have that in this example.
			insert    : undefined, // the containing selector for our main image. 
								   // If not found or undefined (like here), galleria will create a container 
								   // before the ul with the class .galleria_container (see CSS)
			onImage   : function() { $('.nav').css('display','block'); } // shows the nav when the image is showing
		});
	});
	
	</script>

<title>Gallery
</title>
<style media='screen,projection' type='text/css'>
	
	/* BEGIN DEMO STYLE */
	*{margin:0;padding:0}
	 body{padding:5px;width:100%;}
	 h1,h2{font:bold 80% &#39;helvetica neue&#39;,sans-serif;letter-spacing:3px;text-transform:uppercase;}
	 a{color:#348;text-decoration:none;outline:none;}
	 a:hover{color:#67a;}
	.caption{color:#888;position:absolute;top:315px;left:3px;width:200px;}
	.demo{position:relative;margin-top:2em;}
	.gallery_demo{width:200px;float:left;}
	.gallery_demo li{width:55px;height:70px;border:3px double #eee;margin: 0 2px 2px 0;background:#eee;}
	.gallery_demo li.hover{border-color:#bbb;}
	.gallery_demo li.active{border-style:solid;border-color:#222;}
	.gallery_demo li div{left:240px}
	.gallery_demo li div .caption{font:italic 0.7em/1.4 georgia,serif;}
	
	.galleria_container{margin:0 auto 60px auto;height:438px;width:700px;float:right;}
	
	.nav{padding-top:15px;clear:both;}
	
	.info{text-align:left;margin:30px 0;border-top:1px dotted #221;padding-top:30px;clear:both;}
	.info p{margin-top:1.6em;}
	
	.nav{position:absolute;top:410px;left:0;}
	
    </style>
</head>
<body> 
<table border=0 width=100%>
<tr>
      <td width='12%'><a href="index.php" >
            <font color="#ff8c21" size=6><b>KINNU</b></font><font color="#a08f6b" size=6><b>TY</b></font></a>
      </td>
      <td width='2%'> &nbsp;</td> 
      <td valign="top" ><font color="olive" > <strong> For Kinnutizens </strong></font><hr></td>
</tr>
<tr>
<td valign="top" style="margin-top:3px;" >
      <?php include_once('includes/left_nav.php'); ?>
</td>
<td></td>
      <td valign="top" >
            <div class='demo'>
                  <ul class='gallery_demo_unstyled'> 
                        <li><img alt='Flowing Rock' src='http://www.sriganganagarcity.com/picGall_images/37_picgall_big.JPG' title='Gurudwara'/></li>
      
                        <li><img alt='Stones' src='http://www.sriganganagarcity.com/picGall_images/36_picgall_big.JPG' title='Hanumaan Mandir'/></li>
      
                        <li><img alt='Stones' src='http://www.sriganganagarcity.com/picGall_images/35_picgall_big.JPG' title='Tarachand Watika'/></li>
                        
                        <li><img alt='Stones' src='http://www.sriganganagarcity.com/picGall_images/34_picgall_big.JPG' title='KrisnaMandir'/></li>
                        
                        <li><img alt='Stones' src='http://www.sriganganagarcity.com/picGall_images/18_picgall_big.JPG' title=''/></li>
                        
                        <li><img alt='Stones' src='http://www.sriganganagarcity.com/picGall_images/14_picgall_big.jpg' title='Hanumaan ji'/></li>
                        
                        <li><img alt='Stones' src='http://www.sriganganagarcity.com/picGall_images/20_picgall_big.JPG' title='Srigangasingh Statue'/></li>
                   </ul>
                  <p class='nav'>
                  <a href='#' onclick='$.galleria.prev(); return false;'>previous</a> | <a href='#' onclick='$.galleria.next(); return false;'>next</a></p>
            </div>

      </td>
</tr>
</table>

