<?php
namespace app\core;
/**
 * Summary of Model
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_VALID = 'valid';
    public array $errors = [];
    abstract public function rules(): array;
    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this,$key)) {
                $this->{$key} = $value;
            }
        }
    }
    public function label(): array
    {
        return [];
    }
    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with with this {field} already exists',
            self::RULE_VALID => 'Your {attr} is not valid'

        ];
    }
    public function addError(string $attribute,array $rule)
    {
        foreach ($rule as $key => $value) {
            $massage = str_replace("{{$key}}", $value, $this->errorMessages()[$rule[0]]);
        }
        $massage ?? 'undefined error';
        $this->errors[$attribute][] =$massage; 
    }
    public function validate()
    { 
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                 $ruleName = $rule[0];
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, $rule);
                }            
                if ($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, $rule);
                }  
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, $rule);
                }  
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']} ) {
                    $this->addError($attribute, [self::RULE_MATCH , 'match'=> $this->label()[$rule['match']]]);
                }  
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(':attr', $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addError($attribute, [self::RULE_UNIQUE , 'field' => $this->label()[$attribute]] );
                    }   
                }
            }
        }
        return empty($this->errors);
    }
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }    

}







?>