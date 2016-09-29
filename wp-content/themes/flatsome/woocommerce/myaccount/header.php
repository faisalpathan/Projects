<?php global $flatsome_opt ; ?>

<?php if(in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $flatsome_opt['facebook_login'] && get_option('woocommerce_enable_myaccount_registration')=='yes' && !is_user_logged_in())  { ?> 
<div id="facebook-login" class="ux_banner dark" style="height:180px">
	    <div class="banner-bg" style="background-image:url('<?php echo $flatsome_opt['facebook_login_bg']; ?>');background-color:#ddd"></div>
        <div class="row">
          	<div class="inner center  text-center " style="width: 60%;">
          		<div class="inner-wrap animated fadeInDown">
		              	<a href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo the_permalink(); ?>" class="button large facebook-button " onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect='+window.location.href; return false;"><i class="icon-facebook"></i><?php _e('Login / Register with <strong>Facebook</strong>','flatsome'); ?></a>
      					<p><?php echo $flatsome_opt['facebook_login_text']; ?></p>
		          </div>
         	</div>  
         </div>
</div>
<?php } ?>