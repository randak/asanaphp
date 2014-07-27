<?php
use Asana\AsanaApiWrapper;
use Asana\AsanaTask;

$asana = new AsanaApiWrapper(array('apiKey' => "xxxxxx"));

$tasks = AsanaTask::getAllByProjectId('xxxxxxx');