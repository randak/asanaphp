<?php

namespace Asana;

class AsanaWorkspace {

    private $api;

    private $id;
    private $name;
    private $is_organization;

    public function __construct(AsanaApiWrapper $api, $data) {
        $this->api = $api;

        foreach($data as $key => $value) {
            if(!empty($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    public function getId() {
        return $this->id;
    }

    public static function getAll() {

    }

    public function update($data) {

    }

    /*
    /**
     * Returns all the workspaces.
     *
     * @return string JSON or null
     *
    public function getWorkspaces() {
        return $this->askAsana($this->workspaceUrl);
    }

    /**
     * Currently the only field that can be modified for a workspace is its name (as Asana API says).
     * This method returns the complete updated workspace record.
     *
     * @param array $data
     * Example: array("name" => "Test");
     *
     * @return string JSON or null
     *
    public function updateWorkspace($workspaceId, $data = array('name' => '')) {
        $data = array('data' => $data);
        $data = json_encode($data);

        return $this->askAsana($this->workspaceUrl . '/' . $workspaceId, $data, ASANA_METHOD_PUT);
    }

    /**
     * Returns tasks of all workspace assigned to someone.
     * Note: As Asana API says, you must specify an assignee when querying for workspace tasks.
     *
     * @param string $workspaceId The id of the workspace
     * @param string $assignee Can be "me" or user ID
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     *
     * @return string JSON or null
     *
    public function getWorkspaceTasks($workspaceId, $assignee = 'me', array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->taskUrl . '?workspace=' . $workspaceId . '&assignee=' . $assignee . '&' . $options);
    }

    /**
     * Returns tags of all workspace.
     *
     * @param string $workspaceId The id of the workspace
     * @return string JSON or null
     *
    public function getWorkspaceTags($workspaceId) {
        return $this->askAsana($this->workspaceUrl . '/' . $workspaceId . '/tags');
    }

    /**
     * Returns users of all workspace.
     *
     * @param string $workspaceId The id of the workspace
     * @return string JSON or null
     *
    public function getWorkspaceUsers($workspaceId) {
        return $this->askAsana($this->workspaceUrl . '/' . $workspaceId . '/users');
    }*/
} 