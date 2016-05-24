<?php
session_start();
session_destroy();
session_start();

require_once 'core/autoload.php';

use Cymbaline\Cymbalog\item\Cymbalog;

$_SESSION['plop'] = "rezr";
echo "coucou le monde"; 

$log = new Cymbalog(Cymbalog::LOG_TYPE_SESSION);
			$log->log(" in ".__FUNCTION__."  : ".json_encode($_SESSION));

?>
<a href="events.php">dezfzef</a>
