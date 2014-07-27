<?php

namespace Asana;

class AsanaCurl {

    private $timeout = 10;

    private $apiKey;
    private $accessToken;
    private $curl;
    private $resultStatus;

    public function __construct(Array $options) {
        if(!empty($options["apiKey"])) {
            $this->apiKey = $options["apiKey"];
        } elseif(!empty($options["accessToken"])) {
            $this->accessToken = $options["accessToken"];
        } else {
            throw new \Exception("You need to specify an API key or token.");
        }

        if (!empty($this->apiKey) && substr($this->apiKey, -1) !== ':') {
            $this->apiKey .= ':';
        }
    }

    public function request($data = null, $url, $method) {;
        $this->curl = curl_init();
        $this->setCurlOptions($url);

        if (!empty($this->apiKey)) {
            $this->sendWithAPIKey();

            // Send as JSON unless attaching file to task or null data
            if (is_null($data) || empty($data['file'])){
                curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }
        } else if (!empty($this->accessToken)) {
            $this->sendWithAccessToken();
        }

        switch($method) {
            case "POST":
                curl_setopt($this->curl, CURLOPT_POST, true);
                break;
            case "PUT":
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case "DELETE":
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        if (!is_null($data) && ($method == ASANA_METHOD_POST || $method == ASANA_METHOD_PUT)) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($this->curl);

        $this->setResultStatus();
        $this->checkForCurlErrors();
        $this->checkForGetErrors();

        curl_close($this->curl);
        unset($this->curl);

        return $response;

    }

    private function setCurlOptions($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Don't print the result
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Don't verify SSL connection
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); //         ""           ""
    }

    private function sendWithAPIKey() {
        // Send with API key.
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->apiKey);
        curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    }

    private function sendWithAccessToken() {
        // Send with auth token.
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken
        ));
    }

    private function setResultStatus() {
        $this->resultStatus = curl_getinfo($this->curl);
    }

    private function checkForCurlErrors() {
        if(curl_errno($this->curl)) {
            throw new AsanaCurlException(curl_error($this->curl), curl_errno($this->curl));
        }
    }

    private function checkForGetErrors() {
        switch($this->resultStatus["http_code"]) {
            case '200':
            case '201':
                /*
                * 200	Success. If data was requested, it will be available in the data field at the top level of the
                *       response body.
                *
                * 201	Success (for object creation). Its information is available in the data field at the top level
                *       of the response body. The API URL where the object can be retrieved is also returned in the
                *       Location header of the response.
                */
                break;
            case '400':
                throw new AsanaException("(400) Invalid request. This usually occurs because of a missing or malformed
                                parameter. Check the documentation and the syntax of your request and try again.", 400);
                break;
            case '401':
                throw new AsanaException("(401) No authorization. A valid API key was not provided with the request, so
                                the API could not associate a user with the request.", 401);
                break;
            case '403':
                throw new AsanaException("(403) Forbidden. The API key and request syntax was valid but the server is
                                refusing to complete the request. This can happen if you try to read or write to objects
                                or properties that the user does not have access to.", 403);
                break;
            case '404':
                throw new AsanaException("(404) Not found. Either the request method and path supplied do not specify a
                                known action in the API, or the object specified by the request does not exist.", 404);
                break;
            case '429':
                throw new AsanaException("(429) Rate Limit Enforced. Asana imposes a limit on the rate at which users
                                can make requests. The limit is currently around 100 requests per minute, but this is
                                not guaranteed: it may vary with server load, and we may change it in the future. The
                                Retry-After response header will specify the number of seconds until the user can make
                                another request. Clients sending large bursts of requests should handle this error code
                                to retry after the delay. ", 429);
                break;
            case '500':
                throw new AsanaException("(500) Server error. There was a problem on Asana's end.", 500);
                break;
            default:
                throw new AsanaException("An unknown error occurred.", 500);
                break;
        }
    }
}