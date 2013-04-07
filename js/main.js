/*
Source File: main.js
Name:Robert Foltz
Last Modified By: Robert Foltz
Website Name: Robert Folt's Portfolio
File Description: This is where most of the javascript is placed for my website.
*/

//On Window Load Initialize the FlexSlider Plugin.
$(window).load(function(){
	$('.flexslider').flexslider({
		animation:"slide", //change the animation style to slide
		slideshow:false //make sure it doesn't auto rotate the images I find it annoying.
	});
});