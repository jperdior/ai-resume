<?php

declare(strict_types=1);

namespace App\AiResume\Infrastructure\Storage\Mongo;

use MongoDB\Client;
use MongoDB\Database;

class AbstractMongoDdRepository
{
    protected Database $mongoDbDatabase;

    public function __construct()
    {
        $mongoDbHost = getenv('MONGO_DB_HOST');
        $mongoDbPort = getenv('MONGO_DB_PORT');
        $mongoDbDatabase = getenv('MONGO_DB_DATABASE');
        $client = new Client("mongodb://$mongoDbHost:$mongoDbPort/$mongoDbDatabase");

        $this->mongoDbDatabase = $client->selectDatabase($mongoDbDatabase);
    }
}
