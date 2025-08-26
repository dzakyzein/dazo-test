<?php

namespace App\Services;

use MongoDB\Client;

class MongoService
{
    protected $client;
    protected $db;

    public function __construct()
    {
        $this->client = new Client(env('MONGO_URI', 'mongodb://127.0.0.1:27017'));
        $this->db = $this->client->selectDatabase(env('MONGO_DB', 'dazo_test'));
    }

    public function collection($name)
    {
        return $this->db->selectCollection($name);
    }
}
