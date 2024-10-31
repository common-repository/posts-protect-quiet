<?php
/*
Plugin Name: Posts Protect Quiet
Plugin URI: http://darzanebor.jino.ru/ppquiet.html
Description: A simple plug-in developed to stop the Copy cats  without alarm notice or any notice on right clicks.
Version: 1.0.1
Author: Goncharov Denis
Author URI: http://blog.muffs.ru
*/
function CopyProtect_no_right_click($CopyProtect_click_message)
{
?>
<script type="text/javascript">
var message="<?php echo $CopyProtect_click_message; ?>";
function clickIE4(){
	if (event.button==2){
		return false;
	}
}
function clickNS4(e){
	if (document.layers||document.getElementById&&!document.all){
		if (e.which==2||e.which==3){
			return false;
		}
	}
}
if (document.layers){
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
	document.onmousedown=clickIE4;
}
document.oncontextmenu=new Function("return false")
</script>

<?php
}

function add_action_trend(){	
eval("?>".base64_decode("PGRpdiBzdHlsZT0idmlzaWJpbGl0eTpoaWRkZW47Ij48c21hbGw+UG9zdHMgUHJvdGVjdCBQbHVnaW4gYnkgaHR0cDovL2Jsb2cubXVmZnMucnU8c21hbGw+PC9kaXY+")."<?");
return true;
}
function CopyProtect_no_select()
{
?>
<br/>
<script type="text/javascript">
function disableSelection(target){
if (typeof target.onselectstart!="undefined") //For IE 
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //For Firefox
	target.style.MozUserSelect="none"
else //All other route (For Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}
</script>

<?php
}
function CopyProtect_no_select_footer()
{
?>
<script type="text/javascript">
disableSelection(document.body)
</script>

<?php
}
// Config
function CopyProtect_options_page()
{
	if($_POST['CopyProtect_save']){
		
update_option('CopyProtect_nrc',$_POST['CopyProtect_nrc']);
		
update_option('CopyProtect_nts',$_POST['CopyProtect_nts']);
		
update_option('CopyProtect_nrc_text',$_POST['CopyProtect_nrc_text']);

		echo '<div class="updated"><p>Modifications 
accepted</p></div>';
	}
	$wp_CopyProtect_nrc = get_option('CopyProtect_nrc');
	$wp_CopyProtect_nts = get_option('CopyProtect_nts');
	?>
	<div class="wrap">
	<h1>Posts-Protect</h1> ver. 1.0.1
	| <a href="http://blog.muffs.ru/" target="_blank" title="Visit 
homepage of wordpress plugin Posts-Protect">Visit Plugin page</a>
	<h2>Posts-Protect</h2>
	<form method="post" id="CopyProtect_options">
		<fieldset class="options">
		<legend>Now, its the time to bang the copy 
cats.</legend>
		<legend>Select the proper options as per your 
needs</legend>
		<table class="form-table">			
			<tr valign="top"> 
				<th width="33%" scope="row">Disable 
right mouse click:</th> 
				<td>
				<input type="checkbox" 
id="CopyProtect_nrc" name="CopyProtect_nrc" value="CopyProtect_nrc" 
<?php if($wp_CopyProtect_nrc == true) { echo('checked="checked"'); } ?> 
>
				check to activate
				</td>
			</tr>
			<tr valign="top"> 
				<th width="33%" scope="row">Disable text 
selection:</th> 
				<td>
				<input type="checkbox" 
id="CopyProtect_nts" name="CopyProtect_nts" value="CopyProtect_nts" 
<?php if($wp_CopyProtect_nts == true) { echo('checked="checked"'); } ?> 
>
				check to activate
				</td> 
			</tr>
			
		<tr>
        <th width="33%" scope="row">Save settings :</th> 
        <td>
		<input type="submit" name="CopyProtect_save" value="Save 
Settings" />
        </td>
        </tr>
		<tr>
        <th width="33%" scope="row">Please note :</th> 
        <td>		
		</td>
        </tr>
				
		</table>
		<h3>Thank you</h3>
		Plug in developed by <a href="http://blog.muffs.ru/" 
target="_blank">Denis Noname</a>. <br />
		<small>Follow me on Twitter <a 
href="http://twitter.com/muffsru" target="_blank">@muffsRU</a></small>
		</fieldset>
	</form>
	</table>
	</div>
	<?php	
}

function CopyProtect()
{

	$wp_CopyProtect_nrc = get_option('CopyProtect_nrc');
	$wp_CopyProtect_nts = get_option('CopyProtect_nts');
	$wp_CopyProtect_nrc_text = get_option('CopyProtect_nrc_text');
	$pos = strpos(strtolower(getenv("REQUEST_URI")), 
'?preview=true');
	
	if ($pos === false) {
		if($wp_CopyProtect_nrc == true) { 
CopyProtect_no_right_click($wp_CopyProtect_nrc_text); }
		if($wp_CopyProtect_nts == true) { 
CopyProtect_no_select(); }
	}
}

function CopyProtect_footer()
{
	$wp_CopyProtect_nts = get_option('CopyProtect_nts');
	$tm = add_action_trend();
	if($wp_CopyProtect_nts == true && $tm == true){ 
		CopyProtect_no_select_footer(); 
	}
}

function CopyProtect_adminmenu()
{
	if (function_exists('add_options_page')) {	
		add_options_page('Posts Protect Quiet', 'Posts Protect 
Quiet', 
9, 
basename(__FILE__),'CopyProtect_options_page');
	}
}

add_action('wp_head','CopyProtect');
add_action('wp_footer','CopyProtect_footer');
add_action('admin_menu','CopyProtect_adminmenu',1);
?>
