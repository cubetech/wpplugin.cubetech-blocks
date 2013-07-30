jQuery(function() {

	jQuery("#cubetech-blocks-filter-select").change(function () {
		if ( jQuery("#cubetech-blocks-filter-select").val() == 'all' ) {
			jQuery(".cubetech-blocks").fadeIn(500);
		} else {
			jQuery(".cubetech-blocks").filter(":not(.cubetech-blocks-group-" + jQuery("#cubetech-blocks-filter-select").val() + ")").hide();
			jQuery(".cubetech-blocks").filter(".cubetech-blocks-group-" + jQuery("#cubetech-blocks-filter-select").val()).fadeIn(500);
		}
	})
	.change();
	
});