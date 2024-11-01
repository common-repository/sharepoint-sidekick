<?php
/* 
 * Plugin Name:   Sharepoint Sidekick
 * Version:       0.1
 * Plugin URI:    http://www.sharepointsidekick.com/
 * Description:	  Sharepoint Sidekick Plugin will put a "Sidekick it" badge at the bottom of every post. On top, you can choose color scheme in the option page to suit your wordpress theme. It creates a viral effect and your articles will be viewed by millions of other bloggers and visitors from all over the planet. Turn those casual visitors to your raving fans by just installing this plugin. It will get traffic to your blog from all over the web. It is the next big thing in the SharePoint community so doesn’t miss the boat. It is your chance to announce the world how good your content is and show how awesome blogger you are. On top of it, you get a lot of SEO benefits for your website. Be Social and Go Viral! Just click on the activate link now.
 * Author:        sharepoint sidekick 
 * Author URI:    http://blog.sharepointsidekick.com/about/
 */
$sharepointsidekick_setting_page='settings_page_' . rtrim(basename(__FILE__), '.php');
add_action("load-{$sharepointsidekick_setting_page}",'sharepointsidekick_load');
function sharepointsidekick_load(){
	wp_enqueue_style('sharepointsidekick_style', plugins_url('/static/sharepointsidekick.css',__FILE__));
	wp_enqueue_script('sharepointsidekick_colorpicker', plugins_url('/static/colorpicker.js',__FILE__),array('jquery'));
	wp_enqueue_script('sharepointsidekick_js', plugins_url('/static/sharepointsidekick.js',__FILE__));
}

add_action('the_content','sharepointsidekick_content');
function sharepointsidekick_content($content){
	global $post;
	$sps = get_option('sharepointsidekick');
	$link = urlencode(get_permalink($post->ID)).$sps['imgQS'];
	$title = urlencode($post->post_title);
	$template ='
	<p>
	    <a rev="vote-for" href="http://www.sharepointsidekick.com/Submit?url={link}&title={title}">
	<img alt="sidekick it" src="http://www.sharepointsidekick.com/image.axd?url={link}" style="border:0px"/>
	   </a>
	</p>
	
	';
	$template = str_replace(array('{link}','{title}'),array($link,$title),$template);
	return $content.$template;

}
add_action('admin_menu','sharepointsidekick_add_menu_page');
function sharepointsidekick_add_menu_page(){
	add_options_page('Sharepoint Sidekick', 'Sharepoint Sidekick', 8, basename(__FILE__), 'sharepointsidekick_menu_page');
	
	if ( wp_verify_nonce( $_POST['sharepointsidekick_menu'], 'sharepointsidekick_menu' ) ){
		if(isset($_POST['sharepointsidekick_reset'])){
			delete_option('sharepointsidekick');
		}elseif(isset($_POST['sharepointsidekick_save'])){
			$sps = array();
			
			$sps['imgQS'] = $_POST['imgQS'];
			$sps['txtBorderColor']=$_POST['txtBorderColor'];
			$sps['txtTextBackColor']=$_POST['txtTextBackColor'];
			$sps['txtTextForeColor']=$_POST['txtTextForeColor'];
			$sps['txtCountBackColor']=$_POST['txtCountBackColor'];
			$sps['txtCountForeColor']=$_POST['txtCountForeColor'];
			update_option('sharepointsidekick',$sps);
		}
		wp_safe_redirect(
		  add_query_arg(
		  	'updated',
		  	'true',
			wp_get_referer()
		  )
		);
	}
}
function sharepointsidekick_menu_page(){
	$sps = get_option('sharepointsidekick');
	$txtBorderColor = $sps['txtBorderColor']?$sps['txtBorderColor']:'909090';
	$txtTextBackColor = $sps['txtTextBackColor']?$sps['txtTextBackColor']:'336699';
	$txtTextForeColor = $sps['txtTextForeColor']?$sps['txtTextForeColor']:'ffffff';
	$txtCountBackColor = $sps['txtCountBackColor']?$sps['txtCountBackColor']:'ededed';
	$txtCountForeColor = $sps['txtCountForeColor']?$sps['txtCountForeColor']:'000000';
	
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Sharepoint Sidekick</h2>
<h5><i>Please "preview" before click Save Settings.</i></h5>
<form method="post">
	<p><?php wp_nonce_field( 'sharepointsidekick_menu', 'sharepointsidekick_menu' );?> </p>
        <p>
            <label for="txtBorderColor">Border color:</label>
            <input id="txtBorderColor" name="txtBorderColor" type="text" maxlength="6" value="<?php echo $txtBorderColor;?>">
            <span id="spnBorderColor" class="color" style="background-color: #<?php echo $txtBorderColor;?> "></span>
        </p>
        <p>
            <label for="txtTextBackColor">sidekick it Backcolor:</label>
            <input id="txtTextBackColor" name="txtTextBackColor" type="text" maxlength="6" value="<?php echo $txtTextBackColor;?>">
            <span id="spnTextBackColor" class="color" style="background-color: #<?php echo $txtTextBackColor;?> "></span>
        </p>
        <p>
            <label for="txtTextForeColor">sidekick it Forecolor:</label>
            <input id="txtTextForeColor" name="txtTextForeColor" type="text" maxlength="6" value="<?php echo $txtTextForeColor;?>">
            <span id="spnTextForeColor" class="color" style="background-color: #<?php echo $txtTextForeColor;?> "></span>
        </p>
        <p>
            <label for="txtCountBackColor">Count Backcolor:</label>
            <input id="txtCountBackColor" name="txtCountBackColor" type="text" maxlength="6" value="<?php echo $txtCountBackColor;?>">
            <span id="spnCountBackColor" class="color" style="background-color: #<?php echo $txtCountBackColor;?> "></span>
        </p>
        <p>
            <label for="txtCountForeColor">Count Forecolor:</label>
            <input id="txtCountForeColor" name="txtCountForeColor" type="text" maxlength="6" value="<?php echo $txtCountForeColor;?>">
            <span id="spnCountForeColor" class="color" style="background-color: #<?php echo $txtCountForeColor;?> "></span>
        </p>
        <p id="imgPreview"></p>
        <p><input name="imgQS" id="imgQS" type="hidden" value="<?php echo $sps['imgQS'];?>"></p>
        <p><a id="lnkUpdateCode" class="actionLink" href="javascript:void(0)">preview</a></p>
	<p><input name="sharepointsidekick_save" class="button" type="submit" value="Save Settings" />&nbsp;&nbsp;<input name="sharepointsidekick_reset" class="button" type="submit" value="Reset" /></p>
</form>

	
	
	
	
	
	
	
	
<?php
}
?>
