(function(wp, config) {
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var ServerSideRender = wp.serverSideRender && (wp.serverSideRender.default || wp.serverSideRender);
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;
	var TextareaControl = wp.components.TextareaControl;
	var Button = wp.components.Button;
	var SelectControl = wp.components.SelectControl;

	if (!config || !config.specs) {
		return;
	}

	var commonSupports = {
		align: ['wide', 'full'],
		anchor: true,
		background: {
			backgroundImage: true,
			backgroundSize: true
		},
		border: {
			color: true,
			radius: true,
			style: true,
			width: true
		},
		color: {
			background: true,
			gradients: true,
			link: true,
			text: true
		},
		customClassName: true,
		dimensions: {
			minHeight: true
		},
		html: false,
		multiple: true,
		reusable: false,
		spacing: {
			margin: true,
			padding: true
		},
		typography: {
			fontFamily: true,
			fontSize: true,
			fontStyle: true,
			fontWeight: true,
			letterSpacing: true,
			lineHeight: true,
			textDecoration: true,
			textTransform: true
		}
	};

	function labelFromKey(key) {
		return key
			.replace(/([A-Z])/g, ' $1')
			.replace(/^./, function(str) { return str.toUpperCase(); });
	}

	function ensureArray(value) {
		return Array.isArray(value) ? value : [];
	}

	function renderField(fieldKey, value, onChange) {
		if (fieldKey === 'desc' || fieldKey === 'heroSubtitle' || fieldKey === 'featuredDesc') {
			return el(TextareaControl, {
				label: labelFromKey(fieldKey),
				value: value || '',
				onChange: onChange
			});
		}

		return el(TextControl, {
			label: labelFromKey(fieldKey),
			value: value || '',
			onChange: onChange
		});
	}

	function repeaterFieldMap(key) {
		var maps = {
			heroStats: [
				{ key: 'value', label: 'Value' },
				{ key: 'label', label: 'Label' }
			],
			socialProfiles: [
				{ key: 'label', label: 'Label' },
				{ key: 'url', label: 'URL' },
				{ key: 'icon_image', label: 'Icon Image URL' },
				{ key: 'icon', label: 'SVG Markup', type: 'textarea' }
			],
			items: [
				{ key: 'title', label: 'Title' },
				{ key: 'meta', label: 'Meta' },
				{ key: 'desc', label: 'Description', type: 'textarea' },
				{ key: 'iconImage', label: 'Icon Image URL' },
				{ key: 'image', label: 'Image URL' },
				{ key: 'category', label: 'Category' },
				{ key: 'tech', label: 'Tech / Tags' },
				{ key: 'live', label: 'Live URL' },
				{ key: 'github', label: 'GitHub URL' },
				{ key: 'year', label: 'Year' },
				{ key: 'position', label: 'Position' },
				{ key: 'text', label: 'Text', type: 'textarea' },
				{ key: 'name', label: 'Name' },
				{ key: 'role', label: 'Role' },
				{ key: 'initials', label: 'Initials' },
				{ key: 'rating', label: 'Rating' },
				{ key: 'num', label: 'Number' },
				{ key: 'src', label: 'Image URL' },
				{ key: 'loc', label: 'Location' },
				{ key: 'icon_svg', label: 'SVG Markup', type: 'textarea' },
				{ key: 'tags', label: 'Tags' }
			],
			skillGroups: [
				{ key: 'title', label: 'Group Title' },
				{ key: 'tags', label: 'Tags' }
			],
			experienceItems: [
				{ key: 'title', label: 'Title' },
				{ key: 'meta', label: 'Meta' },
				{ key: 'desc', label: 'Description', type: 'textarea' },
				{ key: 'iconImage', label: 'Icon Image URL' }
			],
			educationItems: [
				{ key: 'title', label: 'Title' },
				{ key: 'meta', label: 'Meta' },
				{ key: 'desc', label: 'Description', type: 'textarea' },
				{ key: 'iconImage', label: 'Icon Image URL' }
			],
			contributionItems: [
				{ key: 'title', label: 'Title' },
				{ key: 'icon_image', label: 'Icon Image URL' },
				{ key: 'icon_svg', label: 'SVG Markup', type: 'textarea' }
			],
			events: [
				{ key: 'src', label: 'Image URL' },
				{ key: 'title', label: 'Title' },
				{ key: 'loc', label: 'Location' }
			],
			steps: [
				{ key: 'num', label: 'Number' },
				{ key: 'title', label: 'Title' },
				{ key: 'desc', label: 'Description', type: 'textarea' }
			]
		};

		return maps[key] || maps.items;
	}

	function renderRepeater(attrKey, items, setAttributes) {
		var fields = repeaterFieldMap(attrKey);
		var rows = ensureArray(items);

		function updateItem(index, itemKey, nextValue) {
			var next = rows.slice();
			next[index] = Object.assign({}, next[index], (function() {
				var o = {};
				o[itemKey] = nextValue;
				return o;
			})());
			setAttributes((function() {
				var o = {};
				o[attrKey] = next;
				return o;
			})());
		}

		function addItem() {
			var base = {};
			fields.forEach(function(field) {
				base[field.key] = '';
			});
			setAttributes((function() {
				var o = {};
				o[attrKey] = rows.concat([base]);
				return o;
			})());
		}

		function removeItem(index) {
			setAttributes((function() {
				var o = {};
				o[attrKey] = rows.filter(function(item, itemIndex) {
					return itemIndex !== index;
				});
				return o;
			})());
		}

		return el(
			'div',
			{ className: 'devfolio-editor-repeater' },
			rows.map(function(item, index) {
				return el(
					PanelBody,
					{
						title: labelFromKey(attrKey) + ' ' + (index + 1),
						initialOpen: false,
						key: attrKey + '-' + index
					},
					fields.map(function(field) {
						if (field.key === 'position') {
							return el(SelectControl, {
								key: field.key,
								label: field.label,
								value: item[field.key] || 'top',
								options: [
									{ label: 'Top', value: 'top' },
									{ label: 'Bottom', value: 'bottom' }
								],
								onChange: function(nextValue) {
									updateItem(index, field.key, nextValue);
								}
							});
						}

						if (field.type === 'textarea') {
							return el(TextareaControl, {
								key: field.key,
								label: field.label,
								value: item[field.key] || '',
								onChange: function(nextValue) {
									updateItem(index, field.key, nextValue);
								}
							});
						}

						return el(TextControl, {
							key: field.key,
							label: field.label,
							value: item[field.key] || '',
							onChange: function(nextValue) {
								updateItem(index, field.key, nextValue);
							}
						});
					}),
					el(Button, {
						isDestructive: true,
						onClick: function() {
							removeItem(index);
						}
					}, 'Remove Item')
				);
			}),
			el(Button, { variant: 'secondary', onClick: addItem }, 'Add Item')
		);
	}

	Object.keys(config.specs).forEach(function(slug) {
		var spec = config.specs[slug];
		var name = 'devfolio/' + slug + '-section';

		registerBlockType(name, {
			apiVersion: 2,
			title: spec.title,
			icon: 'layout',
			category: 'devfolio',
			description: spec.description,
			attributes: spec.attributes,
			supports: commonSupports,
			edit: function(props) {
				var attrs = props.attributes;
				var setAttributes = props.setAttributes;
				var blockProps = useBlockProps({ className: 'devfolio-editor-block-preview' });

				return el(
					Fragment,
					{},
					el(
						InspectorControls,
						{},
						el(
							PanelBody,
							{ title: spec.title, initialOpen: true },
							Object.keys(spec.attributes).map(function(attrKey) {
								var attrSpec = spec.attributes[attrKey];

								if (attrSpec.type === 'array') {
									return el('div', { key: attrKey }, renderRepeater(attrKey, attrs[attrKey], setAttributes));
								}

								return el('div', { key: attrKey }, renderField(attrKey, attrs[attrKey], function(nextValue) {
									var update = {};
									update[attrKey] = nextValue;
									setAttributes(update);
								}));
							})
						)
					),
					el(
						'div',
						blockProps,
						ServerSideRender ? el(ServerSideRender, {
							block: name,
							attributes: attrs
						}) : el('p', {}, spec.description)
					)
				);
			},
			save: function() {
				return null;
			}
		});
	});
})(window.wp, window.devfolioBlocks);
