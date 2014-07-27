<?php

use Asana\AsanaApiWrapper;
use Asana\AsanaWorkspace;
use Asana\AsanaProject;
use Asana\AsanaTask;

$asana = new AsanaApiWrapper(array('apiKey' => "xxxxxx"));

$workspaces = AsanaWorkspace::getAll();

foreach($workspaces as $workspace) {

    //print out workspace stuff

    $projects = AsanaProject::getAllByWorkspace($workspace);

    //print out project stuff

    foreach($projects as $project) {
        $tasks = AsanaTask::getAllByProject($project);

        //print out task stuff
    }
}