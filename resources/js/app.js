/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'owl.carousel';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(VueSweetalert2);
Vue.config.ignoredElements = ['trix-editor', 'trix-toolbar'];
Vue.component('fecha-curso', require('./components/FechaCurso.vue').default);
Vue.component('eliminar-curso', require('./components/EliminarCurso.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);
console.log(Vue.prototype);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(".option").click(function(){
    $(".option").removeClass("active");
    $(this).addClass("active");
    
 });
 

/*** Carousel con OWL */
jQuery(document).ready(function() {
    jQuery('.owl-carousel').owlCarousel({
        margin: 10,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0 : {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });
    
});

$(function() {
	var windowWidth = $(".window").width();
	var windowHeight = $(".window").height();
	var i = 0;
	var panelAmount = $(".sp-panel").length;
	
	// Give the panels a fitting H/W
	$(".sp-panel").css("width", windowWidth);
	$(".sp-panel").css("height", windowHeight);
	
	// Click on "Right" to move forward
		$(".right").click(function(){
		
			i+=1;
			
			if (i < 0 ){
				i = panelAmount - 1;
			}
			
			if (i >= panelAmount) {
				i = 0;
			}
		
			var pos=(i*windowWidth);
			$(".sp-panel-set").css("left", -pos + "px");
			});
	
		// Click on "Left" to move backward
		$(".left").click(function(){
			
			i-=1;
			
			if (i < 0 ){
				i = panelAmount - 1;
			}
			
			if (i >= panelAmount) {
				i = 0;
			}
			
			var pos=(i*windowWidth);
			$(".sp-panel-set").css("left", -pos + "px");
			});
	
	// Attempted Mobile Swipe Alternative
	
	// Swipe Forward
		$(".sp-panel-set").on("swipeleft", function(event){
		
			i+=1;
			
			if (i < 0 ){
				i = panelAmount - 1;
			}
			
			if (i >= panelAmount) {
				i = 0;
			}
		
			var pos=(i*windowWidth);
			$(".sp-panel-set").css("left", -pos + "px");
			});
	
	// Swipe Backward
			$(".sp-panel-set").on("swiperight", function(event){
			
			i-=1;
			
			if (i < 0 ){
				i = panelAmount - 1;
			}
			
			if (i >= panelAmount) {
				i = 0;
			}
			
			var pos=(i*windowWidth);
			$(".sp-panel-set").css("left", -pos + "px");
			});
	
});
