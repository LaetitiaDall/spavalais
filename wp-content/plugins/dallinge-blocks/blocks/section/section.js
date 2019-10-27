var el = wp.element.createElement,
    Fragment = wp.element.Fragment,
    registerBlockType = wp.blocks.registerBlockType,
    RichText = wp.editor.RichText,
    BlockControls = wp.editor.BlockControls,
    AlignmentToolbar = wp.editor.AlignmentToolbar,
    InspectorControls = wp.editor.InspectorControls,
    InnerBlocks = wp.editor.InnerBlocks,
    TextControl = wp.components.TextControl;

registerBlockType
('dallinge/section', {
    title: 'Section',

    icon: 'category',

    attributes: {
        ink: {
            'type': 'text',
    },
    },


    category: 'dallinge-blocks',

    edit: function (props) {
        var ink = props.attributes.ink;

        return el('section',
            {className: props.className},
            [
                el(InnerBlocks),
                /*el(InspectorControls, {key: 'inspector'}, // Display the block options in the inspector panel.
                    el(TextControl, {
                        type: 'text',
                        label: 'ink',
                        value: ink,
                        onChange: function (newInk) {
                            props.setAttributes({ink: newInk})
                        }
                    }))*/
            ]);
    },

    save: function (props) {
        var ink = props.attributes.ink;

        return el('section', {}, [
            el(InnerBlocks.Content, {}),
        ]);
    },
});

