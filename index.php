<?php
/*
 * Project: Double-P Framework
 * Copyright: 2011-2012, Moin Uddin (pay2moin@gmail.com)
 * Version: 1.0
 * Author: Moin Uddin
 */
	$url=$_SERVER['REQUEST_URI'];
<<<<<<< HEAD
    include("config/connection.php");
    include("includes/functions.php");
    //starting a secured session
    session_start();
=======

    include("config/connection.php");
    include("includes/functions.php");

    //starting a secured session
    session_start();
    
>>>>>>> e3461aacae373dcb6d010aba902ca7581da7d8f2
    //Connecting database
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
<<<<<<< HEAD
    //breaking the url to many parts
    $break=explode("/", $url);
    //broken useful parts starts from the array position $start
    $start=START;
=======

    //breaking the url to many parts
    $break=explode("/", $url);

    //broken useful parts starts from the array position $start
    $start=START;

>>>>>>> e3461aacae373dcb6d010aba902ca7581da7d8f2
    $uurl=""; //universal/global use purpose url
    $i=$start;
    while($i<count($break))
    {
        $uurl=$break[$i]."/";
        $i++;
    }
    $GLOBALS['url']=$uurl;
    /*------------------------------------Operations are started from here----------------------------------------*/
<<<<<<< HEAD
    $option=$break[$start];
=======

    $option=$break[$start];
	
>>>>>>> e3461aacae373dcb6d010aba902ca7581da7d8f2
    if(($option!="")&&(is_dir("modules/".$option))) $module="modules/".$option;
    else
    {
        $module="modules/default";
        $option="default";
    }
    include($module."/".$option.".php");
 ?>
