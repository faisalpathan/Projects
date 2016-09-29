<?php 
class Business_elite_percent extends WP_Widget {
    function __construct(){
		$widget_ops = array('description' => __('Displays Percent', "business-elite"));
		$control_ops = array('width' => 400, 'height' => 500);
		parent::__construct(false,$name='Percent',$widget_ops,$control_ops);
	}
  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
			$title = $instance['title'];
			$percent = $instance['percent'];
			$completed_color = $instance['completed_color'];
			$to_do_color = $instance['to_do_color'];
			$percent_text_color = $instance['percent_text_color'];
			$radius = $instance['radius'];
			$line_width = $instance['line_width'];
			$time = $instance['time'];
			$percent_text = $instance['percent_text'];
			
		echo $before_widget;
		if ($title) {
		  echo $before_title . $title . $after_title;
		}
		$id = $this->get_field_id('title');
		preg_match_all('!\d+!', $id, $matches);
		$match = $matches[0][0];
		?>
<style>
@media only screen and (max-width: 640px) {
	.percent{
		margin: 0 auto;
		margin-bottom:10%;
	}
	.percent_text_title{margin-top:0;}
}

.widget_business_elite_percent{
	text-align: center;
}
.widget_business_elite_percent .percent{
 display: inline-block;
}

</style>
<script>
	function clor(canvas_id,percent,color1,color2,textcolor,radius,line_width, time) {
		var canvas = document.getElementById(canvas_id);
		var context = canvas.getContext('2d');
		var x = canvas.width / 2;
		var y = canvas.height / 2;
		var radius = radius;
		var  i=0;
		var interval= setInterval(function(){
			if(i==percent)
				clearInterval(interval);
			var startAngle = ((i/50)+1.5) * Math.PI;
			var endAngle = (((i+1.2)/50)+1.5) * Math.PI;
			var counterClockwise = false;
			context.beginPath();
			context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
			context.lineWidth = line_width;
			/* line color */
			context.strokeStyle = '#'+color1;
			context.stroke();
			context.clearRect(x-36,y-23,75,25)
			context.font="20px arial";
			context.fillStyle = '#'+textcolor;
			context.fillText(i+"%",x-18,y);
			i++; 
		},time)
		var startAngle = 0* Math.PI;
		var endAngle = 2 * Math.PI;
		var counterClockwise = false;
		context.beginPath();
		context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
		context.lineWidth = line_width;
		context.strokeStyle = '#'+color2;
		context.stroke();
	}
</script>

		<div class="percent" style="width: <?php echo ($radius*2)+15; ?>px;">
			<canvas id="myCanvas<?php echo $id; ?>" width="<?php echo ($radius*2)+15; ?>" height="<?php echo ($radius*2)+15; ?>"></canvas>
			<div width="<?php echo ($radius*2)+15; ?>" height="<?php echo ($radius*2)+15; ?>" style="text-align: center"><?php echo $percent_text; ?> </div>
		</div>

<script>   
	var y<?php echo $match; ?> = 0;
	jQuery( window ).scroll(function() {
	var height = jQuery(window).scrollTop();
	var height_canvas = jQuery('#myCanvas<?php echo $id; ?>').offset().top -600;
		if(height  > height_canvas) {
			if (y<?php echo $match; ?>==0){
					y<?php echo $match; ?>++;
			  clor('myCanvas<?php echo $id; ?>',<?php echo $percent; ?>,'<?php echo $completed_color; ?>','<?php echo $to_do_color; ?>','<?php echo $percent_text_color; ?>',<?php echo $radius; ?>,<?php echo $line_width; ?>,<?php echo $time; ?>);
			}
		}
	});
</script>
	<?php
	echo $after_widget;		
	}
	/*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['percent'] = $new_instance['percent'];
		$instance['completed_color'] = $new_instance['completed_color'];
		$instance['to_do_color'] = $new_instance['to_do_color'];
		$instance['percent_text_color'] = $new_instance['percent_text_color'];
		$instance['radius'] = $new_instance['radius'];
		$instance['line_width'] = $new_instance['line_width'];
		$instance['time'] = $new_instance['time'];
		$instance['percent_text'] = $new_instance['percent_text'];
		
		/* canvas_id,percent,color1,color2,textcolor,radius,line_width, time */
		return $instance;
	}
	/* Creates the form for the widget in the back-end. */
    function form($instance){
		/*Defaults */
		$defaults = array(
			'title' => '',
			'percent' => '75',
			'completed_color' => '0A7ED5',
			'to_do_color' => 'DDDDDD',
			'percent_text_color' => '000000',
			'radius' => '80',
			'line_width' => '10',
			'time' => '10',
			'percent_text' => ""
		);
		$instance = wp_parse_args((array)$instance, $defaults);
		$title = esc_attr( $instance['title'] );
		$percent = esc_attr( $instance['percent'] );
		$completed_color = $instance['completed_color'];
		$to_do_color = $instance['to_do_color'];
		$percent_text_color = $instance['percent_text_color'];
		$radius = $instance['radius'];
		$line_width = $instance['line_width'];
		$time = $instance['time'];
		$percent_text = $instance['percent_text']; ?>
		
<script>
if(typeof(jscolor)!='undefined')
	jscolor.bind();
 </script>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>"/></p>
		
		<p><label for="<?php echo $this->get_field_id('percent'); ?>">Percent:</label>
		<input id="<?php echo $this->get_field_id('percent'); ?>" name="<?php echo  $this->get_field_name('percent'); ?>" value="<?php echo $instance['percent'];?>">%</input></p>	
		
		<p><label for="<?php echo $this->get_field_id('completed_color'); ?>">Completed color:</label>
		<input id="<?php echo $this->get_field_id('completed_color'); ?>" class="color"  value="<?php echo $instance['completed_color'];?>" name="<?php echo  $this->get_field_name('completed_color'); ?>" ></input></p>
		
		<p><label for="<?php echo $this->get_field_id('to_do_color'); ?>">To do color:</label>
		<input id="<?php echo $this->get_field_id('to_do_color'); ?>" class="color"  value="<?php echo $instance['to_do_color'];?>" name="<?php echo  $this->get_field_name('to_do_color'); ?>" ></input></p>
		
		<p><label for="<?php echo $this->get_field_id('percent_text_color'); ?>">Percent text color:</label>
		<input id="<?php echo $this->get_field_id('percent_text_color'); ?>" class="color"  value="<?php echo $instance['percent_text_color'];?>" name="<?php echo  $this->get_field_name('percent_text_color'); ?>" ></input></p>
		
		<p><label for="<?php echo $this->get_field_id('radius'); ?>">Radius:</label>
		<input id="<?php echo $this->get_field_id('radius'); ?>" name="<?php echo  $this->get_field_name('radius'); ?>" value="<?php echo $instance['radius'];?>">px</input></p>
		
		<p><label for="<?php echo $this->get_field_id('line_width'); ?>">Line width:</label>
		<input id="<?php echo $this->get_field_id('line_width'); ?>" name="<?php echo  $this->get_field_name('line_width'); ?>" value="<?php echo $instance['line_width'];?>"></input></p>
		
		<p><label for="<?php echo $this->get_field_id('time'); ?>">Time:</label>
		<input id="<?php echo $this->get_field_id('time'); ?>" name="<?php echo  $this->get_field_name('time'); ?>" value="<?php echo $instance['time'];?>">second</input></p>
		
		<p><label for="<?php echo $this->get_field_id('percent_text'); ?>">Percent text:</label>
		<textarea cols="10" rows="5" class="widefat" id="<?php echo  $this->get_field_id('percent_text'); ?>" name="<?php echo $this->get_field_name('percent_text'); ?>'" ><?php echo stripslashes($percent_text); ?></textarea></p>
	<?php	
		}
	}
/* end web_buis_adv class */
add_action('widgets_init', create_function('', 'return register_widget("business_elite_percent");'))
?>