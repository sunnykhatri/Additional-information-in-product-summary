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



// Login from woocommerce front end and redirect to admin panel

function wc_custom_user_redirect( $redirect, $user ) {
	// Get the first of all the roles assigned to the user
	$role = $user->roles[0];
	$dashboard = admin_url();
	$myaccount = get_permalink( wc_get_page_id( 'myaccount' ) );
	if( $role == 'administrator' || $role == 'shop_manager' ) {
		$redirect = $dashboard; 
	} elseif ( $role == 'customer' || $role == 'subscriber' ) {
		$redirect = $myaccount;
	}else {
		$redirect = wp_get_referer() ? wp_get_referer() : home_url();
	}
	return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'wc_custom_user_redirect', 10, 2 );

?>
