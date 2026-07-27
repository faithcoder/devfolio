(function(wp, config) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var ServerSideRender = wp.serverSideRender;

	if (!config || !config.blocks) {
		return;
	}

	Object.keys(config.blocks).forEach(function(slug) {
		var name = 'devfolio/' + slug + '-section';
		var title = config.blocks[slug];

		registerBlockType(name, {
			apiVersion: 2,
			title: title,
			icon: 'layout',
			category: 'devfolio',
			description: __('Homepage section block for Devfolio.', 'devfolio'),
			edit: function() {
				return el(
					'div',
					{ className: 'devfolio-editor-block-preview' },
					el(ServerSideRender, {
						block: name
					})
				);
			},
			save: function() {
				return null;
			}
		});
	});
})(window.wp, window.devfolioBlocks);
