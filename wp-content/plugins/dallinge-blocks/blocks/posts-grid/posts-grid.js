var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    withSelect = wp.data.withSelect,
    ServerSideRender = wp.components.ServerSideRender;

registerBlockType('dallinge/posts-grid', {
    title: 'Latest Post Grid',
    icon: 'dashicons-grid-view\n',
    category: 'dallinge-blocks',

    attributes: {
        max_posts: {
            type: 'number',
            default: '5'
        },
    },

    edit: function (props) {
        // ensure the block attributes matches this plugin's name
        return (
            el(ServerSideRender, {
                block: "dallinge/posts-grid",
                attributes: props.attributes
            })
        );
    },

    save: function () {
        // Rendering in PHP
        return null;
    },
});