<?php

namespace Asana;

class AsanaAttachment {

    private $api;

    private $id;
    private $created_at;
    private $download_url;
    private $host;
    private $name;
    private $parent;
    private $view_url;

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

}