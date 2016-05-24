<?php

namespace source\Prono\PronoBox\service;

use core\component\Service;

use source\Prono\PronoBox\item\Match;
use source\Prono\PronoBox\item\Equipe;
use source\Prono\PronoBox\item\Poule;

class MatchService extends Service {

	private $datas;

	public function rewrite(Match $matchs) {
	
		$this->datas = $matchs->getDatas();
		
		foreach($matchs->getDatas() as $match) {
		

			// $poule = new Poule();
			// $poule->load($match->poule);
			
			// $dom = new Equipe();
			// $dom->load($match->dom);
			
			// $ext = new Equipe();
			// $ext->load($match->ext);
			
			$match->poule = $poule;
			$match->dom = $dom;
			$match->ext = $ext;
		}
		
		//cb_debug($matchs);
		
		return $matchs;
	}
}