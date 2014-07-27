<?php

namespace Asana;

class AsanaStory {

    private $api;

    private $created_at;
    private $created_by;
    private $text;
    private $target;
    private $source;
    private $type;

    public function __construct(AsanaApiWrapper $api, $data) {
        $this->api = $api;

        foreach($data as $key => $value) {
            if(!empty($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    public static function get($id) {

    }

    /*
    /**
     * Returns the full record for a single story.
     *
     * @param string $storyId
     * @param array $opt Array of options to pass
     *                   (@see http://developer.asana.com/documentation/#Options)
     * @return string JSON or null
     *
    public function getSingleStory($storyId, array $opts = array()) {
        $options = http_build_query($opts);

        return $this->askAsana($this->storiesUrl . '/' . $storyId . '?' . $options);
    }*/
} 