<?php

namespace Asana;

class AsanaTask {

    private $api;

    private $id;
    private $assignee;
    private $assignee_status;
    private $created_at;
    private $completed;
    private $completed_at;
    private $due_on;
    private $followers;
    private $modified_at;
    private $name;
    private $notes;
    private $projects;
    private $parent;
    private $workspace;

    public function __construct(AsanaApiWrapper $api, $data) {
        $this->api = $api;

        foreach($data as $key => $value) {
            if(!empty($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /*public function __get($key) {
        if(isset($this->$key)) {
            return $this->$key;
        }
    }

    public function __set($key, $value) {
        $this->$key = $value;
    }*/

    public function getId() {
        return $this->id;
    }

    public function create() {

    }

    public static function get($id) {

    }

    public function update($data) {

    }

    public function delete() {

    }


    public function getAll() {

    }

    public static function getAllByAssignee(AsanaUser $assignee) {
        return self::getAllByAssigneeId($assignee->getId());
    }

    public static function getAllByAssigneeId($id) {

    }

    public static function getAllByProject(AsanaProject $project) {
        return self::getAllByProjectId($project->getId());
    }

    public static function getAllByProjectId($id) {

    }

    public static function getAllByWorkspace(AsanaWorkspace $workspace) {
        return self::getAllByWorkspaceId($workspace->getId());
    }

    public static function getAllByWorkspaceId($id) {

    }

    public static function getAllByCompletedTime($time) {

    }

    public static function getAllByModifiedTime($time) {

    }

    public static function getAllByTag(AsanaTag $tag) {
        return self::getAllByTagId($tag->getId());
    }

    public static function getAllByTagId($id) {

    }


    public function getSubtasks() {

    }

    public function addParent(AsanaTask $parent) {

    }

    public function removeParent() {

    }


    public function getStories() {

    }

    public function addComment($text) {

    }


    public function getProjects() {

    }

    public function addProject(AsanaProject $project) {

    }

    public function removeProject(AsanaProject $project) {

    }


    public function getTags() {

    }

    public function addTag(AsanaTag $tag) {

    }

    public function removeTag(AsanaTag $tag) {

    }


    public function addFollower(AsanaUser $user) {

    }

    public function removeFollower(AsanaUser $user) {

    }


    public function getAttachments() {

    }

    public function addAttachment(AsanaAttachment $attachment) {

    }


/*
    /**
     * Creates a task.
     * For assign or remove the task to a project, use the addProjectToTask and removeProjectToTask.
     *
     * @param array $data Array of data for the task following the Asana API documentation.
     * Example:
     *
     * array(
     *     "workspace" => "1768",
     *     "name" => "Hello World!",
     *     "notes" => "This is a task for testing the Asana API :)",
     *     "assignee" => "176822166183",
     *     "followers" => array(
     *         "37136",
     *         "59083"
     *     )
     * )
     *
     * @return string JSON or null
     *
    public function createTask($data) {
        $data = array('data' => $data);
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl, $data, ASANA_METHOD_POST);
    }

    /**
     * Returns task information
     *
     * @param string $taskId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getTask($taskId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '?' . $options);
    }

    /**
     * Returns sub-task information
     *
     * @param string $taskId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getSubTasks($taskId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/subtasks?' . $options);
    }

    /**
     * Updates a task
     *
     * @param string $taskId
     * @param array $data See, createTask function comments for proper parameter info.
     * @return string JSON or null
     *
    public function updateTask($taskId, $data) {
        $data = array('data' => $data);
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskId, $data, ASANA_METHOD_PUT);
    }

    /**
     * Deletes a task.
     *
     * @param string $taskId
     * @return string Empty if success
     *
    public function deleteTask($taskId) {
        return $this->askAsana($this->taskUrl . '/' . $taskId, null, ASANA_METHOD_DELETE);
    }

    /**
     * Moves a task within a project relative to another task.  This should let you take a task and move it below or
     * above another task as long as they are within the same project.
     *
     * @param string $projectId the project $taskReference is in and optionally $taskToMove is already in ($taskToMove will be
     *  added to the project if it's not already there)
     * @param string $taskToMove the task that will be moved (and possibly added to $projectId
     * @param string $taskReference the task that indicates a position for $taskToMove
     * @param bool $insertAfter true to insert after $taskReference, false to insert before
     * @return string JSON or null
     *
    public function moveTaskWithinProject($projectId, $taskToMove, $taskReference, $insertAfter = true) {
        $data = array('data' => array('project' => $projectId));
        if ($insertAfter) {
            $data['data']['insert_after'] = $taskReference;
        } else {
            $data['data']['insert_before'] = $taskReference;
        }
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskToMove . '/addProject', $data, ASANA_METHOD_POST);
    }

    /**
     * Returns the projects associated to the task.
     *
     * @param string $taskId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getProjectsForTask($taskId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/projects?' . $options);
    }

    /**
     * Adds a project to task. If successful, will return success and an empty data block.
     *
     * @param string $taskId
     * @param string $projectId
     * @return string JSON or null
     *
    public function addProjectToTask($taskId, $projectId) {
        $data = array('data' => array('project' => $projectId));
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/addProject', $data, ASANA_METHOD_POST);
    }

    /**
     * Removes project from task. If successful, will return success and an empty data block.
     *
     * @param string $taskId
     * @param string $projectId
     * @return string JSON or null
     *
    public function removeProjectToTask($taskId, $projectId) {
        $data = array('data' => array('project' => $projectId));
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/removeProject', $data, ASANA_METHOD_POST);
    }

    /**
     * Returns task by a given filter.
     * For now (limited by Asana API), you may limit your query either to a specific project or to an assignee and workspace
     *
     * NOTE: As Asana API says, if you filter by assignee, you MUST specify a workspaceId and viceversa.
     *
     * @param array $filter The filter with optional values.
     *
     * array(
     *     "assignee" => "",
     *     "project" => 0,
     *     "workspace" => 0
     * )
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     *
     * @return string JSON or null
     *
    public function getTasksByFilter($filter = array('assignee' => '', 'project' => '', 'workspace' => ''), array $opts = array()) {
        $url = '';
        $filter = array_merge(array('assignee' => '', 'project' => '', 'workspace' => ''), $filter);

        $url .= $filter['assignee'] !== '' ? '&assignee=' . $filter['assignee'] : '';
        $url .= $filter['project'] !== '' ? '&project=' . $filter['project'] : '';
        $url .= $filter['workspace'] !== '' ? '&workspace=' . $filter['workspace'] : '';

        if (count($opts) > 0) {
            $url .= '&' . http_build_query($opts);
        }
        if (strlen($url) > 0) {
            $url = '?' . substr($url, 1);
        }

        return $this->askAsana($this->taskUrl . $url);
    }

    /**
     * Returns the list of stories associated with the object.
     * As usual with queries, stories are returned in compact form.
     * However, the compact form for stories contains more information by default than just the ID.
     * There is presently no way to get a filtered set of stories.
     *
     * @param string $taskId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getTaskStories($taskId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/stories?' . $options);
    }

    /**
     * Adds a comment to a task.
     * The comment will be authored by the authorized user, and timestamped when the server receives the request.
     *
     * @param string $taskId
     * @param string $text
     * @return string JSON or null
     *
    public function commentOnTask($taskId, $text = '') {
        $data = array(
            'data' => array(
                'text' => $text
            )
        );
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/stories', $data, ASANA_METHOD_POST);
    }

    /**
     * Adds a tag to a task. If successful, will return success and an empty data block.
     *
     * @param string $taskId
     * @param string $tagId
     * @return string JSON or null
     *
    public function addTagToTask($taskId, $tagId) {
        $data = array('data' => array('tag' => $tagId));
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/addTag', $data, ASANA_METHOD_POST);
    }

    /**
     * Removes a tag from a task. If successful, will return success and an empty data block.
     *
     * @param string $taskId
     * @param string $tagId
     * @return string JSON or null
     *
    public function removeTagFromTask($taskId, $tagId) {
        $data = array('data' => array('tag' => $tagId));
        $data = json_encode($data);

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/removeTag', $data, ASANA_METHOD_POST);
    }

    /**
     * Add attachment to a task
     *
     * @param string $taskId
     * @param array $data (src of file, mymetype, finalFilename) See, Uploading an attachment to a task function comments for proper parameter info.
     * @return string JSON or null
     *
    public function addAttachmentToTask($taskId, array $data = array()) {
        $mymeType = array_key_exists('mymeType', $data) ? $data['mimeType'] : null;
        $finalFilename = array_key_exists('finalFilename', $data) ? $data["finalFilename"] : null;

        if (class_exists('CURLFile', false)) {
            $data['file'] = new CURLFile($data['file'], $data['mymeType'], $data['finalFilename']);
        } else {
            $data['file'] = "@{$data['file']}";

            if (!is_null($finalFilename)) {
                $data['file'] .= ';filename=' . $finalFilename;
            }
            if (!is_null($mymeType)) {
                $data['file'] .= ';type=' . $mymeType;
            }
        }

        return $this->askAsana($this->taskUrl . '/' . $taskId . '/attachments', $data, ASANA_METHOD_POST);
    }*/
} 