/**
 * File pics.js.
 */

jQuery(document).ready(function($) {
	
});

// Undefined, null Check, Replace Function
function checkBlank( input ) {
	var defaultValue = 0;
	if (typeof input == "undefined" || input == null || input == '') {
		return defaultValue;
	}
	return input;
}