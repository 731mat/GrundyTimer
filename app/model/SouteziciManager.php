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

    public function getPeopleStarted(){
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_FINISHTIME." IS NULL")->fetchAll();
    }

    public function getPeopleInFinnish(){
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_FINISHTIME." IS NOT NULL")->fetchAll();
    }
    public function getPoepleForController(){
        //"id" => $people['id'], "start_number" => $people['start_number'], "cout_round" => $people['countRound'], "enable" =>$people['enable']
        return $this->database->query("SELECT `id`, `start_number`, `countRound`, IF(`round_time` IS NOT NULL ,IF(TIMEDIFF(time(now()), `round_time`) > (SELECT `category`.`min_time` FROM `category` WHERE id = `user`.`category`),'1','0'),'1') AS `enable` FROM `user` ")->fetchAll();
    }
    public function stepDownRound($id){
        $dataPeople = $this->database->query("SELECT `countRound` FROM `user` WHERE `user`.`id` = ? ",$id)->fetch();

        // pokud jeste nemá odjezdena vsechna kola
        if($dataPeople['countRound'] > 0) {
            try {
                // sniž pocet kol o jednicku
                $this->database->query("UPDATE `user` SET `countRound` = (SELECT `countRound`)-1, `round_time` = time(now()) WHERE `user`.`id` = ? ", $id);
                // pokud pocet kol bude na nule tak uloz finish time
                if($dataPeople['countRound'] == 1) {
                    $this->database->query("UPDATE `user` SET `finish_time` = time(now()) WHERE `user`.`id` = ? ", $id);
                    // nezapisuj do tabulky posledni kolo
                    return false;
                }
            } catch (Exeption $e) {
                throw new Exception();
            }
            return true;
        }
        return false;
    }
}