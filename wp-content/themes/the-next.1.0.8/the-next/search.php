<?php

get_header();

$current_post_type = isset($_GET['post_type']) && post_type_exists($_GET['post_type']) ? $_GET['post_type'] : 'post';

get_template_part('search-templates/'.$current_post_type);


get_footer();