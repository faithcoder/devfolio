(function(wp, config) {
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var ServerSideRender = wp.serverSideRender && (wp.serverSideRender.default || wp.serverSideRender);
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var MediaUpload = wp.blockEditor.MediaUpload;
	var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;
	var TextareaControl = wp.components.TextareaControl;
	var Button = wp.components.Button;
	var SelectControl = wp.components.SelectControl;

	if (!config || !config.specs) {
		return;
	}

	if (!config.specs['plugins']) {
		config.specs['plugins'] = {
			title: 'Plugins Section',
			description: 'Plugin showcase with features and GitHub download links.',
			default_home: false,
			keywords: ['plugins', 'download', 'github', 'free'],
			attributes: {
				label: { type: 'string', default: '' },
				titleText: { type: 'string', default: '' },
				desc: { type: 'string', default: '' },
				pluginItems: { type: 'array', default: [] }
			}
		};
	}

	if (!config.specs['tabbed-showcase']) {
		config.specs['tabbed-showcase'] = {
			title: 'Tabbed Showcase Section',
			description: 'Tabbed slider section with media, descriptions, and feature lists.',
			keywords: ['tabs', 'showcase', 'slider', 'templates'],
			attributes: {
				sectionId: { type: 'string', default: '' },
				label: { type: 'string', default: '' },
				titleText: { type: 'string', default: '' },
				desc: { type: 'string', default: '' },
				showcaseItems: { type: 'array', default: [] }
			}
		};
	}

	if (!config.specs['project-details']) {
		config.specs['project-details'] = {
			title: 'Project Details Section',
			description: 'Case-study layout for individual portfolio project pages.',
			keywords: ['project', 'portfolio', 'case study'],
			attributes: {
				label: { type: 'string', default: '' },
				titleText: { type: 'string', default: '' },
				summary: { type: 'string', default: '' },
				image: { type: 'string', default: '' },
				role: { type: 'string', default: '' },
				challenge: { type: 'string', default: '' },
				approach: { type: 'string', default: '' },
				screenshots: { type: 'array', default: [] },
				technologies: { type: 'string', default: '' },
				features: { type: 'string', default: '' },
				result: { type: 'string', default: '' },
				liveUrl: { type: 'string', default: '' },
				portfolioUrl: { type: 'string', default: '' },
				liveButtonText: { type: 'string', default: '' },
				backButtonText: { type: 'string', default: '' }
			}
		};
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

	function isIconImageField(key) {
		return key === 'iconImage' || key === 'icon_image';
	}

	function isMediaUploadField(key) {
		return isIconImageField(key) || key === 'image' || key === 'src' || key === 'video';
	}

	function renderMediaField(field, value, onChange) {
		var mediaUrl = value || '';
		var isVideo = field.key === 'video';
		var noun = isIconImageField(field.key) ? 'Icon' : (isVideo ? 'Video' : 'Image');
		var mediaButton = function(open) {
			return el(Button, {
				variant: mediaUrl ? 'secondary' : 'primary',
				onClick: open
			}, mediaUrl ? 'Replace ' + noun : 'Upload ' + noun);
		};

		if (!MediaUpload) {
			return el(TextControl, {
				label: field.label,
				value: mediaUrl,
				onChange: onChange
			});
		}

		return el(
			'div',
			{ className: 'devfolio-editor-media-control' },
			el('p', { className: 'devfolio-editor-media-label' }, field.label),
			mediaUrl && !isVideo ? el('img', {
				className: 'devfolio-editor-media-preview',
				src: mediaUrl,
				alt: ''
			}) : null,
			mediaUrl && isVideo ? el('video', {
				className: 'devfolio-editor-media-preview devfolio-editor-video-preview',
				src: mediaUrl,
				controls: true
			}) : null,
			MediaUploadCheck ? el(
				MediaUploadCheck,
				{},
				el(MediaUpload, {
					allowedTypes: isVideo ? ['video'] : ['image'],
					value: mediaUrl,
					onSelect: function(media) {
						onChange(media && media.url ? media.url : '');
					},
					render: function(mediaProps) {
						return mediaButton(mediaProps.open);
					}
				})
			) : el(MediaUpload, {
				allowedTypes: isVideo ? ['video'] : ['image'],
				value: mediaUrl,
				onSelect: function(media) {
					onChange(media && media.url ? media.url : '');
				},
				render: function(mediaProps) {
					return mediaButton(mediaProps.open);
				}
			}),
			mediaUrl ? el(Button, {
				isDestructive: true,
				variant: 'tertiary',
				onClick: function() {
					onChange('');
				}
			}, 'Remove ' + noun) : null
		);
	}

	function renderField(fieldKey, value, onChange) {
		if (isMediaUploadField(fieldKey)) {
			return renderMediaField({ key: fieldKey, label: labelFromKey(fieldKey) }, value, onChange);
		}

		if (
			fieldKey === 'desc' ||
			fieldKey === 'heroSubtitle' ||
			fieldKey === 'featuredDesc' ||
			fieldKey === 'summary' ||
			fieldKey === 'challenge' ||
			fieldKey === 'approach' ||
			fieldKey === 'features' ||
			fieldKey === 'result'
		) {
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
					{ key: 'icon_image', label: 'Icon Image' },
					{ key: 'icon', label: 'SVG Markup', type: 'textarea' }
				],
			items: [
					{ key: 'title', label: 'Title' },
					{ key: 'meta', label: 'Meta' },
					{ key: 'desc', label: 'Description', type: 'textarea' },
					{ key: 'iconImage', label: 'Icon Image' },
					{ key: 'image', label: 'Image' },
					{ key: 'category', label: 'Category' },
					{ key: 'tech', label: 'Tech / Tags' },
					{ key: 'caseStudyUrl', label: 'Case Study URL' },
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
					{ key: 'src', label: 'Image' },
					{ key: 'loc', label: 'Location' },
					{ key: 'icon_svg', label: 'SVG Markup', type: 'textarea' },
					{ key: 'tags', label: 'Tags' }
				],
				showcaseItems: [
					{ key: 'title', label: 'Tab Title' },
					{ key: 'subtitle', label: 'Subtitle' },
					{ key: 'desc', label: 'Description', type: 'textarea' },
					{ key: 'features', label: 'Features (comma separated)', type: 'textarea' },
					{ key: 'mediaType', label: 'Media Type', type: 'select', options: [
						{ label: 'Image', value: 'image' },
						{ label: 'Video', value: 'video' }
					] },
					{ key: 'iconImage', label: 'Icon Image' },
					{ key: 'image', label: 'Image' },
					{ key: 'video', label: 'Video' },
					{ key: 'icon_svg', label: 'SVG Markup', type: 'textarea' }
				],
			skillGroups: [
				{ key: 'title', label: 'Group Title' },
				{ key: 'tags', label: 'Tags' }
			],
			experienceItems: [
					{ key: 'title', label: 'Title' },
					{ key: 'meta', label: 'Meta' },
					{ key: 'desc', label: 'Description', type: 'textarea' },
					{ key: 'iconImage', label: 'Icon Image' }
				],
				educationItems: [
					{ key: 'title', label: 'Title' },
					{ key: 'meta', label: 'Meta' },
					{ key: 'desc', label: 'Description', type: 'textarea' },
					{ key: 'iconImage', label: 'Icon Image' }
				],
				contributionItems: [
					{ key: 'title', label: 'Title' },
					{ key: 'icon_image', label: 'Icon Image' },
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
			],
			pluginItems: [
				{ key: 'title', label: 'Plugin Name' },
				{ key: 'desc', label: 'Description', type: 'textarea' },
				{ key: 'features', label: 'Features (comma separated)', type: 'textarea' },
				{ key: 'tags', label: 'Tags (comma separated)' },
				{ key: 'github', label: 'GitHub URL' },
				{ key: 'detailUrl', label: 'Detail Page URL' },
				{ key: 'downloads', label: 'Downloads (e.g. 2.4K or 8400)' },
				{ key: 'iconImage', label: 'Icon Image' },
				{ key: 'icon', label: 'SVG Markup', type: 'textarea' }
			],
			benefitItems: [
				{ key: 'title', label: 'Title' },
				{ key: 'desc', label: 'Description', type: 'textarea' },
				{ key: 'iconImage', label: 'Icon Image' },
				{ key: 'icon', label: 'Icon Text or SVG', type: 'textarea' }
			],
			featureItems: [
				{ key: 'text', label: 'Feature Text' },
				{ key: 'iconImage', label: 'Icon Image' }
			],
			screenshots: [
				{ key: 'src', label: 'Screenshot' },
				{ key: 'title', label: 'Caption' }
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

							if (field.type === 'select') {
								return el(SelectControl, {
									key: field.key,
									label: field.label,
									value: item[field.key] || (field.options && field.options[0] ? field.options[0].value : ''),
									options: field.options || [],
									onChange: function(nextValue) {
										updateItem(index, field.key, nextValue);
									}
								});
							}

							if (isMediaUploadField(field.key)) {
								return el('div', { key: field.key }, renderMediaField(field, item[field.key], function(nextValue) {
									updateItem(index, field.key, nextValue);
								}));
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
		var attributes = Object.assign({
			align: {
				type: 'string',
				default: 'full'
			},
			sectionId: {
				type: 'string',
				default: ''
			}
		}, spec.attributes);

		registerBlockType(name, {
			apiVersion: 2,
			title: spec.title,
			icon: 'layout',
			category: 'devfolio',
			description: spec.description,
			keywords: spec.keywords || [],
			attributes: attributes,
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
							el(TextControl, {
								label: 'CSS ID',
								help: 'Use this in menu custom links, for example #services',
								value: attrs.sectionId || '',
								onChange: function(nextValue) {
									setAttributes({ sectionId: nextValue });
								}
							}),
							Object.keys(spec.attributes).map(function(attrKey) {
								var attrSpec = spec.attributes[attrKey];

								if (attrKey === 'sectionId') {
									return null;
								}

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
