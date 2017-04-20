<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;


/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator
{
    const
        TABLE_NAME = 'userRegistrated',
        COLUMN_ID = 'id',
        COLUMN_NAME = 'name',
        COLUMN_PASSWORD_HASH = 'password';


    /** @var Nette\Database\Context */
    private $database;


    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    /**
     * Performs an authentication.
     * @return Nette\Security\Identity
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        list($name, $password) = $credentials;
        $row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $name)->fetch();

        if (!$row) {
            throw new Nette\Security\AuthenticationException('Zadaný uživatelský name neexistuje.', self::IDENTITY_NOT_FOUND);

        } elseif ($password != $row[self::COLUMN_PASSWORD_HASH]) {
            throw new Nette\Security\AuthenticationException('Zadané uživatelské heslo není správné.', self::INVALID_CREDENTIAL);

        }
        $arr = $row->toArray();
        return new Nette\Security\Identity($row[self::COLUMN_ID], $arr);
    }


    /**
     * Adds new user.
     * @param  string
     * @param  string
     * @return void
     * @throws DuplicateNameException
     */
    public function add($arr)
    {
        try {
            $this->database->table(self::TABLE_NAME)->insert($arr);
        } catch (Nette\Database\UniqueConstraintViolationException $e) {
            throw $e;
        }
    }
    public function change($id,$arr){
        try {
            $this->database->table(self::TABLE_NAME)->where('id = ?',$id)->update($arr);
        } catch (Nette\Database\UniqueConstraintViolationException $e) {
            throw $e;
        }
    }

}



class DuplicateNameException extends \Exception
{}
