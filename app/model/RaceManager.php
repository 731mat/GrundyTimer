<?php

namespace App\Model;

use Nette;
use App\Model\SouteziciManager;
use App\Model\KategorieManager;

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
    private $kategorieManager;


    public function __construct(Nette\Database\Context $database, SouteziciManager $souteziciManager, KategorieManager $kategorieManager)
    {
        $this->database = $database;
        $this->souteziciManager = new souteziciManager($database);
        $this->kategorieManager = new kategorieManager($database);
    }

    private function getPeopleInCategory($arrayKategorie){
        $pole = array();
        foreach ($arrayKategorie['category'] as $kategorie){
            array_push($pole,$this->souteziciManager->getByCategory($kategorie));
        }
        return $pole;
    }
    public function peopleStart($arrayKategorie){
        //Vygenerování dotazu pro zapsání do tabulky uživatel zapíče cas a pocet kol
        $dotazy = "";
        // for kazde smycky vyhodi jedno ID kategorie
        foreach ($arrayKategorie['category'] as $kategorie){
            // dotazy se ukadaji za sebe do promenne
            $pocetKol = $this->kategorieManager->getById($kategorie);
            $pocetKol = $pocetKol['count_round'];
            $dotazy = $dotazy."UPDATE `user` SET `start_time` = time(now()), `finish_time` = NULL, `round_time` = NULL, `countRound` = ".$pocetKol." WHERE `user`.`category` = ".$kategorie." AND `user`.`start_time` IS NULL;";
        }
        // ulozene dotazy se najednou vsechny provedou
        $this->database->query($dotazy);


        $dotazy1 = "";
        // vytahnutí indexu vsech soutezicich lidi
        $indexyPeople = $this->getPeopleInCategory($arrayKategorie);
        foreach ($indexyPeople as $people){
            foreach ($people as $index){
                $dotazy1 = $dotazy1."DELETE FROM `round` WHERE `round`.`idUser` = ".$index.";";
            }
        }
        $this->database->query($dotazy1);
    }
    public function peopleReset($arrayKategorie){
        //Vygenerování dotazu pro zapsání do tabulky uživatel zapíče cas a pocet kol
        $dotazy = "";
        // for kazde smycky vyhodi jedno ID kategorie
        foreach ($arrayKategorie['category'] as $kategorie){
            // dotazy se ukadaji za sebe do promenne
            $pocetKol = $this->kategorieManager->getById($kategorie);
            $pocetKol = $pocetKol['count_round'];
            $dotazy = $dotazy."UPDATE `user` SET `start_time` = NULL, `finish_time` = NULL, `round_time` = NULL, `countRound` = 0, `dfn` = 0 WHERE `user`.`category` = ".$kategorie.";";
        }
        // ulozene dotazy se najednou vsechny provedou
        $this->database->query($dotazy);


        $dotazy1 = "";
        // vytahnutí indexu vsech soutezicich lidi
        $indexyPeople = $this->getPeopleInCategory($arrayKategorie);
        foreach ($indexyPeople as $people){
            foreach ($people as $index){
                $dotazy1 = $dotazy1."DELETE FROM `round` WHERE `round`.`idUser` = ".$index.";";
            }
        }
        $this->database->query($dotazy1);
    }


    public function peopleStop($arrayKategorie){
        //Vygenerování dotazu pro zapsání do tabulky uživatel zapíče cas a pocet kol
        $dotazy = "";
        // for kazde smycky vyhodi jedno ID kategorie
        foreach ($arrayKategorie['category'] as $kategorie){
            // dotazy se ukadaji za sebe do promenne
            $pocetKol = $this->kategorieManager->getById($kategorie);
            $pocetKol = $pocetKol['count_round'];
            $dotazy = $dotazy."UPDATE `user` SET `finish_time` = '23:59:59', `round_time` = NULL, `countRound` = 0, `dfn` = 1 WHERE `user`.`category` = ".$kategorie." AND `user`.`finish_time` IS NULL;";
        }
        // ulozene dotazy se najednou vsechny provedou
        $this->database->query($dotazy);
    }



    //dotaz INSERT INTO `round` (`id`, `time`, `idUser`) VALUES (NULL, TIMEDIFF( TIMEDIFF( time(now()), (SELECT user.start_time FROM user WHERE user.id = ?)), (SELECT IF((SEC_TO_TIME(SUM(time_to_sec(`kolo`.`time`))) IS NULL), '00:00:00', (SEC_TO_TIME( SUM(time_to_sec(`kolo`.`time`))))) FROM `round` AS `kolo` WHERE `kolo`.`idUser` = ? )) , ?)

    public function addRound($id){
        try{
            //$this->database->query("INSERT INTO `round` (`id`, `time`, `idUser`) VALUES (NULL, TIMEDIFF(time(now()),(SELECT user.start_time FROM user WHERE user.id = ?)), ?)",$id,$id);
            $this->database->query("INSERT INTO `round` (`id`, `time`, `idUser`) VALUES (NULL, TIMEDIFF( TIMEDIFF( time(now()), (SELECT user.start_time FROM user WHERE user.id = ?)), (SELECT IF((SEC_TO_TIME(SUM(time_to_sec(`kolo`.`time`))) IS NULL), '00:00:00', (SEC_TO_TIME( SUM(time_to_sec(`kolo`.`time`))))) FROM `round` AS `kolo` WHERE `kolo`.`idUser` = ? )) , ?)",$id,$id,$id);
        }catch(Exeption $e){
            throw new Exception();
        }
    }

    public function deleteAllTime(){
        try{
            $this->database->query("UPDATE `user` SET `start_time` = NULL, finish_time = NULL, round_time = NULL ");
        }catch(Exeption $e){
            throw new Exception();
        }
    }



}