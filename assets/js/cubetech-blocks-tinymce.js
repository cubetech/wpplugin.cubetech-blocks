tinymce.create( 
	'tinymce.plugins.cubetech_blocks', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_blocks_button', 
				{
					cmd   : 'cubetech_blocks_button_cmd',
					title : editor.getLang( 'cubetech_blocks.buttonTitle', 'cubetech Blöcke' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_blocks_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_blocks_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_blocks.popupTitle', 'cubetech Blöcke' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_blocks', tinymce.plugins.cubetech_blocks );