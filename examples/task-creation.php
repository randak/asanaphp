<?php

use Asana\AsanaApiWrapper;
use Asana\AsanaTask;

$asana = new AsanaApiWrapper(array('apiKey' => "xxxxxx"));

$task = new AsanaTask($asana, array(
    "name" => "Hello world!",
    "assignee" => "someone@evidence.com"
));