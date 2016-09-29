<?php
/**
 * The template displaying search forms in prestro
 *
 * @package prestro
 */
?>
<form method="get" class="form-search" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="form-group">
        <div class="input-group">
            <span class="screen-reader-text"><?php esc_attr('Search for:', 'prestro'); ?></span>
            <input type="text" class="form-control search-query" placeholder="<?php esc_attr('Search...', 'prestro'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="<?php esc_attr('Search', 'prestro'); ?>"><span class="glyphicon glyphicon-search"></span></button>
            </span>
        </div>
    </div>
</form>