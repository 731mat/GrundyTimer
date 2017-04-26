<?php

namespace App\Model;

use Nette;



/**
 * Users management.
 */
class KategorieManager
{
    use Nette\SmartObject;

    const
        TABLE_NAME = 'category',
        COLUMN_ID = 'id',
        COLUMN_JMENO = 'name';

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
    public function getAll($order = self::COLUMN_JMENO)
    {
        return $this->database->table(self::TABLE_NAME)->order($order)->fetchAll();
    }

    public function getById($id)
    {
        //return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->fetch();
        return $this->database->table(self::TABLE_NAME)->get($id);
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
        if ($this->database->query('SELECT COUNT(`id`) AS `pocet` FROM `user` WHERE `user`.`category` LIKE ?',$id)->fetch()['pocet'] > 0)
            return false;
        try{
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->delete();
        }catch(Exeption $e){
            throw new Exception();
        }
        return true;
    }
    public function getPole(){
        $categories = $this->getAll();
        foreach($categories as $category){
            $tempArray[$category->id] = $category->name.' ('.$category->count_round.' kol)';
        }
        return $tempArray;
    }



    public function getPoleObsazeniKategorie(){
       return $this->database->query("SELECT (SELECT category.name FROM category WHERE category.id = user.category) AS name, COUNT(user.category) AS pocet FROM user GROUP BY user.category ")->fetchAll();
    }

    // fukce která vrací kolik bylo max v tabulce zaznamů
    public function getMaxRoundInCategory(){
       return $this->database->query("SELECT MAX(`count_round`) AS `max` FROM `category`")->fetch()['max'];
    }
    // fukce která vrací kolik bylo max v tabulce zaznamů  V kategorii
    public function getMaxRoundInCategoryById($id){
       return $this->database->query("SELECT MAX(`count_round`) AS `max` FROM `category` WHERE `category`.`id` = ?",$id)->fetch()['max'];
    }
}