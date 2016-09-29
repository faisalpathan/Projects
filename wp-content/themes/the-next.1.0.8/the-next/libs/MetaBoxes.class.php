<?php

class MetaBoxes
{
    private $MetaData;
    private $MetaBoxs;

    function __construct()
    {
        global $post;
        if (!empty($post))
            $this->MetaData = maybe_unserialize(get_post_meta($post->ID, 'wpeden_post_meta', true));
        $this->Actions();
    }

    function Actions()
    {
        add_action('admin_init', array($this, 'LoadMetaBoxes'), 0);
        add_action('save_post', array($this, 'SavePostMeta'), 10, 2);
    }

    function LoadMetaBoxes()
    {
        $this->MetaBoxs = array(
            'wpeden-icons' => array('title' => 'Featured Icon', 'callback' => array($this, 'Icons'), 'position' => 'side', 'priority' => 'core', 'post_type' => 'page'),
            'wpeden-post-settings' => array('title' => 'Post Format Settings', 'callback' => array($this, 'PostFormatSettings'), 'position' => 'normal', 'priority' => 'core', 'post_type' => 'post'),
            'wpeden-page-settings' => array('title' => 'Page Settings', 'callback' => array($this, 'PageSettings'), 'position' => 'normal', 'priority' => 'core', 'post_type' => 'page'),
            'wpeden-page-css' => array('title' => 'Page CSS', 'callback' => array($this, 'PageCss'), 'position' => 'normal', 'priority' => 'core', 'post_type' => 'page'),
        );
        $this->MetaBoxs = apply_filters("TheNext_MetaBox", $this->MetaBoxs);

        foreach ($this->MetaBoxs as $ID => $MetaBox) {
            extract($MetaBox);
            add_meta_box($ID, $title, $callback, $post_type, $position, $priority);
        }
    }

    /**
     * @usage Custom page css
     * @param $post
     */
    function PageCss($post)
    {
        if (!is_array($this->MetaData))
            $this->MetaData = maybe_unserialize(get_post_meta($post->ID, 'wpeden_post_meta', true));
        ?>
        <style>
            textarea {
                font-family: courier;
                height: 200px;
                width: 100%;
                padding: 20px;
            }
        </style>
        <textarea
            name="wpeden_post_meta[page_css]"><?php echo isset($this->MetaData['page_css']) ? wp_filter_nohtml_kses($this->MetaData['page_css']) : ''; ?></textarea>

        <?php
    }

    /**
     * @usage Page Icons
     * @param $post
     */
    function Icons($post)
    {

        if (!is_array($this->MetaData))
            $this->MetaData = maybe_unserialize(get_post_meta($post->ID, 'wpeden_post_meta', true));

        $icons = wpeden_all_icons();
        $icon = isset($this->MetaData['icon']) ? sanitize_text_field($this->MetaData['icon']) : '';

        ?>

        <script>
            jQuery(function ($) {
                $('.dicon').click(function () {
                    $('.dicon').removeClass('active');
                    $(this).addClass('active');
                });
            });
        </script>
        <div style="max-height: 200px;overflow: auto">
            <link href="<?php echo get_template_directory_uri() . '/fonts/icons/icons.css'; ?>" rel="stylesheet"
                  type="text/css"/>

            <?php
            if ($icon == '')
                echo "<label class='dicon active' title='No Icon'><input style='display:none;' type=radio name='wpeden_post_meta[icon]' value='' checked=checked ><i class='tn-arrow-up' style='color: transparent;'></i></label>";
            else
                echo "<label class='dicon active' title='{$icon}'><input style='display:none;' type=radio name='wpeden_post_meta[icon]' value='{$icon}' checked=checked ><i class='{$icon}'></i></label>";

            foreach ($icons as $class => $title) {
                $class = sanitize_text_field($class);
                $title = sanitize_text_field($title);
                if ($class != $icon)
                    echo "<label title='{$title}' class='dicon " . ($class == $icon ? 'active' : '') . "'><input style='display:none;' type=radio name='wpeden_post_meta[icon]' value='{$class}' " . checked($class, $icon, false) . "><i class='{$class}'></i></label>";
            }
            ?>

            <div style="clear: both;"></div>
        </div>
        <?php

    }

    /**
     * @usage Post format settings
     * @param $post
     */
    function PostFormatSettings($post)
    {
        ?>
        <div class="pfset" id="post-format-link-settings">
            <label for="spro"><b>Link URL</b></label><br/>
            <input type="text" style="width:100%" name="wpeden_post_meta[linkurl]" type="text"
                   value="<?php echo isset($this->MetaData['linkurl']) ? esc_url($this->MetaData['linkurl']) : ''; ?>"/><br/>
        </div>
        <div class="pfset" id="post-format-video-settings">
            <label for="spro"><b>Video URL</b></label><br/>
            <input type="text" style="width:100%" id="spro" name="wpeden_post_meta[videourl]" type="text"
                   value="<?php echo isset($this->MetaData['videourl']) ? esc_url($this->MetaData['videourl']) : ''; ?>"/><br/>
        </div>
        <script>
            jQuery(function ($) {
                $('#post-formats-select input[type=radio]').click(function () {
                    var id = '#' + this.id + '-settings'
                    $('.pfset').hide();
                    $(id).show();
                });
                $('.pfset').hide();
                $('#post-format-<?php echo get_post_format(); ?>-settings').show();
            });
        </script>
        <?php
    }


    /**
     * @usage Page settings
     * @param $post
     */
    function PageSettings($post)
    {
        if (!is_array($this->MetaData))
            $this->MetaData = maybe_unserialize(get_post_meta($post->ID, 'wpeden_post_meta', true));
        $pagebg = isset($this->MetaData['pagebg']) ? $this->MetaData['pagebg'] : '';
        $pagelayout = isset($this->MetaData['pagelayout']) ? $this->MetaData['pagelayout'] : '';
        $nav_header = isset($this->MetaData['nav_header']) ? $this->MetaData['nav_header'] : '';
        $page_header_style = isset($this->MetaData['page_header_style']) ? $this->MetaData['page_header_style'] : '';
        $left_sidebar = isset($this->MetaData['left_sidebar']) ? $this->MetaData['left_sidebar'] : '';
        $left_sidebar_width = isset($this->MetaData['left_sidebar_width']) ? $this->MetaData['left_sidebar_width'] : '';
        $right_sidebar = isset($this->MetaData['right_sidebar']) ? $this->MetaData['right_sidebar'] : '';
        $right_sidebar_width = isset($this->MetaData['right_sidebar_width']) ? $this->MetaData['right_sidebar_width'] : '';
        ?>

        <script>
            jQuery(function ($) {
                $('.ttip').tooltip();

                $('#layout-icons label').on('click', function () {
                    $('#layout-icons label').removeClass('active');
                    $(this).addClass('active');
                });

            });
        </script>
        <div class="w3eden wpeden-theme-options">

            <div class="panel panel-default">
                <div class="panel-heading">Custom Page Background</div>
                <div class="panel-body">
                    <?php echo WPEdenOptionFields::CustomBackground(array('id' => 'cpb', 'name' => 'wpeden_post_meta[pagebg]', 'selected' => $pagebg)); ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Page Layout & Header Styles</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Page Layout Type</b><br/>

                            <?php echo WPEdenOptionFields::LayoutType(array('id' => 'cpl', 'name' => 'wpeden_post_meta[pagelayout]', 'selected' => $pagelayout)); ?>
                        </div>
                        <div class="col-md-4"><b>Nav Header Style</b><br/>
                            <?php echo WPEdenOptionFields::HeaderStyles(array('id' => 'nav_header_dd', 'name' => 'wpeden_post_meta[nav_header]', 'default' => '', 'selected' => $nav_header)); ?>
                        </div>
                        <div class="col-md-4">
                            <b>Page Header Style</b><br/>
                            <?php echo WPEdenOptionFields::PageHeaderStyles(array('id' => 'page_header_dd', 'name' => 'wpeden_post_meta[page_header_style]', 'default' => '', 'selected' => $page_header_style)); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default" id="layout-icons">
                <div class="panel-heading">Sidebar Layout</div>
                <div class="panel-body">
                    <label class="<?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "no-sidebar" ? 'active' : ''; ?>">
                        <input type="radio" class="hide" name="wpeden_post_meta[sidebar_layout]" value="no-sidebar" <?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "no-sidebar" ? 'checked="checked"' : ''; ?>>

                        <div class="no-sidebar"></div>
                    </label>
                    <label class="<?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "left-sidebar-1" ? 'active' : ''; ?>">
                        <input type="radio" class="hide" name="wpeden_post_meta[sidebar_layout]" value="left-sidebar-1" <?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "left-sidebar-1" ? 'checked="checked"' : ''; ?>>

                        <div class="left-sidebar"></div>
                    </label>
                    <label class="<?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "right-sidebar-1" ? 'active' : ''; ?>">
                        <input type="radio" class="hide" name="wpeden_post_meta[sidebar_layout]" value="right-sidebar-1" <?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "right-sidebar-1" ? 'checked="checked"' : ''; ?>>

                        <div class="right-sidebar"></div>
                    </label>
                    <label class="<?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "sidebar-2" ? 'active' : ''; ?>">
                        <input type="radio" class="hide" name="wpeden_post_meta[sidebar_layout]" value="sidebar-2" <?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "sidebar-2" ? 'checked="checked"' : ''; ?>>

                        <div class="sidebar-2"></div>
                    </label>
                    <label class="<?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "left-sidebar-2" ? 'active' : ''; ?>">
                        <input type="radio" class="hide" name="wpeden_post_meta[sidebar_layout]" value="left-sidebar-2" <?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "left-sidebar-2" ? 'checked="checked"' : ''; ?>>

                        <div class="left-sidebar-2"></div>
                    </label>
                    <label class="<?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "right-sidebar-2" ? 'active' : ''; ?>">
                        <input type="radio" class="hide" name="wpeden_post_meta[sidebar_layout]" value="right-sidebar-2" <?php echo isset($this->MetaData['sidebar_layout']) && $this->MetaData['sidebar_layout'] == "right-sidebar-2" ? 'checked="checked"' : ''; ?>>

                        <div class="right-sidebar-2"></div>
                    </label>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Sidebar Settings</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">

                            <b>Left Sidebar</b><br/>

                            <?php echo WPEdenOptionFields::SidebarDropdown(array('id' => 'cpl', 'name' => 'wpeden_post_meta[left_sidebar]', 'selected' => $left_sidebar)); ?>
                            <select name="wpeden_post_meta[left_sidebar_width]">
                                <option value="">Width:</option>
                                <option value="2" <?php selected(2, $left_sidebar_width) ?>>16.66%</option>
                                <option value="3" <?php selected(3, $left_sidebar_width) ?>>25%</option>
                                <option value="4" <?php selected(4, $left_sidebar_width) ?>>33.33%</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <b>Right Sidebar</b><br/>

                            <?php echo WPEdenOptionFields::SidebarDropdown(array('id' => 'cpl', 'name' => 'wpeden_post_meta[right_sidebar]', 'selected' => $right_sidebar)); ?>
                            <select name="wpeden_post_meta[right_sidebar_width]">
                                <option value="">Width:</option>
                                <option value="2" <?php selected(2, $right_sidebar_width) ?>>16.66%</option>
                                <option value="3" <?php selected(3, $right_sidebar_width) ?>>25%</option>
                                <option value="4" <?php selected(4, $right_sidebar_width) ?>>33.33%</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <?php
    }

    /**
     * @usage Save Post Meta
     * @param $postid
     * @param $post
     */
    function SavePostMeta($postid, $post)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $postid;

        if (!current_user_can('edit_page', $postid))
            return $postid;

        if (isset($_POST['wpeden_post_meta']) && is_array($_POST['wpeden_post_meta'])) {

            $pagemeta = array();
            $pagemeta = $_POST['wpeden_post_meta'];

            $pagemeta['icon'] = sanitize_text_field($pagemeta['icon']);
            $pagemeta['page_css'] = wp_filter_nohtml_kses($pagemeta['page_css']);
            $pagemeta['pagebg']['image'] = esc_url_raw($pagemeta['pagebg']['image']);
            $pagemeta['pagelayout'] = sanitize_text_field($pagemeta['pagelayout']);
            $pagemeta['nav_header'] = sanitize_text_field($pagemeta['nav_header']);
            $pagemeta['page_header_style'] = sanitize_text_field($pagemeta['page_header_style']);

            $pagemeta['left_sidebar_width'] = intval($pagemeta['left_sidebar_width']);
            $pagemeta['right_sidebar_width'] = intval($pagemeta['right_sidebar_width']);

            $pagemeta['left_sidebar'] = sanitize_text_field($pagemeta['left_sidebar']);
            $pagemeta['left_sidebar'] = sanitize_text_field($pagemeta['left_sidebar']);

            update_post_meta($postid, 'wpeden_post_meta', $pagemeta);
        }
    }


}

new MetaBoxes();
