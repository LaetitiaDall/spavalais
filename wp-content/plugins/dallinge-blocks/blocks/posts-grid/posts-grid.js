var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    withSelect = wp.data.withSelect,
    ServerSideRender = wp.components.ServerSideRender,
    InspectorControls = wp.editor.InspectorControls;

registerBlockType('dallinge/posts-grid', {
    title: 'Latest Post Grid',
    icon: 'grid-view',
    category: 'dallinge-blocks',

    attributes: {
        maxPosts: {
            'type': 'number',
            'default': 5,
        },
        maxColumns: {
            'type': 'number',
            'default': 2,
        },
    },

    edit: function (props) {
        //props.setAttributes({max_posts: '5'});
        // ensure the block attributes matches this plugin's name


        return (
            el(
                Fragment,
                null,
                el(
                    InspectorControls,
                    {},
                ),
                el(ServerSideRender, {
                    block: "dallinge/posts-grid",
                    attributes: props.attributes
                })
            )
        );
    },


    save: function () {
        // Rendering in PHP
        return null;
    },
});