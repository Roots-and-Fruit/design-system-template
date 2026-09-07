/**
 * Group arrangement vs Styles. Arrangement is a class so a background can share the Group.
 */
(function (hooks, element, blockEditor, components, i18n) {
	var el = element.createElement;
	var Fragment = element.Fragment;
	var useEffect = element.useEffect;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var Button = components.Button;
	var __ = i18n.__;

	var LAYOUTS = [
		{ id: "copy", label: "Copy", className: "cds-copy", title: "Tight heading / lede / button stack" },
		{ id: "cluster", label: "Cluster", className: "cds-cluster", title: "Items in a wrapping row" },
		{ id: "switcher", label: "Switcher", className: "cds-switcher", title: "Two columns, stack when narrow" },
		{ id: "sidebar", label: "Sidebar", className: "cds-sidebar", title: "Narrow column, then a wide one" },
		{ id: "center", label: "Reading width", className: "cds-center", title: "Narrow the group to the reading line" },
		{ id: "box", label: "Box", className: "cds-box", title: "Even padding inside" },
	];

	function tokensOf(className) {
		return String(className || "")
			.split(/\s+/)
			.filter(Boolean);
	}

	function isLayoutClass(token) {
		return LAYOUTS.some(function (layout) {
			return (
				token === layout.className || token === "is-style-" + layout.className
			);
		});
	}

	function stripLayout(tokens) {
		return tokens.filter(function (token) {
			return !isLayoutClass(token);
		});
	}

	function currentLayout(tokens) {
		var found = null;
		LAYOUTS.forEach(function (layout) {
			if (
				tokens.indexOf(layout.className) !== -1 ||
				tokens.indexOf("is-style-" + layout.className) !== -1
			) {
				found = layout;
			}
		});
		return found;
	}

	function needsLegacyMigrate(tokens) {
		return tokens.some(function (token) {
			return LAYOUTS.some(function (layout) {
				return token === "is-style-" + layout.className;
			});
		});
	}

	function classNameFrom(tokens) {
		return tokens.join(" ") || undefined;
	}

	function withGroupLayout(BlockEdit) {
		return function CdsGroupLayout(props) {
			if (props.name !== "core/group") {
				return el(BlockEdit, props);
			}

			var tokens = tokensOf(props.attributes.className);
			var active = currentLayout(tokens);
			var migrate = needsLegacyMigrate(tokens);

			useEffect(
				function () {
					if (!props.isSelected || !migrate) {
						return;
					}
					var layout = currentLayout(tokens);
					var next = stripLayout(tokens);
					if (layout) {
						next.push(layout.className);
					}
					var nextClass = classNameFrom(next);
					if (nextClass !== (props.attributes.className || undefined)) {
						props.setAttributes({ className: nextClass });
					}
				},
				[props.isSelected, migrate, props.clientId]
			);

			function setLayout(id) {
				var layout = LAYOUTS.filter(function (item) {
					return item.id === id;
				})[0];
				var next = stripLayout(tokensOf(props.attributes.className));
				if (layout && (!active || active.id !== id)) {
					next.push(layout.className);
				}
				props.setAttributes({ className: classNameFrom(next) });
			}

			return el(
				Fragment,
				null,
				el(BlockEdit, props),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __("Arrangement", "cds"), initialOpen: true },
						el(
							"div",
							{
								style: {
									display: "flex",
									flexWrap: "wrap",
									gap: "8px",
								},
							},
							LAYOUTS.map(function (layout) {
								return el(
									Button,
									{
										key: layout.id,
										size: "small",
										variant: active && active.id === layout.id ? "primary" : "secondary",
										title: layout.title,
										onClick: function () {
											setLayout(layout.id);
										},
									},
									layout.label
								);
							})
						)
					)
				)
			);
		};
	}

	hooks.addFilter("editor.BlockEdit", "cds/group-layout", withGroupLayout);
})(
	window.wp.hooks,
	window.wp.element,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.i18n
);
