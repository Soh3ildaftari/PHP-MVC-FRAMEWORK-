<?php
namespace app\models;
/**
 * Summary of contactForm
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
use app\core\db\Dbmodel;
class contactForm extends Dbmodel
{
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public function rules(): array
     {
        return [
            'email' => [[self::RULE_REQUIRED], [self::RULE_EMAIL]],
            'subject' => [[self::RULE_REQUIRED]],
            'message' => [[self::RULE_REQUIRED]],
        ];
    }
    public function label():array 
    {
        return [
            'email' => 'Your Email',
            'subject' => 'It\'s About :',
            'message' => 'Message',
        ];
    }
    public static function tableName(): string
    {
        return 'messages';
    }
    public function attributes(): array
    {
        return ['email', 'subject','message'];
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function save()
    {
        return parent::save();
    }
    public static function findOne(array $where)
    { 
        
    }
}











?>