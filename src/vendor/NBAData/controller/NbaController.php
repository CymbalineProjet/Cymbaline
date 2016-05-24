<?php
namespace NBAData\controller;

use core\component\tools\View;
use NBAData\controller\ApiController;

use NBAData\API\NBA_API;




class NbaController extends ApiController {

	public function gamesAction() {
		
        $date = new \DateTime();
        $this->_api->apiDataGame($date->format('Ymd'), "games");

        return new View(array(
            'test' => 'test',
        ));
        
    }

    public function resultsAction($args) { 

        if(isset($args['date']))
            $date = new \DateTime($args['date']); 
        else {
            $date = new \DateTime();
            $date->modify('-1 day');
        }

        $this->_api->apiDataGame($date->format('Ymd'), "results");

        return new View(array(
            'test' => 'test',
        ));
        
    }

    public function apiAction($args) {
    	
    	$date = new \DateTime($args['date']); 
        $this->_api->apiDataGame($date->format('Ymd'));

        return new View(array(
            'test' => 'test',
        ));
        
    }

    public function teamsAction() {

        $url = "https://erikberg.com/nba/teams.json";
        $function = "printTeams";

        
        $teams = $this->_api->apiGetContentData($url,$function);


        return new View(array(
            'teams' => $teams,
        ));
    }

    public function rosterAction($args) {

        $url = "https://erikberg.com/nba/roster/".$args['id'].".json";
        $function = "printRoster";

        
        $roster = $this->_api->apiGetContentData($url,$function);

        return new View(array(
            'roster' => $roster,
        ));
    }

}