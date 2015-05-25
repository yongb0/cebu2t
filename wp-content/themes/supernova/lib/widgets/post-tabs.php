<?php
/**
 * Would generate the widget for tabber. 
 *
 * @package Supernova
 * @since Supenova 1.4.8
 * @license GPL 2.0
 */

add_action('widgets_init', 'register_supernova_tabber' );
function register_supernova_tabber()
{
    register_widget( 'supernova_tabber' );
}

class supernova_tabber extends WP_Widget
{
	
	function supernova_tabber(){
			
			$widget_opts = array(
				'classname' => 'supernova',
				'description' => __('This widget will show tabs of recent posts and other', 'Supernova'),
			);
			
			$control_opts = array( 
				'width' => 250,
				'height' => 350, 
				'id_base' => 'supernova_tabber'
			 );
						
			$this->WP_Widget('supernova_tabber', __('Multi Tabs', 'Supernova'), $widget_opts, $control_opts );			
		}
		
	function widget($arg, $instance){
		extract($arg, EXTR_SKIP);
		
        /* Our variables from the widget settings. */
        $title        = apply_filters('widget_title', $instance['title'] );
        $number       = $instance['number'];
        $show_thumb   = (isset($instance['show_thumb'])) ? $instance['show_thumb'] : 1 ;
        $comment_date = (isset($instance['comment_date'])) ? $instance['comment_date'] : 1 ;
        $tab_one      = ($instance['tab_one'] && $instance['tab_one'] != 0 )   ? '<li><span class="supernova_tabber_current">'.supernova_get_selected_tabber($instance['tab_one']).'</span></li>'   : '';
        $tab_two      = ($instance['tab_two'] && $instance['tab_two'] != 0 )   ? '<li><span>'.supernova_get_selected_tabber($instance['tab_two']).'</span></li>'   : '';
        $tab_three    = ($instance['tab_three'] && $instance['tab_three'] != 0 ) ? '<li><span>'.supernova_get_selected_tabber($instance['tab_three']).'</span></li>' : '';
                        
             echo $before_widget;                
        
          //OUTPUT STARTS             
                ?>
                <div class="supernova_tabber">
                    <div class="supernova_tabber_top">
                        <ul>
                            <?php echo $tab_one.$tab_two.$tab_three; ?>
                        </ul>
                    </div>
                    <div class="supernova_tabber_contents">
                        <?php if($instance['tab_one'] != '0') ?>
                        <div><?php echo supernova_tabber_posts( $instance['tab_one'] , $number, $show_thumb, $comment_date); ?></div>
                        <?php if($instance['tab_two'] != '0' ) ?>
                        <div><?php echo supernova_tabber_posts( $instance['tab_two'] , $number, $show_thumb, $comment_date); ?></div>
                        <?php if($instance['tab_three'] !='0' ) ?>
                        <div><?php echo supernova_tabber_posts( $instance['tab_three'] , $number, $show_thumb, $comment_date); ?></div>
                    </div>
                </div>

                <?php
        
        //OUTPUT ENDS
             
        echo $after_widget;
        
		}
				
	function update($new_instance, $old_instance){
				$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
                $instance['show_thumb'] = strip_tags( $new_instance['show_thumb'] );
                $instance['comment_date'] = strip_tags( $new_instance['comment_date'] );                
                $instance['tab_one'] = strip_tags( $new_instance['tab_one'] );
                $instance['tab_two'] = strip_tags( $new_instance['tab_two'] );
                $instance['tab_three'] = strip_tags( $new_instance['tab_three'] );

		return $instance;		
		}	
	
	function form($instance){
		
            $defaults = array( 'title' =>'Tabber', 'number' => 5, 'tab_one'=> 1, 'tab_two' => 2 , 'tab_three' => 3, 'show_thumb' => 1, 'comment_date' => 1);
            $instance = wp_parse_args( (array) $instance, $defaults );
            $key_values = array('one', 'two', 'three');
            
            foreach($key_values as $id){
                echo '<p>';
                    echo '<label for="'.$this->get_field_id( 'tab_'.$id ).'">'. __('Tab ','Supernova').$id.' :</label>';

                    echo '<select name="'.$this->get_field_name( 'tab_'.$id ).'" id="'.$this->get_field_id( 'tab_'.$id ).'" >';                
                    echo '<option value = "'.$instance['tab_'.$id].'" >--'.supernova_get_selected_tabber($instance['tab_'.$id]).'--</option>';
                    echo '<option value = "0" >'.__('None', 'Supernova').'</option>';
                    echo '<option value = "1" >'.__('Recent Posts', 'Supernova').'</option>';
                    echo '<option value = "2" >'.__('Popular Posts', 'Supernova').'</option>';
                    echo '<option value = "3" >'.__('Recommended Posts', 'Supernova').'</option>';                                        
                    echo '<option value = "4" >'.__('Random', 'Supernova').'</option>';
                    echo '</select>';
                echo '</p>';
            }

            //Number of posts
            echo '<p>';
                echo '<label for="'.$this->get_field_id( 'number' ).'">'. __('Number of posts to show:','Supernova').'</label>';
                echo '<input id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" value="'.$instance['number'].'" size="2" />';
            echo '</p>';
            //Thumbnail Option
            echo '<p>';
                echo '<label for="'.$this->get_field_id( 'show_thumb' ).'">'. __('Show Thumbnail: ','Supernova').'</label>';
                echo '<input type ="checkbox" id="'.$this->get_field_id( 'show_thumb' ).'" name="'.$this->get_field_name( 'show_thumb' ).'" value="1" '.supernova_checked($instance['show_thumb'], 1).' />';
            echo '</p>';  
            //Comments or Date
            echo '<p>';                
        echo '<input type ="radio" id="sup_show_comment" name="'.$this->get_field_name( 'comment_date' ).'" value="1" '.supernova_checked($instance['comment_date'], 1).' />';
        echo '<label for="sup_show_comment">'. __('Comment: ','Supernova').'</label>';
                
        echo '<input type ="radio" id="sup_show_date" name="'.$this->get_field_name( 'comment_date' ).'" value="2" '.supernova_checked($instance['comment_date'], 2).' />';
        echo '<label for="sup_show_date">'. __('Date: ','Supernova').'</label>';
                
        echo '<input type ="radio" id="sup_show_none" name="'.$this->get_field_name( 'comment_date' ).'" value="3" '.supernova_checked($instance['comment_date'], 3).' />';            echo '<label for="sup_show_none">'. __('None: ','Supernova').'</label>';
            echo '</p>';
		}
}