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
     $topicID = $_GET['topicID'];
     $quote = $_GET['quote'];
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
                <ul>
                  <li><a href="index.php" target="_parent">Home</a></li>
                    <li><a href="employees.php" target="_parent">Staff</a></li>
                    <li><a href="announcements.php" target="_parent" >Notice Board</a></li>
                    <li><a href="documents.php" target="_parent">Documents</a></li>
                    <li><a href="attendance.php" target="_parent">Attendance</a></li>
                    <li><a href="eGovernance.php" target="_parent">e-Governance</a></li>
                    <li><a href=http://ncess.gov.in/notifications/awards.html" target="_parent">Awards</a></li>
                    <li><a href="publications.php" target="_parent">Research Publications</a></li>
                    <li><a href="http://ncess.gov.in/facilities/laboratories.html" target="_parent">Laboratories</a></li>
                    <li><a href="http://192.168.17.11:8001/" target="_parent">Online Library</a></li>
                    <li><a href="directory.php" target="_parent">Contact Directory</a></li>
                    <li><a href="email.php" target="_parent">Email Address Book</a></li>
                    <li><a href="profile.php" target="_parent">Profile Updations</a></li>
                    <li><a href="discussion.php" target="_parent" class="current">Discussion Forum</a></li>
                    <li><a href="reports.php" target="_parent">Reports</a></li>
                    <li><a href="feedback.php" target="_parent">Feedback</a></li>
              </ul>  	
            </div> 
            
           
           
            
            <div class="cleaner"></div>
        </div> <!-- end of sidebar -->
        
        <div id="templatemo_content">
           
            <?php
                $sql = "SELECT * FROM discussion_topics WHERE topicID=". $topicID ;
                $res = mysqli_query($conn,$sql); 
                if(mysqli_num_rows($res)>0) {
                    $data = mysqli_fetch_array($res);
                    echo '<div class="content_box" style="padding-bottom:5px;overflow-y:scroll;min-height:550px;" ><h5>'.$data['title'] .'</h5>';
                    echo $data['topic'] . '<br /><br />';
                }
                $sql = "SELECT * FROM discussion_posts WHERE topicID=" . $topicID;
                $res = mysqli_query($conn,$sql); 
                $no = mysqli_num_rows($res);
                if($no>0) {
                        while($data = mysqli_fetch_array($res)) {
                            echo '<div class="content_box" style="padding-bottom:20px;height:auto;" ><p><b>'.$data['postedBy'].'</b>&nbsp;'.$data['postedOn'].'</p><p>'.$data['comment'].'</p> ';
                            $sql1 = "SELECT * FROM discussion_quotes WHERE approvalStatus=1 AND postID=" . $data['postID'];
                            $re = mysqli_query($conn,$sql1);
                            if(mysqli_num_rows($re)) {
                                while($row = mysqli_fetch_array($re)) {
                                    echo '<p style="padding-left:10px;"><b>'.$data['postedBy'].'</b>&nbsp;'.$data['postedOn'].'</p><p style="padding-left:10px;">'. $row['quote'].'</p>';
                                }
                            }
                            echo '<span style="float:right;"><a href="discussionPosts.php?topicID='.$topicID.'&quote='.$data['postID'].'#comment">Quote</a></span></div>';
                        } 
                    }
  echo '</div>';
            ?>
            <div class="content_box"  style="padding-bottom: 5px;"><a name="comment"> <h5>Add  Comments</h5></a>
                <form method="POST">
                    <textarea name="txtComment" rows="5" cols="80"></textarea>
                    <input type="submit" name="btnSend" value="Send" />
                    <?php
                        if(isset($_POST['btnSend'])) {
                            if($quote == 0)
                                $sql = "INSERT INTO discussion_posts(topicID,comment,postedBy,postedOn,approvalStatus) VALUES(" . $topicID . ",'" .
                                    $_POST['txtComment'] . "','" . $_SESSION['user'] . "',CURRENT_TIMESTAMP,0)";
                            else 
                                $sql = "INSERT INTO discussion_quotes(postID,quote,postedBy,postedOn,approvalStatus) VALUES(" . $quote . ",'" .
                                    $_POST['txtComment'] . "','" . $_SESSION['user'] . "',CURRENT_TIMESTAMP,0)";
                            $result = mysqli_query($conn,$sql);
                            if($result)
                                echo 'Your comments are send for verification!';
                            else
                                echo 'Failed to send!';
                        }
                    ?>
                </form>
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
        Copyright � 2018 <a href="#">NCESS</a> | Contact Us : adm@ncess.gov.in | Ext : 1669 
        
    </div>
</div>
   
</body>
</html>