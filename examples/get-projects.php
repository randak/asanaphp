<?php
use Asana\AsanaApiWrapper;
use Asana\AsanaProject;

$asana = new AsanaApiWrapper(array('apiKey' => "xxxxxx"));

$projects = AsanaProject::getAll();