<?php

namespace Tracking;

use Tracking\ApiInterface;

class Api implements ApiInterface
{
    use Request;

    public $sandbox = false;
    /**
     * @var mixed
     */
    private $airNumber;

    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
    }

    /**
     * @return string The complete url.
     */
    protected function getBaseUrl($path = null)
    {
        $port = $this->apiPort === 443 ? "https" : "http";
        $url = $port . "://" . $this->apiBaseUrl . "/" . $this->apiVersion . '/trackings';
        if ($path !== null) {
            if ($this->sandbox) {
                $url .= '/sandbox';
            }
            $url .= "/{$path}";
        }
        echo "Request Url:" . $url . PHP_EOL;
        return $url;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiKey
     */
    private function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Sets the client id to be used for requests.
     *
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function realtime($params = [])
    {
        $this->apiPath = 'realtime';
        return $this->sendApiRequest($params);
    }

    public function count($params = [])
    {
        $this->apiPath = 'count';

        return $this->sendApiRequest($params);
    }

    public function get($params = [])
    {
        $this->apiPath = 'get';

        return $this->sendApiRequest($params);
    }

    public function modifyinfo($params = [])
    {
        $this->apiPath = 'modifyinfo';

        return $this->sendApiRequest($params, 'put');
    }

    public function archive($params = [])
    {
        $this->apiPath = 'archive';

        return $this->sendApiRequest($params, 'post');
    }

    public function delete($params = [])
    {
        $this->apiPath = 'delete';

        return $this->sendApiRequest($params, 'delete');
    }

    public function create($params = [])
    {
        $this->apiPath = 'create';
        return $this->sendApiRequest($params, 'post');
    }

    public function manualUpdate($params = [])
    {
        $this->apiPath = 'manualupdate';
        return $this->sendApiRequest($params, 'post');
    }

    public function remote($params = [])
    {
        $this->apiPath = 'remote';
        return $this->sendApiRequest($params, 'post');
    }

    public function transitTime($params = [])
    {
        $this->apiPath = 'transitTime';
        return $this->sendApiRequest($params, 'post');
    }

    public function detect($params = [])
    {
        $this->apiPath = 'detect';
        return $this->sendApiRequest($params, 'post');
    }

    public function courier()
    {
        $this->apiPath = 'courier';
        return $this->sendApiRequest();
    }

    public function status($params = [])
    {
        $this->apiPath = 'status';
        return $this->sendApiRequest($params);
    }

    public function notUpdate($params = [])
    {
        $this->apiPath = 'notupdate';
        $params_arr = ['num', 'express'];
        $formData = $this->filter_data($params, $params_arr);
        return $this->sendApiRequest($params, 'post');
    }

    public function modifyCourier($params = [])
    {
        $this->apiPath = 'modifycourier';
        return $this->sendApiRequest($params, 'put');
    }

    public function user()
    {
        $this->apiPath = "userinfo";
        return $this->sendApiRequest();
    }


    public function airRealtime($params)
    {
        $this->apiPath = "aircargo";
        if (empty($params) || !is_array($params)) {
            return $this->errorResponse(4501);
        }
        if (isset($params['track_number'])) {
            $this->airNumber = $params['track_number'];
            $this->checkAirNumberRequirements();
        }
        $this->apiVersion='v2';
        return $this->sendApiRequest($params, 'post');
    }
}