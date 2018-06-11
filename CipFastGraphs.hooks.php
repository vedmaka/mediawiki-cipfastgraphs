<?php

/**
 * Hooks for CipFastGraphs extension
 *
 * @file
 * @ingroup Extensions
 */
class CipFastGraphsHooks
{

	public static function onExtensionLoad()
	{
		
	}

	/**
	 * @param Parser $parser
	 *
	 * @throws MWException
	 */
	public static function onParserFirstCallInit( $parser )
	{
		$parser->setHook('cipgraph1', 'CipFastGraphs::cipgraph1');
		$parser->setHook('cipgraph2', 'CipFastGraphs::cipgraph2');
	}

	public static function onBeforePageDisplay( $out, $skin ) {
		$out->addHeadItem('google_graph', '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>');
	}

}
