<?php

namespace Asana;

class AsanaApiWrapper {
    private $endpoint = "https://app.asana.com/api/1.0";

    private $curl;

    public function __construct(Array $options) {
        $this->curl = new AsanaCurl($options);
    }

    public function request($method, $url, $data) { // "GET", "/users/user-id", $data
        try {
            $this->curl->request($data, $this->getFullUrl($url), $method);
        } catch(AsanaCurlException $ex) {
            //todo exception handling
        } catch(AsanaException $ex) {
            //todo exception handling
        }
    }

    protected function getFullUrl($url) {
        return $this->endpoint . $url;
    }
}
