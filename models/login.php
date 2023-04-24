<?php 
namespace app\models;
use app\core\Application;
use app\core\Model;
class login extends Model
{
    public string $email = '';
    public string $password = '';
    public function rules(): array
    {
        return [
            'email' => [ [self::RULE_REQUIRED],[self::RULE_EMAIL]],
            'password' => [[self::RULE_REQUIRED] ,[self::RULE_VALID],[self::RULE_MIN, 'min'=>8],[self::RULE_MAX,'max'=>64]]
        ];
    } 
    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user){
            $this->addError('email',[parent::RULE_VALID , 'attr'=>'Email'] );
            return false;
        }
        if (!password_verify($this->password , $user->password)) {
            $this->addError('password',[parent::RULE_VALID , 'attr'=>'Password'] );
            return false;
        }
    }
}









?>