// JS
require('./js/boilerplate');
import 'bootstrap';
import AOS from 'aos';
import Parallax from 'parallax-js';
//import './js/parallax-scene';
// CSS && SCSS
require('./scss/boilerplate.scss');

// Call AOS initialize function from here, because of scope.
jQuery( document ).ready(function() {
	
	AOS.init();
	
	//initialize parallax scene
	var scene = document.getElementById('scene');
	var parallaxInstance = new Parallax(scene);


});
