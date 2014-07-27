<?php

use Asana\AsanaApiWrapper;
use Asana\AsanaProject;
use Asana\AsanaTask;

$asana = new AsanaApiWrapper(array('apiKey' => "xxxxxx"));

$project = AsanaProject::get("someidnumber");

$task = new AsanaTask($asana, array(
    "name" => "Hello world!",
    "assignee" => "someone@evidence.com",
    "followers" => array("xxxx", "xxxx")
));

$task->create();

$task->addProject($project);