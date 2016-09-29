<?php
add_action('widgets_init', 'kyma_footer_widget_contact');
function kyma_footer_widget_contact()
{
    return register_widget('kyma_footer_contact_widget');
}

class kyma_footer_contact_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'kyma_footer_contact_widget', // Base ID
            __('Kyma Footer Contact', 'kyma'), // Name
            array('description' => __('Your contact details', 'kyma'),) // Args
        );
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : 'Contact Us';
        $Contact_address = !empty($instance['Contact_address']) ? apply_filters('widget_title', $instance['Contact_address']) : '4031 Linda Lane
								Santa Monica, CA 90403';
        $Contact_phone_number = !empty($instance['Contact_phone_number']) ? apply_filters('widget_title', $instance['Contact_phone_number']) : '0664-3225569';
        $website_add = !empty($instance['website_add']) ? apply_filters('widget_title', $instance['website_add']) : 'www.example.org';
        $Contact_email_address = !empty($instance['Contact_email_address']) ? apply_filters('widget_title', $instance['Contact_email_address']) : 'youremail@gmail.com';

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        ?>
        <address>
            <p><i class="fa fa-map-marker"></i> <?php if ($Contact_address) {
                    echo esc_attr($Contact_address);
                } else {
                    echo _('25, Lorem Lis Street', 'kyma');
                } ?></p>

            <p><i class="fa fa-phone"></i> <a
                    href="tel:<?php echo esc_attr($Contact_phone_number); ?>"><?php if ($Contact_phone_number) {
                        echo esc_attr($Contact_phone_number);
                    } else {
                        echo _('987-654-321', 'kyma');
                    } ?></a></p>

            <p><i class="fa fa-envelope"></i> <a href="mailto:<?php if ($Contact_email_address) {
                    echo sanitize_email($Contact_email_address);
                } else {
                    echo _('mail@me.com', 'kyma');
                } ?>"><?php if ($Contact_email_address) {
                        echo sanitize_email($Contact_email_address);
                    } else {
                        echo _('myemail@gmail.com', 'kyma');
                    } ?></a></p>

            <p><i class="fa fa-globe"></i> <?php if ($website_add) {
                    echo esc_attr($website_add);
                } else {
                    echo esc_attr('http://www.webhuntinfotech.com');
                } ?></p>
        </address>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Contact Info', 'kyma');
        }

        if (isset($instance['Contact_phone_number'])) {
            $Contact_phone_number = $instance['Contact_phone_number'];
        } else {
            $Contact_phone_number = __('0764-989879', 'kyma');
        }

        if (isset($instance['Contact_email_address'])) {
            $Contact_email_address = $instance['Contact_email_address'];
        } else {
            $Contact_email_address = __('contact@me.com ', 'kyma');
        }

        if (isset($instance['website_add'])) {
            $website_add = $instance['website_add'];
        } else {
            $website_add = __('http://www.webhuntinfotech.com', 'kyma');
        }

        if (isset($instance['Contact_address'])) {
            $Contact_address = $instance['Contact_address'];
        } else {
            $Contact_address = __('NewYork', 'kyma');
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kyma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p><label
                for="<?php echo esc_attr($this->get_field_id('Contact_phone_number')); ?>"><?php _e('Contact phone number:', 'kyma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('Contact_phone_number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('Contact_phone_number')); ?>" type="text"
                   value="<?php echo esc_attr($Contact_phone_number); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('Contact_email_address')); ?>"><?php _e('E-mail address:', 'kyma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('Contact_email_address')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('Contact_email_address')); ?>" type="text"
                   value="<?php echo esc_attr($Contact_email_address); ?>"/>
        </p>
        <p><label
                for="<?php echo esc_attr($this->get_field_id('website_add')); ?>"><?php _e('Website :', 'kyma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('website_add')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('website_add')); ?>" type="text"
                   value="<?php echo esc_attr($website_add); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('Contact_address')); ?>"><?php _e('Contact address:', 'kyma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('Contact_address')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('Contact_address')); ?>" type="text"
                   value="<?php echo esc_attr($Contact_address); ?>"/>
        </p>

    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['Contact_address'] = (!empty($new_instance['Contact_address'])) ? strip_tags($new_instance['Contact_address']) : '';
        $instance['timings'] = (!empty($new_instance['timings'])) ? strip_tags($new_instance['timings']) : '';
        $instance['website_add'] = (!empty($new_instance['website_add'])) ? strip_tags($new_instance['website_add']) : '';
        $instance['Contact_phone_number'] = (!empty($new_instance['Contact_phone_number'])) ? strip_tags($new_instance['Contact_phone_number']) : '';
        $instance['Contact_email_address'] = (!empty($new_instance['Contact_email_address'])) ? strip_tags($new_instance['Contact_email_address']) : '';
        return $instance;
    }
}

?>