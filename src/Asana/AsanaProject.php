<?php

namespace Asana;

class AsanaProject {

    private $api;

    private $id;
    private $archived;
    private $created_at;
    private $followers;
    private $modified_at;
    private $name;
    private $color;
    private $notes;
    private $workspace;
    private $team;

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

    public function create($name, $note, AsanaWorkspace $workspace = null) {

    }

    public static function get($id) {

        //return new self(array());
    }

    public function update($data) {

    }

    public function delete() {

    }


    public static function getAll($archived = false) {

    }

    public static function getAllByWorkspace(AsanaWorkspace $workspace, $archived = false) {

    }

    public static function getAllByWorkspaceId($id, $archived = false) {

    }


    public function getStories() {

    }

    public function addComment($text) {

    }

    /*
    /**
     * Function to create a project.
     *
     * @param AsanaWorkspace $workspace An AsanaWorkspace object.
     * @param string $name The name of the new project.
     * @param string $notes The description of the project.
     *
     * @return string JSON or null
     *
    public function create(AsanaWorkspace $workspace, $name, $notes) {
        $data = json_encode(array('data' => array("workspace"=>$workspace->id, "name"=>$name, "notes"=>$notes)));

        return $this->askAsana($this->projectsUrl, $data, ASANA_METHOD_POST);
    }

    /**
     * @param $id
     * @param array $opts
     *
     * @return string JSON or null
     *
    public function get($id, Array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->projectsUrl . '/' . $id . '?' . $options);
    }

    /**
     * Returns the projects in all workspaces containing archived ones or not.
     *
     * @param boolean $archived Return archived projects or not
     * @param string  $opt_fields Return results with optional parameters
     *
    public function getAll($archived = false, $opt_fields = '') {
        $archived = $archived ? 'true' : 'false';
        $opt_fields = $opt_fields !== '' ? '&opt_fields=' . $opt_fields : '';

        return $this->askAsana($this->projectsUrl . '?archived=' . $archived . $opt_fields);
    }


    /**
     * Returns all projects in a specific workspace, optionally including the archive.
     *
     * @param AsanaWorkspace $workspace
     * @param bool $archived
     * @param array $opts
     *
     * @return mixed
     *
    public function getAllInWorkspace(AsanaWorkspace $workspace, $archived = false, Array $opts = array()) {
        $archived = $archived ? 'true' : 'false';
        $options = http_build_query($opts);

        return $this->askAsana($this->projectsUrl . '?archived=' . $archived . '&workspace=' . $workspace->id . '&' . $options);
    }

    /**
     * This method modifies the fields of a project provided in the request, then returns the full updated record.
     *
     * @param array $data An array containing fields to update, see Asana API if needed.
     *                    Example: array("name" => "Test", "notes" => "It's a test project");
     *
     * @return mixed JSON string or null
     *
    public function update(Array $data) {
        $data = json_encode(array("data" => $data));

        return $this->askAsana($this->projectsUrl . '/' . $this->id, $data, ASANA_METHOD_PUT);
    }

    /**
     * Deletes the project
     *
     * @return string Empty if success
     *
    public function delete() {
        return $this->askAsana($this->projectsUrl . '/' . $this->id, null, ASANA_METHOD_DELETE);
    }

    /**
     * Returns all unarchived tasks of a given project
     *
     * @param array $opts
     *
     * @return mixed JSON string or null
     *
    public function getTasks(array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->taskUrl . '?project=' . $this->id . '&' . $options);
    }

    /**
     * Returns the list of stories associated with the object.
     * As usual with queries, stories are returned in compact form.
     * However, the compact form for stories contains more
     * information by default than just the ID.
     * There is presently no way to get a filtered set of stories.
     *
     * @param array $opts
     * @return mixed
     *
    public function getStories(array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->projectsUrl . '/' . $this->id . '/stories?' . $options);
    }

    /**
     * Adds a comment to a project
     * The comment will be authored by the authorized user, and timestamped when the server receives the request.
     *
     * @param string $text
     * @return mixed JSON string or null
     *
    public function addComment($text = '') {
        $data = json_encode(array('data' => array('text' => $text)));

        return $this->askAsana($this->projectsUrl . '/' . $this->id . '/stories', $data, ASANA_METHOD_POST);
    }*/
}