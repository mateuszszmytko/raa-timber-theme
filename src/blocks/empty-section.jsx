
const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { InnerBlocks } = wp.editor;

registerBlockType( 'raa/empty-layout', {
	title: __( 'Pusta sekcja' ), // Block title.
	icon: 'admin-customizer', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'custom-blocks', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'raa' ),
	],

	edit: function( props ) {
		return (
			<section class="o-section">
                <div className="o-container">
                    <InnerBlocks templateLock={false} />
                </div>
            </section>
		);
	},

	save: function( props ) {
		return (
			<section class="o-section">
                <div className="o-container">
                    <InnerBlocks.Content />
                </div>
            </section>
		);
	},
} );
