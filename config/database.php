<?php

function getDatabaseConfig(): array {
    return[
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=siperpus_test",
                "username" => "root",
                "password" => ''                
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=siperpus",
                "username" => "root",
                "password" => ''  
            ]
        ]
    ];
}