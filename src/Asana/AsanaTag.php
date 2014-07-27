<?php

namespace Asana;

class AsanaTag {

    private $api;

    private $id;
    private $created_at;
    private $followers;
    private $name;
    private $color;
    private $notes;
    private $workspace;

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

    public function create($name, AsanaWorkspace $workspace = null) {

    }

    public static function get($id) {

    }

    public function update($data) {

    }

    public function delete() {

    }

    public static function getAll() {

    }

    /*
    /**
     * Returns the full record for a single tag.
     *
     * @param string $tagId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getTag($tagId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->tagsUrl . '/' . $tagId . '?' . $options);
    }

    /**
     * Returns the full record for all tags in all workspaces.
     *
     * @return string JSON or null
     *
    public function getTags() {
        return $this->askAsana($this->tagsUrl);
    }

    /**
     * Modifies the fields of a tag provided in the request, then returns the full updated record.
     *
     * @param string $tagId
     * @param array $data An array containing fields to update, see Asana API if needed.
     * Example: array("name" => "Test", "notes" => "It's a test tag");
     *
     * @return string JSON or null
     *
    public function updateTag($tagId, $data) {
        $data = array('data' => $data);
        $data = json_encode($data);

        return $this->askAsana($this->tagsUrl . '/' . $tagId, $data, ASANA_METHOD_PUT);
    }

    /**
     * Returns the list of all tasks with this tag. Tasks can have more than one tag at a time.
     *
     * @param string $tagId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getTasksWithTag($tagId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->tagsUrl . '/' . $tagId . '/tasks?' . $options);
    }*/
} 