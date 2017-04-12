<?php

namespace App\Model;

use Nette;
use App\Model\SouteziciManager;

/**
 * Users management.
 */
class RaceManager
{
    use Nette\SmartObject;

    const
        TABLE_NAME = 'round',
        COLUMN_ID = 'id',
        COLUMN_TIME = 'time';

    /** @var Nette\Database\Context */
    private $database;
    private $souteziciManager;


    public function __construct(Nette\Database\Context $database, SouteziciManager $souteziciManager)
    {
        $this->database = $database;
        $this->souteziciManager = new souteziciManager($database);
    }

    private function getPeopleInCategory($arrayKategorie){
        $pole = array();
        foreach ($arrayKategorie['category'] as $kategorie){
            array_push($pole,$this->souteziciManager->getByCategory($kategorie));
        }
        return $pole;
    }
    public function peopleStart($arrayKategorie){
        $indexyPeople = $this->getPeopleInCategory($arrayKategorie);
        foreach ($indexyPeople as $people){
            foreach ($people as $index){
                try{
                    $this->database->query("DELETE FROM `round` WHERE `round`.`id` = ?",$index);
                    $this->database->query("INSERT INTO `round` (`id`, `time`, `count_round`, `idUser`) VALUES (NULL, time(now()), 0, ?)",$index);
                }catch(Exeption $e){
                    throw new Exception();
                }
            }
        }

    }
    public function addRound($id){
        try{
            $this->database->query("INSERT INTO `round` (`id`, `time`, `idUser`) VALUES (NULL, time(now()), ?)",$id);
        }catch(Exeption $e){
            throw new Exception();
        }
    }
}