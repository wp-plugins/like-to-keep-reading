(function($) {
	tinymce.create('tinymce.plugins.wpvltr_liketoread', {
		init : function(ed, url) {
			this.editor = ed;
			// register commands
			ed.addCommand('mceWpvltrLikeToReadCmd', function() {
			
				selectedtext = ed.selection.getContent();
				ed.execCommand('mceReplaceContent', false, '[like_to_read]' + selectedtext + '[/like_to_read]');
				
			});

			// register buttons
			ed.addButton('wpvltr_liketoread', {
				title : 'Like To Keep Reading',
				image : url + '/images/mcebutton.png',
				cmd : 'mceWpvltrLikeToReadCmd'
			});

		},

		getInfo : function() {
			return {
				longname : 'Like To Keep Reading',
				infourl : '',
				version : tinymce.majorVersion + '.' + tinymce.minorVersion
			};
		}
	});

	// register plugin
	tinymce.PluginManager.add('wpvltr_liketoread', tinymce.plugins.wpvltr_liketoread);
})(jQuery);