<?php

namespace App\Model;
use Nette;

class InfoManager
{
    use Nette\SmartObject;
    const
        TABLE_NAME = 'info',
        COLUMN_JMENO = 'name',
        COLUMN_DATE = 'date',
        CULUMN_ADRESS = 'adress';

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    /**
     * Vypsat všechny záznamy.
     * @return Nette\Database\Table\ActiveRows
     * @throws
     */
    public function getAll()
    {
        return $this->database->table(self::TABLE_NAME)->fetch();
    }


    public function update($name, $values)
    {
        try{
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_JMENO, $name)->update($values);
        }catch(Exeption $e){
            throw new Exception();
        }
    }
}