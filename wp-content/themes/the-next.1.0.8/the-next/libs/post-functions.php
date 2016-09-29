<?php
/**
 *  Generate Thumbnail
 */
function wpeden_thumb($post, $size = '', $extra = array(), $echo = true){
    $size = $size ? $size : 'large';
    $class = isset($extra['class']) ? $extra['class'] : '';
    unset($extra['class']);
    if(is_array($size))
    {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        $large_image_url = $large_image_url[0];
        $attrs = '';
        if($large_image_url!=''){
            $path = str_replace(site_url('/'), ABSPATH, $large_image_url);
            $thumb = wpeden_dynamic_thumb($path, $size);
            $thumb = str_replace(ABSPATH, site_url('/'), $thumb);
            $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
            foreach($extra as $attr => $val){
                $attrs .= "$attr = '$val'";
            }
            $img = "<img src='".esc_url($thumb)."' alt='{$alt}' class='{$class}' $attrs />";
            if($echo) { echo $img; return; }
            else
                return $img;
        }
    }
    if($echo && has_post_thumbnail($post->ID ))
        echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo && has_post_thumbnail($post->ID ))
        return get_the_post_thumbnail($post->ID, $size, $extra );
    else if($echo)
        echo "";
    else
        return "";
}

/**
 * @return mixed
 */
function wpeden_post_fet_image_url(){
    global $post;
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    return $large_image_url[0];
}

/**
 * @usage Generates post thumbnail
 * @param string $size
 * @param bool $echo
 * @param null $extra
 * @return mixed|string|void
 */
function wpeden_post_thumb($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';
    $class = isset($extra['class'])?$extra['class']:'';
    $class .= " ".get_post_type()."-thumbnail";
    $class = trim($class);
    $alt = $post->post_title;
    if(is_array($size))
    {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        $large_image_url = $large_image_url[0];
        if($large_image_url!=''){
            $path = str_replace(site_url('/'), ABSPATH, $large_image_url);
            $thumb = wpeden_dynamic_thumb($path, $size);
            $thumb = str_replace(ABSPATH, site_url('/'), $thumb);
            $aalt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
            $alt = $aalt?$aalt:$alt;
            $img = "<img src='".esc_url($thumb)."' alt='{$alt}' class='{$class}' />";
            if($echo) { echo $img; return; }
            else
                return $img;
        }
    }
    if($echo&&has_post_thumbnail($post->ID ))
        echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo&&has_post_thumbnail($post->ID ))
        return get_the_post_thumbnail($post->ID, $size, $extra );
    else if($echo)
        echo "";
    else
        return "";
}


/**
 * Post thumbnail url
 */
function wpeden_post_thumb_url($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';
    if(is_array($size))
    {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        $large_image_url = $large_image_url[0];
        if($large_image_url!=''){
            $path = str_replace(site_url('/'), ABSPATH, $large_image_url);
            $thumb = wpeden_dynamic_thumb($path, $size);
            $thumb = str_replace(ABSPATH, site_url('/'), $thumb);
            return $thumb;
        }
    }
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    $large_image_url = $large_image_url[0];
    return esc_url($large_image_url);
}

//genrate thumbnail url
function wpeden_thumb_url($image, $size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';
    if(is_array($size))
    {
        $large_image_url = $image;
        if($large_image_url!=''){
            $path = str_replace(site_url('/'), ABSPATH, $large_image_url);
            $thumb = wpeden_dynamic_thumb($path, $size);
            $thumb = str_replace(ABSPATH, site_url('/'), $thumb);
            return esc_url($thumb);
        }
    }

    return esc_url($image);
}

function wpeden_post_gallery(){
    
}

//generate cutom excerpt
function wpeden_post_excerpt($length, $echo = true, $c = '...'){
    global $post;
    $uexcerpt = $post->post_excerpt?$post->post_excerpt:preg_replace("/\[([^\]]*)\]/","",$post->post_content);
    $uexcerpt = strip_tags($uexcerpt);
    $uexcerpt = esc_html($uexcerpt);
    $excerpt = substr($uexcerpt,0,$length);
    $eexcerpt = substr($uexcerpt,$length);
    $eexcerpt = explode(" ",$eexcerpt);
    $excerpt .= array_shift($eexcerpt);
    $excerpt =  $excerpt?$excerpt.$c:$excerpt;
    if(!$echo) return $excerpt;
    echo $excerpt;
}

//generate cutom excerpt
function wpeden_get_excerpt($postid, $length, $echo = true, $c = '...'){
    $post = get_post($postid);
    $uexcerpt = $post->post_excerpt?$post->post_excerpt:preg_replace("/\[([^\]]*)\]/","",$post->post_content);
    $uexcerpt = strip_tags($uexcerpt);
    $uexcerpt = esc_html($uexcerpt);
    $excerpt = substr($uexcerpt,0,$length);
    $eexcerpt = substr($uexcerpt,$length);
    $eexcerpt = explode(" ",$eexcerpt);
    $excerpt .= array_shift($eexcerpt);
    $excerpt =  $excerpt?$excerpt.$c:$excerpt;
    if(!$echo) return $excerpt;
    echo $excerpt;
}


function wpeden_dynamic_thumb($path, $size){

    $upload_dir = wp_upload_dir();
    $abspath = str_replace("\\","/", ABSPATH);
    $cachedir = str_replace("\\","/", $upload_dir['basedir'].'/thenext-thumb-cache/');

    $path = str_replace("\\","/", $path);
    $path = str_replace(site_url('/'), $abspath, $path);

    if (!file_exists($path)) return;
    $name_p = explode(".", $path);
    $ext = "." . end($name_p);
    $filename = basename($path);
    $thumbpath = $cachedir .'/'. str_replace($ext, "-".md5($path)."-". implode("x", $size) . $ext, $filename);
    if (file_exists($thumbpath)) {
        $thumbpath = str_replace($abspath, site_url('/'), $thumbpath);
        return $thumbpath;
    }

    if(!file_exists($cachedir)) @mkdir($cachedir, 0777);

    $image = wp_get_image_editor($path);
    if (!is_wp_error($image)) {
        $image->resize($size[0], $size[1], true);
        $image->save($thumbpath);
    }
    $thumbpath = str_replace("\\","/", $thumbpath);
    $thumbpath = str_replace($abspath, site_url('/'), $thumbpath);
    return $thumbpath;
}
