// JS
require('./js/boilerplate');

import 'bootstrap';
import AOS from 'aos';
import Parallax from 'parallax-js';

// CSS && SCSS
require('./scss/boilerplate.scss');

// call AOS initialize function from here, because of scope.
jQuery( document ).ready(function() {

	AOS.init();

	// check if scene exists and initialize
	if (document.getElementById('scene')) {
		var scene = document.getElementById('scene');
		var parallaxInstance = new Parallax(scene);
	}
});
