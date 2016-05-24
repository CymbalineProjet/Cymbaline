<?php

namespace NBAData\API;

class NBA_API {

	const HOST = 'erikberg.com';
	const SPORT = 'nba';
	const LEAGUE = 'nba';
	const METHOD = 'events';
	const FORMAT = 'json';
	const TIME_ZONE = 'Europe/Paris';

	protected $_token;
	protected $_agent;
	protected $_host;
	protected $_sport;
	protected $_league;
	protected $_method;
	protected $_id;
	protected $_format;
	protected $_parameters;
	protected $_date;


	public function __construct($token,$agent) {
		$this->_token = $token;
		$this->_agent = $agent;
		$this->_host = 'erikberg.com';
		$this->_sport = '';
		$this->_sport_param = 'nba';
		$this->_league = '';
		$this->_method = 'events';
		$this->_format = 'json';
		$date = new \DateTime();
		//$date->modify('-1 day');
		$this->_date = $date->format('Ymd');
	}

	public function apiGetContentData($url,$function) {
		$default_opts = array(
	        'http' => array(
	            'user_agent' => $this->_agent,
	            'header'     => array(
	                'Accept-Encoding: gzip',
	                'Authorization: Bearer ' . $this->_token
	            )
	        )
	    );
	    stream_context_get_default($default_opts);
	    $file = 'compress.zlib://' . $url;
	    
	    $fh   = fopen($file, 'rb');



	  
	    if ($fh && strpos($http_response_header[0], "200 OK") !== false) {
	        $content = stream_get_contents($fh);
	        fclose($fh);

	       
	        $datas = $this->$function($content);
	        return $datas;


	    } else {
	    	throw new CustomException('Error retrieve data from url');
	    }
	}

	public function apiDataGame($date = NULL, $type = "games") {

		if(!is_null($date))
			$this->_date = $date;

	    $parameters = array(
	        'sport' => $this->_sport_param,
	        'date'  => $this->_date
	    );

	    // Pass method, format, and parameters to build request url
	    $url = $this->buildURL($this->_host, $this->_sport, $this->_method, $this->_id, $this->_format, $parameters);

	    // Set the User Agent, Authorization header and allow gzip
	    $default_opts = array(
	        'http' => array(
	            'user_agent' => $this->_agent,
	            'header'     => array(
	                'Accept-Encoding: gzip',
	                'Authorization: Bearer ' . $this->_token
	            )
	        )
	    );
	    stream_context_get_default($default_opts);
	    $file = 'compress.zlib://' . $url;
	    
	    $fh   = fopen($file, 'rb');

	  
	    if ($fh && strpos($http_response_header[0], "200 OK") !== false) {
	        $content = stream_get_contents($fh);
	        fclose($fh);

	       
	        if($type == "results") 
	        	$this->printResults($content);
	        else
	        	$this->printSchedule($content);


	    } else {
	        // handle error, check $http_response_header for HTTP status code, etc.
	        if ($fh) {
	            $xmlstats_error = json_decode(stream_get_contents($fh));
	            printf("Server returned %s error along with this message:\n%s\n",
	                $xmlstats_error->error->code,
	                $xmlstats_error->error->description);
	        } else {
	            print "A problem was encountered trying to connect to the server!\n";
	            print_r(error_get_last());
	        }
	    }
	}

	public function printSchedule($content) {
	

	    // Parses the JSON content and returns a reference to
	    // Events (https://erikberg.com/api/methods/events)
	    $events = json_decode($content);

	    // Create DateTime object using the ISO 8601 formatted events_date
	    $date = \DateTime::createFromFormat(\DateTime::W3C, $events->events_date);

	    printf("Events on %s<br/><br/>", $date->format('l, F j, Y'));
	    printf("%-35s %5s %34s<br/>", 'Time', 'Event', 'Status');

	    // Loop through each Event (https://erikberg.com/api/objects/event)
	    foreach ($events->event as $evt) {
	        // Create DateTime object from start_date_time and set the desired time zone
	        $time = \DateTime::createFromFormat(\DateTime::W3C, $evt->start_date_time);
	        $time->setTimeZone(new \DateTimeZone(self::TIME_ZONE));

	        // Get team objects (https://erikberg.com/api/objects/team)
	        $awayTeam = $evt->away_team;
	        $homeTeam = $evt->home_team;

	        printf("%12s %24s vs. %-24s %9s<br/>",
	            $time->format('g:i A T'),
	            $awayTeam->full_name,
	            $homeTeam->full_name,
	            $evt->event_status);
	    }
	}

	public function printResults($content) {
	
	    // Parses the JSON content and returns a reference to
	    // Events (https://erikberg.com/api/methods/events)
	    $events = json_decode($content);

	    // Create DateTime object using the ISO 8601 formatted events_date
	    $date = \DateTime::createFromFormat(\DateTime::W3C, $events->events_date);

	    printf("Events on %s<br/><br/>", $date->format('l, F j, Y'));
	    //printf("%-35s %5s %34s<br/>", 'Time', 'Event', 'Status');
	    echo "<table width='70%'>";

	    // Loop through each Event (https://erikberg.com/api/objects/event)
	    foreach ($events->event as $evt) {
	        // Create DateTime object from start_date_time and set the desired time zone
	        $time = \DateTime::createFromFormat(\DateTime::W3C, $evt->start_date_time);
	        $time->setTimeZone(new \DateTimeZone(self::TIME_ZONE));

	        // Get team objects (https://erikberg.com/api/objects/team)
	        $awayTeam = $evt->away_team;
	        $homeTeam = $evt->home_team;

	        if($evt->event_status == "completed") { 
		        echo "<tr>
		        		<td>".$time->format('g:i A T')."</td>
		        		<td align='left'>".$awayTeam->full_name."</td>
		        		<td align='right'><b>".$evt->away_points_scored."</b></td>
		        		<td align='left'><b>".$evt->home_points_scored."</b></td>
		        		<td align='right'>".$homeTeam->full_name."</td>
		        		<td>".$evt->event_status."</td>
		        	  </tr>";
	        } else {
	        	echo "<tr>
		        		<td>".$time->format('g:i A T')."</td>
		        		<td align='left'>".$awayTeam->full_name."</td>
		        		<td align='right'></td>
		        		<td align='left'></td>
		        		<td align='right'>".$homeTeam->full_name."</td>
		        		<td>".$evt->event_status."</td>
		        	  </tr>";
	        }

	    
	    }

	    echo "</table>";
	}

	public function printTeams($content) {

		
		// Parses the JSON content and returns a reference to
	    // Events (https://erikberg.com/api/methods/events)
	    $teams = json_decode($content);



	    // Create DateTime object using the ISO 8601 formatted events_date
	    //$date = \DateTime::createFromFormat(\DateTime::W3C, $events->events_date);

	    //printf("Events on %s<br/><br/>", $date->format('l, F j, Y'));
	    //printf("%-35s %5s %34s<br/>", 'Time', 'Event', 'Status');
	    $return = "<table width='70%'>";

	    // Loop through each Event (https://erikberg.com/api/objects/event)
	    foreach ($teams as $team) {

	        $return .= "<tr>
	        		<td><a href='roster/".$team->team_id."'>".$team->full_name."</a></td>
	        		<td>".$team->conference."</td>
	        		<td>".$team->division."</td>
	        	  </tr>";
	    
	    }

	    $return .= "</table>";

	    return $return;
	}

	public function printRoster($content) {

	    $roster = json_decode($content);
	    $team = $roster->team;
	    $players = $roster->players;

	    


	    $return = "<table width='70%'>";
	    $return .= "<tr><th colspan='4'>Roster ".$team->full_name."</th></tr>";

	    foreach ($players as $player) {

	        $return .= "<tr>
	        		<td>#".$player->uniform_number."</td>
	        		<td>".$player->position."</td>
	        		<td>".$player->display_name."</td>
	        		<td>".$player->roster_status."</td>
	        	  </tr>";
	    
	    }

	    $return .= "</table>";

	    return $return;
	}


	public function buildURL($host, $sport, $method, $id, $format, $parameters) {
		$ary  = array($sport, $method, $id);
	    $path = join('/', preg_grep('/^$/', $ary, PREG_GREP_INVERT));
	    $url  = 'https://' . $host . '/' . $path . '.' . $format;

	    // Check for parameters and create parameter string
	    if (!empty($parameters)) {
	        $paramlist = array();
	        foreach ($parameters as $key => $value) {
	            array_push($paramlist, rawurlencode($key) . '=' . rawurlencode($value));
	        }
	        $paramstring = join('&', $paramlist);
	        if (!empty($paramlist)) { $url .= '?' . $paramstring; }
	    }
	    return $url;
	}
}