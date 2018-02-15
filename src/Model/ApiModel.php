<?php

namespace Src\Model;

class ApiModel extends \Src\Engine\Model
{

    /**
     * Carries information about connection to dataBase
     */
    protected $dbInformation = [
        'dbType' => 'external',
        'database' => 'opencart',
        'collection' => 'api',
        'serverConnection' => 'default',
        'customId' => 'api_id'
    ];


    /**
     * Get data from Api Table
     * @param array $args
     * @return array $response
     */
    public function getApis(array $args = null) : array
    {
        $query = \Src\Helpers\QueryGenerator::generateQuery($args);
        $response = $this->read($query);


        // To Read values inside cache
        $cache = \Src\Engine\Cache::cacheInit();
        $query['id'] = 1;
        echo "<pre>" . print_r($cache->getCache($query, $this->dbInformation),true) . "</pre>";die;
    }

}