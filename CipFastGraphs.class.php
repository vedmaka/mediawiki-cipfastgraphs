<?php

/**
 * Class for CipFastGraphs extension
 *
 * @file
 * @ingroup Extensions
 */
class CipFastGraphs
{

	/**
	 * @param        $input
	 * @param        $args
	 * @param Parser $parser
	 * @param        $frame
	 *
	 * @return array
	 */
	public static function cipgraph1( $input, $args, $parser, $frame ) {

		global $wgOut;
		$parser->getOutput()->addModules('ext.cipfastgraphs.foo');

		$html = '<div id="cipgraph1">Loading..</div>';

		return array(
			$html,
			'markerType' => 'nowiki'
		);

	}

}
