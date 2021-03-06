
<?php
/**
 * Would generate the widget for author profile
 * However this widget is under cunstruction and should be available by next update.
 *
 * @package Supernova
 * @since Supenova 1.5.4
 * @license GPL 2.0
 */

add_action('widgets_init', 'register_supernova_profile_widget' );
function register_supernova_profile_widget(){
	register_widget( 'supernova_profile_widget' );
	}

class supernova_profile_widget extends WP_Widget{
	
	function supernova_recent_posts(){
			
			$widget_opts = array(
				'classname' => 'supernova_profile_widget',
				'description' => __('This widget allows you to add your profile information.', 'Supernova'),
			);
			
			$control_opts = array( 
				'width' => 250,
				'height' => 350, 
				'id_base' => 'supernova_profile'
			 );
						
			$this->WP_Widget('supernova_profile', __('Profile', 'Supernova'), $widget_opts, $control_opts );			
		}
		
	function widget($arg, $instance){
		extract($arg, EXTR_SKIP);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		?>		
        
        <?php echo $before_widget; ?>
        <?php echo $before_title. $title. $after_title; ?>
        
          <!--OUTPUT STARTS -->      
          
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $number,
			));
			?>
			
			<div class="recent_posts">
			
			<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
				<div class="sidebar-posts">

                        <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
                        <a class="recentpost_img_link" href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('side-thumb'); ?></a>
					<?php } ?>

					<h4><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
					<div class="sidebar-post-meta"><span class="date"><?php the_time( get_option('date_format') ); ?></span><span class="comments">&nbsp;<?php comments_popup_link(' ', '1 comment', 'Comments: %'); ?></span></div>
				</div>
				
			<?php endwhile; ?>
			
			</div>        
        <!--OUTPUT ENDS -->
        <?php echo $after_widget; ?>               
        
		<?php				
		}
				
	function update($new_instance, $old_instance){
				$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;		
		}	
	
		//dashboard form
	function form($instance){
		
		$defaults = array( 'title' =>'Recent posts', 'number' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults );

		//Widget Title: Text Input 
		echo '<p>';
                    echo '<label for="'.$this->get_field_id( 'title' ).'">'. __('Title:','Supernova').'</label>';
                    echo '<input id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" value="'.$instance['title'].'" style="width:90%;" />';
		echo '</p>';
		
		//Number of posts
		echo '<p>';
                echo '<label for="'.$this->get_field_id( 'number' ).'">'. __('Number of posts to show:','Supernova').'</label>';
                echo '<input id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" value="'.$instance['number'].'" size="3" />';
		echo '</p>';
		}
	}