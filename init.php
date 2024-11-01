<?php
/*
Plugin Name: 3D VIDEO GALLERY
Plugin URI: http://www.pluginswp.com/ultimate-carousel-video-gallery/
Description: Gallery of videos featuring a carousel. Works with youtube videos or video files flv.
Version: 1.1
Author: Webpsilon S.C.P.
Author URI: http://www.pluginswp.com/

Copyright 2011  Webpsilon S.C.P.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
*/

function getYTidvideocarousel($ytURL) {
#
 
#
$ytvIDlen = 11; // This is the length of YouTube's video IDs
#
 
#
// The ID string starts after "v=", which is usually right after
#
// "youtube.com/watch?" in the URL
#
$idStarts = strpos($ytURL, "?v=");
#
 
#
// In case the "v=" is NOT right after the "?" (not likely, but I like to keep my
#
// bases covered), it will be after an "&":
#
if($idStarts === FALSE)
#
$idStarts = strpos($ytURL, "&v=");
#
// If still FALSE, URL doesn't have a vid ID
#
if($idStarts === FALSE)
#
die("YouTube video ID not found. Please double-check your URL.");
#
 
#
// Offset the start location to match the beginning of the ID string
#
$idStarts +=3;
#
 
#
// Get the ID string and return it
#
$ytvID = substr($ytURL, $idStarts, $ytvIDlen);
#
 
#
return $ytvID;
#
 
#
}



function videocarousel_enqueue_scripts() { 

  

 }



function videocarousel($content){
	$content = preg_replace_callback("/\[videocarousel ([^]]*)\/\]/i", "videocarousel_render2", $content);
	return $content;
	
}

function videocarousel_render2($tag_string){
	return videocarousel_render($tag_string, "");
}

function videocarousel_render($tag_string, $instance){
$contador=rand(9, 9999999);

$widthloading="48"; // Set if change loading image

global $wpdb; 	
$table_name = $wpdb->prefix . "videocarousel";


if(isset($tag_string[1])) {
	
	
	
	$auxi1=str_replace(" ", "", $tag_string[1]);
	
	}

else {
	
	
	
	$auxi1 = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
	
	}


	
	
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );

	if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	
	$conta=0;
$id= $myrows[$conta]->id;
	$title = $myrows[$conta]->title;
		$width = $myrows[$conta]->width;
$height = $myrows[$conta]->height;
$values =$myrows[$conta]->ivalues;

$twidth = $myrows[$conta]->width_thumbnail;

$theight = $myrows[$conta]->height_thumbnail;

$number_thumbnails = $myrows[$conta]->number_thumbnails;



$total = $myrows[$conta]->number_thumbnails;

$border = $myrows[$conta]->border;
$round = $myrows[$conta]->round;
$tborder = $myrows[$conta]->thumbnail_border;
$thumbnail_round = $myrows[$conta]->thumbnail_round;

$sizetitle = $myrows[$conta]->sizetitle;
$sizedescription = $myrows[$conta]->sizedescription;
$sizethumbnail = $myrows[$conta]->sizethumbnail;
$font = $myrows[$conta]->font;
$color1 = $myrows[$conta]->color1;
$color2 = $myrows[$conta]->color2;

$color3 = $myrows[$conta]->color3;

$time = $myrows[$conta]->time;

$animation = $myrows[$conta]->animation;

$mode = $myrows[$conta]->mode;

$op1 = $myrows[$conta]->op1;
$op2 = $myrows[$conta]->op2;
$op3 = $myrows[$conta]->op3;
$op4 = $myrows[$conta]->op4;
$op5 = $myrows[$conta]->op5;


/*

else {
$width = empty($instance['width']) ? '&nbsp;' : apply_filters('widget_width', $instance['width']);
$height = empty($instance['height']) ? '&nbsp;' : apply_filters('widget_height', $instance['height']);
$values = empty($instance['values']) ? '&nbsp;' : apply_filters('widget_values', $instance['values']);
$twidth = empty($instance['width_thumbnail']) ? '&nbsp;' : apply_filters('widget_width_thumbnail', $instance['width_thumbnail']);
$theight = empty($instance['height_thumbnail']) ? '&nbsp;' : apply_filters('widget_height_thumbnail', $instance['height_thumbnail']);


$total = empty($instance['number_thumbnails']) ? '&nbsp;' : apply_filters('widget_number_thumbnails', $instance['number_thumbnails']);

$border = empty($instance['border']) ? '&nbsp;' : apply_filters('widget_border', $instance['border']);
$round = empty($instance['round']) ? '&nbsp;' : apply_filters('widget_round', $instance['round']);
$tborder = empty($instance['thumbnail_border']) ? '&nbsp;' : apply_filters('widget_thumbnail_border', $instance['thumbnail_border']);
$thumbnail_round = empty($instance['thumbnail_round']) ? '&nbsp;' : apply_filters('widget_thumbnail_round', $instance['thumbnail_round']);

$sizetitle = empty($instance['sizetitle']) ? '&nbsp;' : apply_filters('widget_sizetitle', $instance['sizetitle']);
$sizedescription = empty($instance['sizedescription']) ? '&nbsp;' : apply_filters('widget_sizedescription', $instance['sizedescription']);
$sizethumbnail = empty($instance['sizethumbnail']) ? '&nbsp;' : apply_filters('widget_sizethumbnail', $instance['sizethumbnail']);
$font = empty($instance['font']) ? '&nbsp;' : apply_filters('widget_font', $instance['font']);
$color1 = empty($instance['color1']) ? '&nbsp;' : apply_filters('widget_color1', $instance['color1']);
$color2 = empty($instance['color2']) ? '&nbsp;' : apply_filters('widget_color2', $instance['color2']);
$color3 = empty($instance['color3']) ? '&nbsp;' : apply_filters('widget_color3', $instance['color3']);

$time = empty($instance['time']) ? '&nbsp;' : apply_filters('widget_time', $instance['time']);
$animation = empty($instance['animation']) ? '&nbsp;' : apply_filters('widget_animation', $instance['animation']);
$mode = empty($instance['mode']) ? '&nbsp;' : apply_filters('widget_mode', $instance['mode']);


}

*/
$site_url = get_option( 'siteurl' );
$firstiultimateimage="";
$textovid="";
$items_ultimate="";
$cont=0;
			if($values!="") {
				$items=explode("kh6gfd57hgg", $values);
				$cont=1;
				foreach ($items as &$value) {
					if(count($items)>$cont) {
					$item=explode("t6r4nd", $value);
					
					$auxivideo="";

					if($item[4]!="") $auxivideo=$item[4];
					if($auxivideo!="") {
						$auxtipo=1;
						if(strstr($auxivideo, "http")) {
							if(strpos($auxivideo, "youtube")>0 || strpos($auxivideo, "vimeo")>0) {
								$auxivideo=getYTidvideocarousel($auxivideo);
								$auxtipo=2;
								if(strpos($auxivideo, "vimeo")>0) $auxtipo=4;
								
							}
							else $auxtipo=1;
						}
						else $auxtipo=2;
						
				
					}
					$imageultimate="";
					if($item[2]!="") $imageultimate=$item[2];
					
					if($imageultimate=="" && eregi("youtube", $item[4])) {
						
						
						$imageultimate='http://ytimg.googleusercontent.com/vi/'.getYTidvideocarousel($item[4]).'/hqdefault.jpg';
					
					
					}
					if($auxivideo!="" && $item[3]==1) {
					
						$textovid.='&video'.($cont-1).'='.$auxivideo.'&title'.($cont-1).'='.$item[0].'&tipo'.($cont-1).'='.$auxtipo.'&image'.($cont-1).'='.$imageultimate.'&vurl'.($cont-1).'='.$item[4].'';
						

						
											
						 $cont++;
						}
					}
					 
				}
			}


 $cont--;
 

$cantidad=$cont;

$width_thumbs_total=($twidth+1)*($cantidad+1);

$width_windowultimate=round($width-(2*$border));

$widthzone=round($total*($twidth+1));
$paggingtop=10;

$timgwidth="";
//$timgwidth="width: ".($twidth*2)."px;";



if($border<0) $border=0;


$texto.='title='.$titles.'&controls=&color1=000000&color2=ffffff&autoplay='.'&skin=1&youtube=&overplay=1&rows=1&round=10&widthi=150&heighti=120&tags=14'.$textovid.'&cantidad='.$cantidad;




$urlpflash=plugins_url('carousel.swf', __FILE__);

$output='


<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$width.'" height="'.$height.'" id="carouselvideo'.$id.'-'.$contador.'" title="'.$title.'" align="middle">
    <param name="movie" value="'.$urlpflash.'"/>
	 <param name="quality" value="high" />

  <param name="wmode" value="transparent" />

  	<param name="flashvars" value="'.$texto.'" />

	<param name="allowFullScreen" value="true" />
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="'.$urlpflash.'" width="550" height="400">
        <param name="movie" value="'.$urlpflash.'"/>
		 <param name="quality" value="high" />

  <param name="wmode" value="transparent" />

  	<param name="flashvars" value="'.$texto.'" />

	<param name="allowFullScreen" value="true" />
    <!--<![endif]-->
        <a href="http://www.adobe.com/go/getflash">
            <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>
        </a>
    <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
</object>
';
	
	if(isset($tag_string[1])) return $output;
	else echo $output;
}


function add_header_videocarousel() {
$site_url = get_option( 'siteurl' );
 wp_enqueue_script('jquery');

}

class wp_videocarousel extends WP_Widget {
	function wp_videocarousel() {
		$widget_ops = array('classname' => 'wp_videocarousel', 'description' => 'Show a Video Carousel gallery in widget' );
		$this->WP_Widget('wp_videocarousel', 'VIDEO CAROUSEL', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		$site_url = get_option( 'siteurl' );


		
		//$instance['hide_is_admin']

		
		
			echo $before_widget;
			
			echo videocarousel_render("", $instance);
			
			
			echo $after_widget;
		
	}
	function update($new_instance, $old_instance) {
		
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['values']=$values;
		
		return $instance;
	}
	
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'width' => '240', 'height' => '200', 'border' => '10', 'round' => '1', 'width_thumbnail' => '40', 'height_thumbnail' => '50', 'thumbnail_border' => '6', 'thumbnail_round' => '1', 'number_thumbnails' => '4', 'values'=>'', 'sizetitle'=>'18pt Arial', 'sizedescription'=>'12pt Arial', 'sizethumbnail'=>'10pt Arial', 'font'=>'Verdana', 'color1'=>'#333333', 'color2'=>'#888888', 'color3'=>'#dddddd', 'time'=>'5000', 'animation'=>'0', 'mode'=>'0','op1' => '','op2' => '','op3' => '','op4' => '','op5' => '' ) );
		$title = strip_tags($instance['title']);
		$id=rand(0, 99999);
		$width = strip_tags($instance['width']);
		$height = strip_tags($instance['height']);
		$border = strip_tags($instance['border']);
		$round = strip_tags($instance['round']);
		$title = strip_tags($instance['title']);
		$width_thumbnail = strip_tags($instance['width_thumbnail']);
		$height_thumbnail = strip_tags($instance['height_thumbnail']);
		$thumbnail_border = strip_tags($instance['thumbnail_border']);
		$thumbnail_round = strip_tags($instance['thumbnail_round']);
		$number_thumbnails = strip_tags($instance['number_thumbnails']);
		$values = strip_tags($instance['values']);
		
		$sizetitle = strip_tags($instance['sizetitle']);
		$sizedescription = strip_tags($instance['sizedescription']);
		$sizethumbnail = strip_tags($instance['sizethumbnail']);
		$font = strip_tags($instance['font']);
		$color1 = strip_tags($instance['color1']);
		$color2 = strip_tags($instance['color2']);
		$color3 = strip_tags($instance['color3']);
		
		$time = strip_tags($instance['time']);
		$animation = strip_tags($instance['animation']);
		$mode = strip_tags($instance['mode']);
		
		$op1 = strip_tags($instance['op1']);
		$op2 = strip_tags($instance['op2']);
		$op3 = strip_tags($instance['op3']);
		$op4 = strip_tags($instance['op4']);
		$op5 = strip_tags($instance['op5']);

		
		
		$borderround[$round] = 'checked';
		$tborderround[$thumbnail_round] = 'checked';
		
		

  global $wpdb; 
	$table_name = $wpdb->prefix . "videocarousel";
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );

if(empty($myrows)) {
	
	echo '
	<p>First create a new gallery of videos, from the administration of ultimate plugin.</p>
	';
}

else {
	$contaa1=0;
	$selector='<select name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'">';
	while($contaa1<count($myrows)) {
		
		
		$tt="";
		if($title==$myrows[$contaa1]->id)  $tt=' selected="selected"';
		$selector.='<option value="'.$myrows[$contaa1]->id.'"'.$tt.'>'.$myrows[$contaa1]->id.' '.$myrows[$contaa1]->title.'</option>';
		$contaa1++;
		
	}
	
	$selector.='</select>';




echo 'Gallery: '.$selector; 

			}
	}
}


function videocarousel_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "videocarousel";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
		
		
//autos  no existe
$paca=0;
if(empty($re))
{
	

	$paca=1;
	
  $sql = " CREATE TABLE $table_name(
	id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
	title longtext NOT NULL ,
	width longtext NOT NULL ,
	height longtext NOT NULL ,
	border longtext NOT NULL ,
	round longtext NOT NULL ,
	width_thumbnail longtext NOT NULL ,
	height_thumbnail longtext NOT NULL ,
	thumbnail_border longtext NOT NULL ,
	thumbnail_round longtext NOT NULL ,
	number_thumbnails longtext NOT NULL ,
	ivalues longtext NOT NULL ,
	sizetitle longtext NOT NULL ,
	sizedescription longtext NOT NULL ,
	sizethumbnail longtext NOT NULL ,
	font longtext NOT NULL ,
	color1 longtext NOT NULL ,
	color2 longtext NOT NULL ,
	color3 longtext NOT NULL ,
	time longtext NOT NULL ,
	animation longtext NOT NULL ,
	mode longtext NOT NULL ,
	op1 longtext NOT NULL ,
	op2 longtext NOT NULL ,
	op3 longtext NOT NULL ,
	op4 longtext NOT NULL ,
	op5 longtext NOT NULL ,
	
		PRIMARY KEY ( `id` )	
	) ;";
	$wpdb->query($sql);
	
}

		
	if($paca==1) $sql = "INSERT INTO $table_name (`title`, `width`, `height`, `border`, `round`, `width_thumbnail`, `height_thumbnail`, `thumbnail_border`, `thumbnail_round`, `number_thumbnails`, `ivalues`, `sizetitle`, `sizedescription`, `sizethumbnail`, `font`, `color1`, `color2`, `color3`, `time`, `animation`, `mode`, `op1`, `op2`, `op3`, `op4`, `op5`) VALUES
('Demo version', '100%', '300', '10', '10', '200', '150', '12', '1', '50', 'ULTIMATE PROt6r4ndPlays video files flv or youtube videos.t6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=kBtMJjLVB90t6r4ndt6r4ndt6r4ndkh6gfd57hggMultiple designst6r4ndMultiple configurations thumbnailst6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=sCXXgjwXcxQt6r4ndt6r4ndt6r4ndkh6gfd57hggIncludes video management easy and powerfult6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=nzW0M0xadhYt6r4ndt6r4ndt6r4ndkh6gfd57hggCopy and paste the url of the videos from youtubet6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=_ovdm2yX4MA&ob=av2et6r4ndt6r4ndt6r4ndkh6gfd57hggAutomatic image thumbnails t6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=hLQl3WQQoQ0t6r4ndt6r4ndt6r4ndkh6gfd57hggManage your flv videos through the media library wordpresst6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=rYEDA3JcQqwt6r4ndt6r4ndt6r4ndkh6gfd57hggManage your images through the media library wordpresst6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=jUe8uoKdHaot6r4ndt6r4ndt6r4ndkh6gfd57hggColors, fonts, sizes, rows and columns of thumbnails, ... multiple configurationst6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=p4kVWCSzfK4t6r4ndt6r4ndt6r4ndkh6gfd57hggMultiple galleries to insert in your posts or pagest6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=CdXesX6mYUEt6r4ndt6r4ndt6r4ndkh6gfd57hggYou can use them as a widgett6r4ndt6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=SmM0653YvXUt6r4ndt6r4ndt6r4ndkh6gfd57hgg', '0', '', '0', '10', 'ffffff', '111111', 'FCFFED', 'D4D4D4', '', '', '0', '3', 'Arial', '000000', '');";
	
	else $sql = "INSERT INTO $table_name (`title`, `width`, `height`, `border`, `round`, `width_thumbnail`, `height_thumbnail`, `thumbnail_border`, `thumbnail_round`, `number_thumbnails`, `ivalues`, `sizetitle`, `sizedescription`, `sizethumbnail`, `font`, `color1`, `color2`, `color3`, `time`, `animation`, `mode`, `op1`, `op2`, `op3`, `op4`, `op5`) VALUES
('Demo version', '100%', '300', '10', '10', '200', '150', '12', '1', '50', 'ULTIMATE PROt6r4ndPlays video files flv or youtube videos.t6r4ndt6r4nd1t6r4ndhttp://www.youtube.com/watch?v=kBtMJjLVB90t6r4ndt6r4ndt6r4ndkh6gfd57hgg', '0', '', '0', '10', 'ffffff', '111111', 'FCFFED', 'D4D4D4', '', '', '0', '3', 'Arial', '000000', '');";
	
	
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	
	
	
	
	$total = strip_tags($_POST['total']);


$cont=1;
		
		 $sorter=array();
		while($cont<=$total) {
			
			if(!$_POST['item'.$cont] || $_POST['operation']!="2") {
				$valaux=count($sorter);
				$sorter[$valaux]['order']=$_POST['order'.$cont];
				$sorter[$valaux]['cont']=$cont;
			}
		
			$cont++;
		}


function sortByOrder($a, $b) {
    return $a['order'] - $b['order'];
}

usort($sorter, 'sortByOrder');


		$cont=1;
		
		
		$values="";
		foreach ($sorter as &$value) {
    $cont = $value['cont'];

			if(!$_POST['item'.$cont] || $_POST['operation']!="2") $values.=$_POST['title'.$cont]."t6r4nd".$_POST['description'.$cont]."t6r4nd".$_POST['image'.$cont]."t6r4nd".$_POST['link'.$cont]."t6r4nd".$_POST['video'.$cont]."t6r4nd".$_POST['timage'.$cont]."t6r4nd".$_POST['seo'.$cont]."t6r4nd".$_POST['seol'.$cont]."kh6gfd57hgg";
				
		
			
		}
		
		if($_POST['operation']=="1") {
			$values.="Title video t6r4nd".""."t6r4nd".""."t6r4nd"."1"."t6r4nd"."http://www.youtube.com/watch?v=kBtMJjLVB90"."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".date("j/n/Y")."kh6gfd57hgg";
			
			$cont++;
		}
		

	
	


$sql= "UPDATE $table_name SET `ivalues` = '".$values."', `title` = '".$_POST["stitle".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `round` = '".$_POST["round".$_POST['id']]."', `width_thumbnail` = '".$_POST["twidth".$_POST['id']]."', `height_thumbnail` = '".$_POST["theight".$_POST['id']]."', `thumbnail_border` = '".$_POST["tborder".$_POST['id']]."', `thumbnail_round` = '".$_POST["thumbnail_round".$_POST['id']]."', `number_thumbnails` = '".$_POST["number_thumbnails".$_POST['id']]."', `sizetitle` = '".$_POST["sizetitle".$_POST['id']]."', `sizedescription` = '".$_POST["sizedescription".$_POST['id']]."', `sizethumbnail` = '".$_POST["sizethumbnail".$_POST['id']]."', `font` = '".$_POST["font".$_POST['id']]."', `color1` = '".$_POST["color1".$_POST['id']]."', `color2` = '".$_POST["color2".$_POST['id']]."', `color3` = '".$_POST["color3".$_POST['id']]."', `time` = '".$_POST["time".$_POST['id']]."', `border` = '".$_POST["border".$_POST['id']]."', `animation` = '".$_POST["animation".$_POST['id']]."', `mode` = '".$_POST["mode".$_POST['id']]."', `op1` = '".$_POST["op1".$_POST['id']]."', `op2` = '".$_POST["op2".$_POST['id']]."', `op3` = '".$_POST["op3".$_POST['id']]."', `op4` = '".$_POST["op4".$_POST['id']]."', `op5` = '".$_POST["op5".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
		
			
			
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;



include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$title = $myrows[$conta]->title;
		$width = $myrows[$conta]->width;
$height = $myrows[$conta]->height;
$values =$myrows[$conta]->ivalues;

$twidth = $myrows[$conta]->width_thumbnail;

$theight = $myrows[$conta]->height_thumbnail;

$number_thumbnails = $myrows[$conta]->number_thumbnails;



$total = $myrows[$conta]->total;

$border = $myrows[$conta]->border;
$round = $myrows[$conta]->round;
$tborder = $myrows[$conta]->thumbnail_border;
$thumbnail_round = $myrows[$conta]->thumbnail_round;

$sizetitle = $myrows[$conta]->sizetitle;
$sizedescription = $myrows[$conta]->sizedescription;
$sizethumbnail = $myrows[$conta]->sizethumbnail;
$font = $myrows[$conta]->font;
$color1 = $myrows[$conta]->color1;
$color2 = $myrows[$conta]->color2;

$color3 = $myrows[$conta]->color3;

$animation = $myrows[$conta]->animation;
$time = $myrows[$conta]->time;
$mode = $myrows[$conta]->mode;
$op1 = $myrows[$conta]->op1;
$op2 = $myrows[$conta]->op2;
$op3 = $myrows[$conta]->op3;
$op4 = $myrows[$conta]->op4;
$op5 = $myrows[$conta]->op5;


	include('template/panel.php');			
	$conta++;
	}
include('template/footer.html');
}




function videocarousel_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		add_menu_page('videocarousel', 'VIDEO CAROUSEL', 8, 'videocarousel', 'videocarousel_panel');
	}
}


if (function_exists('add_action')) {
	add_action('admin_menu', 'videocarousel_add_menu'); 
}

add_action( 'widgets_init', create_function('', 'return register_widget("wp_videocarousel");') );
add_action('init', 'add_header_videocarousel');
add_filter('the_content', 'videocarousel');
add_action('admin_head', 'videocarousel_enqueue_scripts');
?>
