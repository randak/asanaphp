<?php

namespace Asana;

class AsanaTeam {

    private $api;

    private $id;
    private $name;

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

    public static function getAllByOrganization(AsanaWorkspace $workspace) {

    }

    public static function getAllByOrganizationId(AsanaWorkspace $id) {

    }
} 