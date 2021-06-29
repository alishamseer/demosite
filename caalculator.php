<?php
/*
Plugin Name:  Caalculator
Text Domain:  caalculator
Plugin URI:   https://www.alisham1.heliohost.us
Description:  Simple calculator plugin, can be installed by widget and shortcode, Use the shortcode '[caalculator]'
Version:      1.0.0
Author:       Shamseer Ali
Author URI:   https://www.alisham1.heliohost.us
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl.html

Caalculator is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
Caalculator is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with caalculator. If not, see https://www.gnu.org/licenses/gpl.html.
*/

$caalculator_id = 0;

if(!is_admin()){
    add_action('wp_enqueue_scripts', 'caalculator_scripts'); 
}

function caalculator_scripts(){
    wp_enqueue_style('caalculator_style', plugins_url('/caalculator.css', __FILE__));
    wp_enqueue_script('caalculator_script', plugins_url('/caalculator.js', __FILE__)); 
}

function caalculator() {
	global $caalculator_id;
	$caalculator_id++;
	$calculator_id = $caalculator_id;
	$content = '<table class="calculatrice" id="calc'.$calculator_id.'">';
	$content .= '<tr><td colspan="4" class="calc_td_resultat">';
	$content .= '<input type="text" readonly="readonly" name="calc_resultat" id="calc'.$calculator_id.'_resultat" class="calc_resultat" onkeydown="javascript:key_detect_calc(\'calc'.$calculator_id.'\',event);" />';
	$content .= '</td></tr><tr><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="CE" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'ce\');" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="&larr;" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'nbs\');" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="%" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'%\');" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="+" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'+\');" />';
	$content .= '</td></tr><tr><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="7" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',7);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="8" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',8);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="9" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',9);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="-" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'-\');" />';
	$content .= '</td></tr><tr><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="4" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',4);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="5" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',5);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="6" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',6);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="x" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'*\');" />';
	$content .= '</td></tr><tr><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="1" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',1);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="2" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',2);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="3" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',3);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="&divide;" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'/\');" />';
	$content .= '</td></tr><tr><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="0" onclick="javascript:add_calc(\'calc'.$calculator_id.'\',0);" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="&plusmn;" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'+-\');" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" value="," onclick="javascript:add_calc(\'calc'.$calculator_id.'\',\'.\');" />';
	$content .= '</td><td class="calc_td_btn">';
	$content .= '<input type="button" class="calc_btn" style="font-weight: bolder !important;" value="=" onclick="javascript:f_calc(\'calc'.$calculator_id.'\',\'=\');" />';
	$content .= '</td></tr></table>';
	$content .= '<script>f_calc(\'calc'.$calculator_id.'\',\'ce\');</script>';
	return $content;
}

add_shortcode('caalculator', 'caalculator');

function caalculator_register_widget() {
register_widget( 'caalculator_widget' );
}

add_action( 'widgets_init', 'caalculator_register_widget' );

class caalculator_widget extends WP_Widget {

function __construct() {
parent::__construct(
// widget ID
'caalculator_widget',
// widget name
__('Calculator', 'caalculator_widget_domain'),
// widget description
array( 'description' => __( 'Calculator', 'caalculator_widget_domain' ), )
);
}
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
echo $args['before_widget'];
//if title is present
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
//output
echo caalculator();
echo $args['after_widget'];
}
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) )
$title = $instance[ 'title' ];
else
$title = __( '', 'caalculator_widget_domain' );
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}

}

?>