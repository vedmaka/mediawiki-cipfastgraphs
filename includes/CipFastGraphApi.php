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

				$config = array('flat_prop_vals'=>true);
				$sqi = new \SQI\SemanticQueryInterface($config);

				$resultAr = array(
					'unknown' => 0,
					'1 to 10' => 0,
					'11 to 30' => 0,
					'31 to 50' => 0,
					'51 to 200' => 0,
					'> 200' => 0,
				);

				$resultAr['unknown'] =$sqi->category('Climate initiative ')
				    ->condition('Total members', 0)
					->count();

				$sqi->reset($config);

				$resultAr['1 to 10'] =$sqi->category('Climate initiative ')
				                          ->condition('Total members', 0, SMW_CMP_GRTR)
				                          ->condition('Total members', 11, SMW_CMP_LESS)
				                          ->count();

				$sqi->reset($config);

				$resultAr['11 to 30'] =$sqi->category('Climate initiative ')
				                          ->printout('Total members')
				                          ->condition('Total members', '10', SMW_CMP_GRTR)
				                          ->condition('Total members', '30', SMW_CMP_LEQ)
				                          ->count();

				$sqi->reset($config);

				$resultAr['31 to 50'] =$sqi->category('Climate initiative ')
				                          ->printout('Total members')
				                          ->condition('Total members', '30', SMW_CMP_GRTR)
				                          ->condition('Total members', '50', SMW_CMP_LEQ)
				                          ->count();

				$sqi->reset($config);

				$resultAr['51 to 200'] =$sqi->category('Climate initiative ')
				                          ->printout('Total members')
				                          ->condition('Total members', '50', SMW_CMP_GRTR)
				                          ->condition('Total members', '200', SMW_CMP_LEQ)
				                          ->count();

				$sqi->reset($config);

				$resultAr['> 200'] =$sqi->category('Climate initiative ')
				                          ->printout('Total members')
				                          ->condition('Total members', '200', SMW_CMP_GRTR)
				                          ->count();

				foreach ($resultAr as $k => $v) {
					$formattedData['result'][] = array($k, $v, 'ICIs: '.$v);
				}

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
