<?php

namespace App\Model;

use Nette;

/**
 * Users management.
 */
class StartManager
{
    use Nette\SmartObject;

    const
        TABLE_NAME = 'round',
        COLUMN_ID = 'id',
        COLUMN_TIME = 'time';

    /** @var Nette\Database\Context */
    private $database;


    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }



}