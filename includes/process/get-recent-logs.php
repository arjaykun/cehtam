<?php

include_once '../loadclasses.php';

$log = new TimeLog;

$recents = $log->get_recent();

echo json_encode($recents);