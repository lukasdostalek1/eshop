<?php


class ErrorLog{

    public static function logError($e) {
    error_log($e->getMessage() . " LINE: " . $e->getLine() . " FILE: " . $e->getFile() . "\n", 3, __DIR__ . "/../errors/error.log");
    }

}