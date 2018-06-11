<?php

class CipFastGraphApi extends ApiBase {

	public function execute() {

		$formattedData = array();
		$params = $this->extractRequestParams();

		$do = $params['do'];

		switch ($do) {
			case 'first':

				$sqi = new \SQI\SemanticQueryInterface(array('flat_prop_vals'=>true));
				$sqi->category('Climate initiative ')->printout('Starting year n');
				$result = $sqi->toArray();

				$sorted = array();
				foreach ($result as $r) {
					$year = $r["properties"]["Starting year n"];
					if( !empty($year) && $year != "" && (int)$year >= 2000 ) {
						if ( isset( $sorted[ $year ] ) ) {
							$sorted[ $year ] ++;
						} else {
							$sorted[ $year ] = 1;
						}
					}
				}

				ksort($sorted);

				$formatter = array();
				foreach ($sorted as $y => $s) {
					$formatter[] = array(''.$y, $s, 'ICIs: '.$s);
				}

				$formattedData['result'] = $formatter;

				break;
			case 'second':
				break;
		}

		$this->getResult()->addValue(null, $this->getModuleName(), $formattedData);

	}

	public function getAllowedParams() {
		return array(
			'do' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_REQUIRED => true
			)
		);
	}

}
