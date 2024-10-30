<?php
/*
Plugin Name: Check CapsLock
Plugin URI: http://zagalski/portfolio/check-capslock/
Description: Checks if capslock is on
Version: 1.0
Author: Michał Zagalski
Author URI: http://zagalski.pl/omnie
License: FREE
*/

class checkcl {
	
	function __construct() {
	
		//add_action
		add_action('login_head', array(&$this, 'login_head') );
		add_action('login_message', array(&$this, 'login_message') );

	}

	function login_head() {
	
		wp_print_scripts('jquery' );
?>


	<script>
	jQuery.noConflict();
	
	jQuery(document).ready(function($) {

		jQuery('#user_pass').keypress(function(e) {
				e = e || window.event;


				if(this.value === '') {
					jQuery('#capslock').hide('slow');
					return;
				}


				var character = String.fromCharCode(e.keyCode | e.which);
				if(character.toUpperCase() === character.toLowerCase()) {
					return;
				}


				if((e.shiftKey && character.toLowerCase() === character) ||
					(!e.shiftKey && character.toUpperCase() === character)) {
					jQuery('#capslock').show('slow');
				} else {
					jQuery('#capslock').hide('slow');
				}
			});
	});

	</script>
	
<?php

	}
	
	function login_message() {
?>
<p class="message" id="capslock" style="display:none;">	<strong>WARNING</strong>: CapsLock is on. </p>
<?php
	}
	
}

$checkcl = new checkcl();
?>