<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>jQuery lightBox plugin</title>

	<link rel="stylesheet" type="text/css" href="../style-projects-jquery.css" />    
    
    <!-- Arquivos utilizados pelo jQuery lightBox plugin -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
    
    <!-- Ativando o jQuery lightBox plugin -->
    <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		
		padding: 0px;
		width: 520px;
	}
	#gallery  { list-style: none; }
	#gallery { display: inline; }
	#gallery  img {
		border: 0px solid #3e3e3e;
		border-width: 0px 0px 0px 0px;
	}
	#gallery  a:hover img {
		border: 5px solid #fff;
		border-width: 0px 0px 0px;
		color: #fff;
	}
	#gallery a:hover { color: #fff; }
	</style>
</head>

<body>

<div id="gallery" style="border:none;">
   
            

			<a href="images/0vxfum2vKrrc5laMxVZ6A.jpg" title="" >
                <img src="images/0vxfum2vKrrc5laMxVZ6A.jpg" width="72" height="72" alt="" />
            </a>
			<a href="images/00005f77.jpg" title="" >
                <img src="images/00005f77.jpg" width="72" height="72" alt="" />
            </a>
			<a href="images/12155753439E69zHg.jpg" title="" >
                <img src="images/12155753439E69zHg.jpg" width="72" height="72" alt="" />
            </a>
			<a href="images/br600519-01vliv01.jpg" title="" >
                <img src="images/br600519-01vliv01.jpg" width="72" height="72" alt="" />
            </a>
			<a href="images/705051267_7900ae1d5a_m.jpg" title="" >
                <img src="images/705051267_7900ae1d5a_m.jpg" width="72" height="72" alt="" />
            </a>
                  
</div>

</body>
</html>