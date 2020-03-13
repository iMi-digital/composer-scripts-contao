<?php

namespace IMI\ComposerScriptsContao;

use IMI\DatabaseHelper\Mysql;
use IMI\DatabaseHelper\Operations\Dump;
use Symfony\Component\Yaml\Yaml;

class DbDump
{

    /**
     * Read DB parameters and dump database to master, stripping tables
     *
     * Reads env DUMP_STRIP_ADDITIONAL (string, space separated list)
     */
    public static function dumpToMaster()
    {
        $parameters = Yaml::parseFile(dirname(__DIR__) . '/app/config/parameters.yml');

        $mysql = new Mysql([
            'host' => $parameters['parameters']['database_host'],
            'username' => $parameters['parameters']['database_user'],
            'password' => $parameters['parameters']['database_password'],
            'dbname' => $parameters['parameters']['database_name']
        ]);

        $dump = new Dump($mysql);
        $dump->setStrip('tl_log tl_sessions ' . getenv('DUMP_STRIP_ADDITIONAL'));
        $dump->setFilename('sql/master.sql');
        $dump->setAddTime('no');

        foreach ($dump->createExec()->getCommands() as $command) {
            echo $command . PHP_EOL;
            shell_exec($command);
        }
    }
}