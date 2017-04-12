<?php

namespace App\Model;

use Nette;



/**
 * Users management.
 */
class SouteziciManager
{
    use Nette\SmartObject;

    const
        TABLE_NAME = 'user',
        COLUMN_ID = 'id',
        COLUMN_JMENO = 'first_name',
        COLUMN_PRIJMENI = 'last_name',
        COLUMN_NAROZEN = 'birth_year',
        COLUMN_STARTCISLO = 'start_number',
        COLUMN_STARTTIME = 'start_time',
        COLUMN_FINISHTIME = 'finish_time',
        COLUMN_IDKATEGORIE = 'category';


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
    public function getAll($order = self::COLUMN_STARTCISLO)
    {
        return $this->database->table(self::TABLE_NAME)->order($order)->fetchAll();
    }

    public function getById($id)
    {
        //return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->fetch();
        return $this->database->table(self::TABLE_NAME)->get($id);
    }
    public function getByCategory($id)
    {
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_IDKATEGORIE, $id)->fetchAll();
    }
    public function insert($values)
    {
        try{
            $this->database->table(self::TABLE_NAME)->insert($values);
        }catch(Exeption $e){
            throw new Exception();
        }
    }

    public function update($id, $values)
    {
        try{
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->update($values);
        }catch(Exeption $e){
            throw new Exception();
        }
    }

    public function delete($id)
    {
        try{
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->delete();
        }catch(Exeption $e){
            throw new Exception();
        }
    }
    public function getPeopleInSomeRace(){
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_FINISHTIME." IS NULL")->fetchAll();
    }
    public function stepDownRound($id){
        try{
            $this->database->query("UPDATE `user` SET `countRound` = (SELECT `countRound`)-1 WHERE `user`.`id` = ? ",$id);
        }catch(Exeption $e){
            throw new Exception();
        }
    }
}