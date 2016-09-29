<?php

// This adds quick access to Flatsome docs and Support.

function flatsome_support_helper(){
	?>
		<script>!function(e,o,n){window.HSCW=o,window.HS=n,n.beacon=n.beacon||{};var t=n.beacon;t.userConfig={},t.readyQueue=[],t.config=function(e){this.userConfig=e},t.ready=function(e){this.readyQueue.push(e)},o.config={docs:{enabled:!0,baseUrl:"//uxthemes.helpscoutdocs.com/"},contact:{enabled:!0,formId:"ed63939e-62f5-11e5-8846-0e599dc12a51"}};var r=e.getElementsByTagName("script")[0],c=e.createElement("script");c.type="text/javascript",c.async=!0,c.src="https://djtflbt20bdde.cloudfront.net/",r.parentNode.insertBefore(c,r)}(document,window.HSCW||{},window.HS||{});
		</script>

		<script>
		  HS.beacon.config({
		    modal: true,
		    icon: 'search',
		    color: '#627f9a',
		    attachment: true,
		    zIndex: '99999',
		    instructions:'This will send an email to support@uxthemes.com. We\'ll usually respond within 24-48 hours. You will get an automatic response with a Ticket ID and further instructions sent to your e-mail.',
		    topics: [
		      { val: 'need-help', label: 'Need help' },
		      { val: 'customization', label: 'Need customization' },
		      { val: 'bug', label: 'Report a bug'}
		    ],
		  });

		  HS.beacon.ready(function() {

		  	HS.beacon.suggest([
		  		'57036ff9903360288a77fc9a',
				'536b40b1e4b03c651228213c',
				'536b428ae4b0d833740d4c5d',
				'536b45eae4b03c651228214e',
				'536b46dae4b0d833740d4c62',
				'57037212903360288a77fca2'
			]);

			jQuery('#wp-admin-bar-flatsome-beacon > a, #wp-admin-bar-flatsome-docs-search > a').click(function(e) {
		 	  HS.beacon.toggle();
		 	  e.preventDefault();
		 	});
		 	
		  });
		</script>
		<style>
	  	 #wpadminbar #wp-admin-bar-flatsome-beacon > .ab-item:before { content: "\f223"; top: 2px;}
		 #wpadminbar #wp-admin-bar-theme_options>.ab-item:before { content: "\f111"; top: 2px;}
		</style>
	<?php
}

add_action('wp_footer', 'flatsome_support_helper', 100);


function flatsome_admin_bar_beacon() {
 	global $wp_admin_bar, $flatsome_opt;
	// top menu
	$wp_admin_bar->add_menu( array(
	 'parent' => 'theme_options',
	 'id' => 'flatsome-beacon',
	 'title' => '-- Documentation --',
	 'href' => '#',
	));

	$wp_admin_bar->add_menu( array(
	 'parent' => 'flatsome-beacon',
	 'id' => 'flatsome-docs-search',
	 'title' => 'Search Documentations',
	 'href' => '#',
	));

	$wp_admin_bar->add_menu( array(
	 'parent' => 'flatsome-beacon',
	 'id' => 'flatsome-docs',
	 'title' => 'Open Documentations',
	 'href' => 'http://uxthemes.helpscoutdocs.com',
	));
}
add_action( 'wp_before_admin_bar_render', 'flatsome_admin_bar_beacon' , 1);
add_action('admin_footer', 'flatsome_support_helper', 100);