<?php 
namespace app\core\form;
use app\core\Model;
/**
 * Summary of Form
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) $CURRENT_YEAR
 */
class Form
{
    public static function begin($action , $method)
    {
        echo sprintf("<form action='%s' method='%s'>", $action, $method);
        return new Form();
    }
    public static function end()
    {
        echo "</form>";
    }
    public function field(Model $model,$attribute)
    {
        return new Field($model, $attribute);
        
    }
}
?>