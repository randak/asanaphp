<?php

namespace Asana;

class AsanaUser {

    private $api;

    private $id;
    private $email;
    private $name;
    private $photo;
    private $workspaces;

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

    public static function get($id) {

    }

    public static function getAll() {

    }

    public static function getAllByWorkspace(AsanaWorkspace $workspace) {

    }

    public static function getAllByWorkspaceId($id) {

    }
/*

    /**
     * Returns the full user record for a single user.
     * Call it without parameters to get the users info of the owner of the API key.
     *
     * @param string $userId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getUserInfo($userId = null, array $opts = array()) {
        $options = http_build_query($opts);

        if (is_null($userId)) {
            $userId = 'me';
        }

        return $this->askAsana($this->userUrl . '/' . $userId . '?' . $options);
    }

    /**
     * Returns the user records for all users in all workspaces you have access.
     *
     * @return string JSON or null
     *
    public function getUsers() {
        return $this->askAsana($this->userUrl);
    }*/
} 