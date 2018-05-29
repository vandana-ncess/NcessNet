<?php 
    session_start();
    if(!isset($_SESSION['user']))
        echo "<script>document.location='index.php';</script>";
   if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        echo "<script>document.location='index.php';</script>";
    }
    else {
        $_SESSION['LAST_ACTIVITY'] = time();   
   }
     $conn = require_once('databaseconnection.php');
      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NCESS Intranet</title>
<meta name="keywords" content="free css templates, web design, 2-column, html css" />
<meta name="description" content="Web Design is a 2-column website template (HTML/CSS) provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<!--////// CHOOSE ONE OF THE 3 PIROBOX STYLES  \\\\\\\-->
<link href="css_pirobox/white/style.css" media="screen" title="shadow" rel="stylesheet" type="text/css" />
<!--<link href="css_pirobox/white/style.css" media="screen" title="white" rel="stylesheet" type="text/css" />
<link href="css_pirobox/black/style.css" media="screen" title="black" rel="stylesheet" type="text/css" />-->
<!--////// END  \\\\\\\-->
<link rel="shortcut icon" href="images/logo1.png" type="image/x-icon"/>
<!--////// INCLUDE THE JS AND PIROBOX OPTION IN YOUR HEADER  \\\\\\\-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/piroBox.1_2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$().piroBox({
			my_speed: 600, //animation speed
			bg_alpha: 0.5, //background opacity
			radius: 4, //caption rounded corner
			scrollImage : false, // true == image follows the page, false == image remains in the same open position
			pirobox_next : 'piro_next', // Nav buttons -> piro_next == inside piroBox , piro_next_out == outside piroBox
			pirobox_prev : 'piro_prev',// Nav buttons -> piro_prev == inside piroBox , piro_prev_out == outside piroBox
			close_all : '.piro_close',// add class .piro_overlay(with comma)if you want overlay click close piroBox
			slideShow : 'slideshow', // just delete slideshow between '' if you don't want it.
			slideSpeed : 4 //slideshow duration in seconds(3 to 6 Recommended)
	});
});
</script>
<!--////// END  \\\\\\\-->
</head>
<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">
   
	<div id="tempaltemo_header">
            <?php if(isset($_SESSION['user'])) { ?><p align="right" style="padding-right: 50px;color:#fff;"><b><?php        echo 'Welcome ' . $_SESSION['user']; ?></b>&nbsp; <a href="logout.php" style="color: #fff;">Logout</a></p>;<?php } ?>
    	<span id="header_icon"></span>
    	<div id="header_content">
        	<div id="site_title">
				    <p>Welcome to NCESS Family</p>         </div>
           
		 
		</div>
    </div> <!-- end of header -->
    
    <div id="templatemo_main_top"></div>
    <div id="templatemo_main"><span id="main_top"></span><span id="main_bottom"></span>
    	
        <div id="templatemo_sidebar">
        
        	<div id="templatemo_menu">
                <?php
                        $menuSql= "SELECT * FROM menu WHERE status=1";
                        $menuRes = mysqli_query($conn,$menuSql);
                        if(mysqli_num_rows($menuRes) > 0) {
                            echo '<ul>';
                            while ($menuData= mysqli_fetch_array($menuRes)) {
                                echo '<li><a href="'.$menuData['menuPage'] . '" target="_parent">' . $menuData['menu'] . '</a></li>';
                            }
                            echo '</ul>'; 
                        }
                    ?>  	  
            </div>            
                        
            <div class="cleaner"></div>
        </div> <!-- end of sidebar -->
        
        <div id="templatemo_content">
            <ul class="breadcrumb" style="padding-top: 2px;">
                <li><a href="index.php">Home</a></li>
                <li><a href="documents.php">Documents</a></li>
                <li><a href="agenda.php">Agenda & Minutes</a></li>
                <li>Internal Committees</li>
            </ul>
        <div class="content_box" style="padding-bottom: 10px;padding-top: 10px;">
            <table style="width: 100%;" class="folder">
                <!--<tr>
                    <td><a href="ocdocuments.php?grp=scientific"><img class="image_wrapper image_fl"  align="middle" src="images/normal_folder.ico" alt="Image 1" /><h5>Scientific and Academic Committee</h5></a>
                    </td> 
                    <td><a href="ocdocuments.php?grp=foreign" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>Foreign Travel and Deputations Committee</h5></a>
                    </td>
                    <td><a href="ocdocuments.php?grp=purchase"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Purchase Committee</h5></a>
                    </td>
                    </tr>
                <tr>
                    <td><a href="ocdocuments.php?grp=hrd" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>HRD and  Recruitment   Cell</h5></a>
                    </td>
                    <td><a href="ocdocuments.php?grp=ar"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Information & Annual Report Committee</h5></a>
                    </td><td><a href="ocdocuments.php?grp=infra" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>Infrastructure Development Committee</h5></a>
                    </td>
                </tr>
                <tr>
                    <td><a href="ocdocuments.php?grp=space"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Space Management   Committee</h5></a>
                    </td><td><a href="ocdocuments.php?grp=it" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>IT & Website Committee</h5></a>
                    </td>
                    <td>
                    <a href="ocdocuments.php?grp=students"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Visiting Students Committee</h5></a>
                    </td>
                </tr>
                <tr>
                    <td><a href="ocdocuments.php?grp=transport" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>Transport Committee</h5></a>
                    </td><td><a href="ocdocuments.php?grp=science"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Earth Science Forum</h5></a>
                    </td><td><a href="ocdocuments.php?grp=models" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>Exhibition, Posters, Brochure & Models</h5></a>
                    </td>
                </tr>
                <tr>
                    <td><a href="ocdocuments.php?grp=health"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Health and Medical Committee</h5></a>
                    </td><td><a href="ocdocuments.php?grp=swachta" target="_parent"> <img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Swachta Committee</h5></a>
                    </td><td><a href="ocdocuments.php?grp=canteen"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /><h5>Canteen Committee</h5></a>
                    </td>
                </tr>
                <tr><td><a href="ocdocuments.php?grp=farewell" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>Farewell Committee</h5></a>
                    </td>
                </tr>-->
                <?php
                    $sql = "SELECT * FROM oc_committee WHERE status=1";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)) {
                        $i=1;echo "<tr>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<td><a href="ocdocuments.php?grp=' . $row['committeeID'] . '" target="_parent"><img class="image_wrapper image_fl" src="images/normal_folder.ico" alt="Image 1" /> <h5>' . $row['committeeName'] . ' </h5></a></td>';
                            if($i%3==0)
                                echo "</tr><tr>";
                            $i++;
                        }
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
        </div>
        <div class="cleaner"></div>    
    </div>
    
    <div id="templatemo_main_bottom">
    </div>

</div> <!-- end of wrapper -->
</div>

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
       Copyright © 2018 <a href="#">NCESS</a> | Contact Us : adm@ncess.gov.in | Ext : 1669 
        
    </div>
</div>

</html>