<?php

// Put this code on your function.php
// Disable admin panel redirection in wordpress

function login_page_redirection() 
{	
	$_SERVERHTTP_HOST = $_SERVER[HTTP_HOST];
	$_SERVERREQUEST_URI = $_SERVER[REQUEST_URI];	
	$theRequest = "http://".$_SERVERHTTP_HOST ."".$_SERVERREQUEST_URI;	
	$theRequest = explode( "?" , $theRequest );	
	if ( site_url('/wp-login') == $theRequest[0] || site_url('/wp-login.php') == $theRequest[0] ) 
	{	
		$url = site_url('/404.php');
		/*
		if (wp_redirect($url))
		{
		    exit;
		}
		*/
		echo "<script>window.location.href = '".$url."';</script>";		
	}  
}
add_action('login_head', 'login_page_redirection');

?>
