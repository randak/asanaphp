<?php

namespace Asana;

class AsanaCurlException extends \Exception {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
    }
}

class AsanaException extends \Exception {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
    }
}