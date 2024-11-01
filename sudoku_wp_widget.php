<?php
/*
Plugin Name: Sudoku widget for Wordpress 
Plugin URI: http://oreste.parlatano.org/wp/?p=69
Description: widget with sudoku grid ready to play
Author: Oreste Parlatano
Version: 1.0
Author URI: http://oreste.parlatano.org
*/   
   
/*  Copyright 2011  
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the i= mplied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Options
holes:  number of holes per row (min 2, max 6)
colo:   colour of sudoku numbers
back0:  background colour of sudoku table
fsiz:   size of sudoku numbers in pixels
ffam:   font-family of sudoku numbers
side:   physical size of sudoku 9×9 square plus buttons in pixels
bucol:  colour of buttons font
buback: colour of buttons background
bumar:  margin left of buttons
*/
#---------------------------------------------------------------------------------------------------
if(! class_exists('sudoku_widget_by_Oreste_Parlatano')) {
class sudoku_widget_by_Oreste_Parlatano extends WP_Widget {
#---------------------------------------------------------------------------------------------------
function sudoku_widget_by_Oreste_Parlatano() {
parent::WP_Widget(false, $name = 'sudoku_widget_by_Oreste_Parlatano');	
}
#---------------------------------------------------------------------------------------------------
function widget($args, $instance) {		
extract( $args );
$plugin_sub_dir = plugins_url().'/sudoku_wp_widget/sub/';
$title = apply_filters('widget_title', $instance['title']);
$questo_div_id = $widget_id.'_div4sudoku_js';
$opts = $instance;
array_shift($opts); 

echo $before_widget;
echo $before_title.$title.$after_title;

echo '<div id="'.$questo_div_id.'">';
echo '<img src="'.$plugin_sub_dir.'progress.gif" alt="wait" style="display:none" />';
echo '</div>';

echo '<script type="text/javascript">';
echo 'jQuery(document).ready(function($) {';
echo '$.ajax({';
echo 'url: \''.$plugin_sub_dir.'generate.php\',';
echo 'data: \'opts=\'+encodeURIComponent(\''.implode(',',$opts).'\'),';
echo 'dataType: "html",';
echo 'type: "GET",';
echo 'beforeSend: function(a){ $("#'.$questo_div_id.' img").show() },';
echo 'error: function(a,b,c){alert("Error loading script");},'; 
echo 'success: function(a,b){';
echo '$("#'.$questo_div_id.'").html(a);';

echo 'var s_bus = $("#'.$questo_div_id.' button");';
echo 'var s_inp = $("#'.$questo_div_id.' input:visible");';

echo 's_inp.keypress(function() {$(this).css(\'color\',\'black\');});';
echo 's_inp.each(function(i) { $(this).val(\'\') });';
echo 's_bus.eq(0).click(function() {';
echo '$(this).blur();';
echo 's_inp.each(function(i) {';
echo 'var v_u = $(this).val();';
echo 'var v_p = $(this).siblings().eq(0).val();';
echo 'if (v_u != \'\') {';
echo 'if (v_u == v_p) { $(this).css(\'color\',\'lightgreen\') } else { $(this).css(\'color\',\'red\') }';
echo '}';
echo '});';
echo '});';
echo 's_bus.eq(1).click(function() {';
echo '$(this).blur();';
echo 'if ( confirm(\'Are you sure to see the solution?\') ) {';
echo 's_inp.each(function(i) {';
echo 'var v_p = $(this).siblings().eq(0).val();';
echo 'var cell = $(this).parent().eq(0);';
echo '$(this).hide();';
echo 'cell.text(v_p);';
echo '});';
echo 's_bus.eq(0).hide();';
echo 's_bus.eq(1).hide();';
echo '}';
echo '});';

echo '},';
echo 'complete: function(a,b){ $("#'.$questo_div_id.' img").hide() }'; 
echo '});';
echo '});';
echo '</script>';

?>
<?php echo $after_widget; ?>
<?php
}
#---------------------------------------------------------------------------------------------------
function update($new_instance, $old_instance) {				
$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
$instance['holes'] = strip_tags($new_instance['holes']);
$instance['colo'] = strip_tags($new_instance['colo']);
$instance['back0'] = strip_tags($new_instance['back0']);
$instance['fsiz'] = strip_tags($new_instance['fsiz']);
$instance['ffam'] = strip_tags($new_instance['ffam']);
$instance['side'] = strip_tags($new_instance['side']);
$instance['bucol'] = strip_tags($new_instance['bucol']);
$instance['buback'] = strip_tags($new_instance['buback']);
$instance['bumar'] = strip_tags($new_instance['bumar']);
return $instance;
}
#---------------------------------------------------------------------------------------------------
function form($instance) {
$title = esc_attr($instance['title']);
$holes = esc_attr($instance['holes']);
$colo = esc_attr($instance['colo']);
$back0 = esc_attr($instance['back0']);
$fsiz = esc_attr($instance['fsiz']);
$ffam = esc_attr($instance['ffam']);
$side = esc_attr($instance['side']);
$bucol = esc_attr($instance['bucol']);
$buback = esc_attr($instance['buback']);
$bumar = esc_attr($instance['bumar']);
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('holes'); ?>"><?php _e('Holes:'); ?></label><br /> 
<select class="suwidget_by_o_sel_param" id="<?php echo $this->get_field_id('holes'); ?>" name="<?php echo $this->get_field_name('holes'); ?>">
<option value="0" <?php echo ($instance['holes'] == 0) ? 'selected="selected"':''; ?>>0</option>
<option value="1" <?php echo ($instance['holes'] == 1) ? 'selected="selected"':''; ?>>1</option>
<option value="2" <?php echo ($instance['holes'] == 2) ? 'selected="selected"':''; ?>>2</option>
<option value="3" <?php echo ($instance['holes'] == 3) ? 'selected="selected"':''; ?>>3</option>
<option value="4" <?php echo ($instance['holes'] == 4) ? 'selected="selected"':''; ?>>4</option>
<option value="5" <?php echo ($instance['holes'] == 5) ? 'selected="selected"':''; ?>>5</option>
<option value="6" <?php echo ($instance['holes'] == 6) ? 'selected="selected"':''; ?>>6</option>
</select></p>

<script type="text/javascript">
jQuery(document).ready(function($) {
$('#<?php echo $this->get_field_id('colo'); ?>_colorpicker').farbtastic('#<?php
$colo_id = $this->get_field_id('colo');echo $colo_id;?>');
$('#<?php echo $this->get_field_id('back0'); ?>_colorpicker').farbtastic('#<?php
$back0_id = $this->get_field_id('back0');echo $back0_id;?>');
$('#<?php echo $this->get_field_id('bucol'); ?>_colorpicker').farbtastic('#<?php
$bucol_id = $this->get_field_id('bucol');echo $bucol_id;?>');
$('#<?php echo $this->get_field_id('buback'); ?>_colorpicker').farbtastic('#<?php
$buback_id = $this->get_field_id('buback');echo $buback_id;?>');
});
</script>

<p>
<label for="<?php echo $this->get_field_id('colo'); ?>"><?php _e('Numbers color:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param_color" id="<?php echo $this->get_field_id('colo'); ?>" name="<?php echo $this->get_field_name('colo'); ?>" type="text" value="<?php echo $colo; ?>" />
<div id="<?php echo $this->get_field_id('colo'); ?>_colorpicker"></div>
</p>

<p>
<label for="<?php echo $this->get_field_id('back0'); ?>"><?php _e('Table background color:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param_color" id="<?php echo $this->get_field_id('back0'); ?>" name="<?php echo $this->get_field_name('back0'); ?>" type="text" value="<?php echo $back0; ?>" />
<div id="<?php echo $this->get_field_id('back0'); ?>_colorpicker"></div>
</p>

<p>
<label for="<?php echo $this->get_field_id('fsiz'); ?>"><?php _e('Numbers font size:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param" id="<?php echo $this->get_field_id('fsiz'); ?>" name="<?php echo $this->get_field_name('fsiz'); ?>" type="text" value="<?php echo $fsiz; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('ffam'); ?>"><?php _e('Numbers font family:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param" id="<?php echo $this->get_field_id('ffam'); ?>" name="<?php echo $this->get_field_name('ffam'); ?>" type="text" value="<?php echo $ffam; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('side'); ?>"><?php _e('Table side length:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param" id="<?php echo $this->get_field_id('side'); ?>" name="<?php echo $this->get_field_name('side'); ?>" type="text" value="<?php echo $side; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('bucol'); ?>"><?php _e('Buttons font color:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param_color" id="<?php echo $this->get_field_id('bucol'); ?>" name="<?php echo $this->get_field_name('bucol'); ?>" type="text" value="<?php echo $bucol; ?>" />
<div id="<?php echo $this->get_field_id('bucol'); ?>_colorpicker"></div>
</p>

<p>
<label for="<?php echo $this->get_field_id('buback'); ?>"><?php _e('Buttons background color:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param_color" id="<?php echo $this->get_field_id('buback'); ?>" name="<?php echo $this->get_field_name('buback'); ?>" type="text" value="<?php echo $buback; ?>" />
<div id="<?php echo $this->get_field_id('buback'); ?>_colorpicker"></div>
</p>

<p>
<label for="<?php echo $this->get_field_id('bumar'); ?>"><?php _e('Buttons left margin:'); ?></label><br /> 
<input class="suwidget_by_o_inp_param" id="<?php echo $this->get_field_id('bumar'); ?>" name="<?php echo $this->get_field_name('bumar'); ?>" type="text" value="<?php echo $bumar; ?>" />
</p>

<p style="font-size:x-small;color:black;">
<a href="http://oreste.parlatano.org/wp/?p=69" target="_blank">Plugin URI</a>
</p>

<?php 
}
#---------------------------------------------------------------------------------------------------

#-------------------------------------------------------------------------------------------------------------
}
}
#-------------------------------------------------------------------------------------------------------------
function install_jquery_scripts_4_wsudoku() {
if (stripos($_SERVER['REQUEST_URI'],'widgets.php')!== false) {
wp_enqueue_script('jquery');
wp_enqueue_script('farbtastic');
wp_enqueue_style('farbtastic');
}
}
#---------------------------------------------------------------------------------------------------
add_action('widgets_init', create_function('', 'return register_widget("sudoku_widget_by_Oreste_Parlatano");'));
add_action('init', 'install_jquery_scripts_4_wsudoku');
#---------------------------------------------------------------------------------------------------
?>