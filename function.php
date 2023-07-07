<?php
   /*
   Plugin Name: Go High Level App Maker
   Plugin URI: https://ebmsbusiness.com
   description: in this plugin you can create your own application through Go high level you have to fooolw the documentation as defined in website 
   Version: 1.00
   Author: Haris Khan Durrani
   Author URI: http://mrtotallyawesome.com
   License: GPL2
   */
  function highapp(){
 
  wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js',array( 'jquery-cdn' ), true);
  add_menu_page("Highapp", "Highapp", "edit_posts", "Highapp", "dbload", plugins_url('assets/image/icon3.png', __FILE__),2);
 //adding submenu here
 add_submenu_page("Highapp","Created Fields View","Created Fields View","manage_options","cfs","fieldgenerate");
 //add_submenu_page("Highapp","Created Tables View","Created Tables View","manage_options","cts","tablegenerate");
 
 //add_submenu_page("Highapp","Created Count Or Add Field","Created Count Or Add Field","manage_options","ccaf","countadd");





}
  add_action("admin_menu", "highapp");



//create database here
//database creation
function gohighdbcreate(){
	// create the custom table

	
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	global $wpdb;
$wpdb->hide_errors();
// Require upgrade
// Set charset
$collate = '';
if ( $wpdb->has_cap( 'collation' ) ) {
    $collate = $wpdb->get_charset_collate();
}
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
$queries = array();


array_push($queries, "CREATE TABLE IF NOT EXISTS `gohighsetting`  (
       `did` int(11) NOT NULL AUTO_INCREMENT,
       `agenname` varchar(1000) NOT NULL,
  `gkey` varchar(1000) NOT NULL,
  `access_token` longtext NOT NULL,
  `refresh_token` longtext NOT NULL,
  `company_id` longtext NOT NULL,
  `location_id` longtext NOT NULL,
    `client_id` longtext NOT NULL,
  `client_sec` longtext NOT NULL,
  PRIMARY KEY  (`did`)){$collate}");



array_push($queries, "CREATE TABLE IF NOT EXISTS `fieldshortcode`  (
          fid bigint(20) NOT NULL AUTO_INCREMENT,
          `akey` varchar(1000) NOT NULL,
  `afield` varchar(200) NOT NULL,
  `customfield` varchar(200) NOT NULL,
  `cfname` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `cont` varchar(200) NOT NULL,PRIMARY KEY (`fid`)){$collate}");

array_push($queries, "CREATE TABLE IF NOT EXISTS `addcountfield`  (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(200) NOT NULL,
  `akry` varchar(1000) NOT NULL,
  `afield` varchar(200) NOT NULL,
  `contype` varchar(200) NOT NULL,
  `customtext` varchar(200) NOT NULL,
  `fieldcountadd` varchar(200) NOT NULL,
  `countadd` varchar(200) NOT NULL
,PRIMARY KEY (`fid`)){$collate}");


array_push($queries, "CREATE TABLE IF NOT EXISTS `gohighview`  (
   `ghvid` int(11) NOT NULL AUTO_INCREMENT,
  `akey` varchar(1000) NOT NULL,
  `modulname` varchar(500) NOT NULL,
  `viewcondition` varchar(100) NOT NULL,
  `holder` varchar(500) NOT NULL,
  `ftitle` varchar(500) NOT NULL,
  `field` varchar(500) NOT NULL,
  `fieldidcus` varchar(500) NOT NULL,
  `fieldkeyg` varchar(200) NOT NULL,
  `action` varchar(500) NOT NULL,
  `buttoncall` varchar(200) NOT NULL,
  `page` varchar(500) NOT NULL,
  `param` varchar(500) NOT NULL,
  `bfun` varchar(400) NOT NULL
,PRIMARY KEY (`ghvid`)){$collate}");


/*
array_push($queries, "CREATE TABLE IF NOT EXISTS zohoview (
          zohoid bigint(20) NOT NULL AUTO_INCREMENT,
           zohomodue varchar(1000) NOT NULL,
         viewtitle varchar(1000) NOT NULL,
           viewsave varchar(1000) NOT NULL,PRIMARY KEY (`zohoid`)){$collate}"
);
*/




foreach ($queries as $key => $sql) {
    dbDelta( $sql );
}
          

   require(ABSPATH . 'wp-config.php');
//$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db=DB_HOST;
$du=DB_USER;
$Dpas=DB_PASSWORD;
$DN=DB_NAME;
        
$authTokenFile = dirname(__FILE__). "/configuration.php";
//$fp = fopen($authTokenFile, 'w');
$coni='$con'."=mysqli_connect('".$db."','".$du."','".$Dpas."','".$DN."')";

//fwrite($fp, $coni);
//fclose($fp);        
file_put_contents($authTokenFile,"<?php $coni ?>");
        
  

}
register_activation_hook( __FILE__, 'gohighdbcreate' );












  function dbload(){
include('highsetting.php');
   
  }
function fieldgenerate()
{
   //fieldshortcodemaker.php
   include('fieldshortcodemaker.php');

}
function tablegenerate()
{

  include('tablecode.php');
}

function countadd(){
  include('addcount.php');

}




include('keyhold.php');
include("fieldviewcaller.php");
include("tableview.php");
include("calladdcount.php");

//jquery loader
include("fieldviewjquery.php");
  
  ?>