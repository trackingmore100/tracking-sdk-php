<?php


namespace Tracking;


interface ApiInterface
{
    /**
     * get track_number info from user account
     * @param array $params
     * @return mixed
     */
    public function realtime($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function count($params = []);
    /**
     * get track_number info from user account
     * @param array $params
     * @return mixed
     */
    public function get($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function modifyinfo($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function archive($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function delete($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function create($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function manualUpdate($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function remote($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function transitTime($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function detect($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function courier();

    /**
     * @param array $params
     * @return mixed
     */
    public function status($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function notUpdate($params = []);

    /**
     * @param array $params
     * @return mixed
     */
    public function modifyCourier($params = []);
}