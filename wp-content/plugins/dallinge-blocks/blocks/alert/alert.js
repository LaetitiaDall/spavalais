var el = wp.element.createElement,
    Fragment = wp.element.Fragment,
    registerBlockType = wp.blocks.registerBlockType,
    RichText = wp.editor.RichText,
    BlockControls = wp.editor.BlockControls,
    AlignmentToolbar = wp.editor.AlignmentToolbar;

registerBlockType('dallinge/alert', {
    title: 'Alert',

    icon: 'megaphone',

    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
        alignment: {
            type: 'string',
        },
    },

    category: 'dallinge-blocks',

    edit: function (props) {

        var content = props.attributes.content,
            alignment = props.attributes.alignment;

        function onChangeContent(newContent) {
            props.setAttributes({content: newContent});
        }

        function onChangeAlignment(newAlignment) {
            props.setAttributes({alignment: newAlignment});
        }

        return el(
            RichText,
            {
                tagName: 'p',
                className: props.className,
                onChange: onChangeContent,
                value: content,
            }
        );

        /*
        return el(
            Fragment,
            null,
            el(
                BlockControls,
                null,
                el(
                    AlignmentToolbar,
                    {
                        value: alignment,
                        onChange: onChangeAlignment,
                    }
                )
            ),
            el(
                RichText,
                {
                    tagName: 'p',
                    className: props.className,
                    onChange: onChangeContent,
                    style: {textAlign: alignment},
                    value: content,
                }
            )
        );*/

    },

    save: function (props) {
        var content = props.attributes.content;

        return el(RichText.Content, {
            tagName: 'p',
            className: props.className,
            value: content
        });
    },
});

