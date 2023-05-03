<?php
namespace app\models;
/**
 * Summary of user
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
use app\core\db\Dbmodel;
class user extends Dbmodel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    public string $email = '';   
    public int $status = self::STATUS_INACTIVE;   
    public string $password = '';   
    public string $passConf = '';
    public function rules(): array
    {
        return [
            'email' => [ [self::RULE_REQUIRED],[self::RULE_EMAIL],[self::RULE_UNIQUE ,'class'=>self::class]],
            'password' => [[self::RULE_REQUIRED],[self::RULE_MAX, 'max'=>24 ], [self::RULE_MIN, 'min'=>8 ] ],
            'passConf' => [[self::RULE_REQUIRED] , [self::RULE_MATCH , 'match'=>'password']]
        ];
      
    }   
    public static function tableName(): string
    {
        return 'users';
    }
    public function attributes(): array
    {
        return ['email', 'password','status'];
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function save()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    public function label(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'passConf' => 'Confirm Password',
        ];
    }
    //OverWrite the findOne Function
    public static function findOne(array $where)
    {
        $tableName = self::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ",array_map(fn($attr) => "$attr = :$attr ", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key",$item);
        }
        $statement->execute();
        return $statement->fetchObject(self::class) ?? null;
    }
    public function displayEmail(){
        return $this->email;
    }





}
?>