<?php
namespace app\models;
use app\core\Model;
/**
 * Summary of RegisterModel
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
class RegisterModel extends Model
{
    public string $email = '';   
    public string $pass = '';   
    public string $passConf = '';
    public function rules(): array
    {
        return [
            'email' => [ [self::RULE_REQUIRED],[self::RULE_EMAIL]],
            'pass' => [[self::RULE_REQUIRED],[self::RULE_MAX, 'max'=>24 ], [self::RULE_MIN, 'min'=>8 ] ],
            'passConf' => [[self::RULE_REQUIRED] , [self::RULE_MATCH , 'match'=>'pass']]
        ];
    }   





}
?>