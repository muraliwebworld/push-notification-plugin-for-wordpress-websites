import { registerBlockType } from '@wordpress/blocks';

import Pnfpb_push from './pnfpb_push_notification';
import Pnfpb_push_sw from './pnfpb_service_worker';

const blocks = [
    image,
    quote,
    code
];

function registerBlock( block ) {
    const { name, setting } = block;
    registerBlockType( name, settings );
}

blocks.forEach( registerBlock );

/*window.addEventListener(
	'load',
	function () {
		render(
			<MyFirstApp />,
			document.querySelector( '#my-first-gutenberg-app' )
		);
	},
	false
);*/
