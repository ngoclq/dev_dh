<?php
namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use ArrayObject;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;

class TableCommon extends Table
{
    var $language = DEFAULT_LANGUAGE;
    public $deleted_name = 'delete_flag';
    
    
    public function initialize(array $config)
    {
        $this->language =  Configure::read('Config.language', DEFAULT_LANGUAGE);
    }
    
    function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (empty($entity->user_id)) {
            $entity->user_id = 1; // Phai sua lai la user dang login
        }
        
        if (is_null($entity->display_flag) || $entity->display_flag === '') {
            $entity->display_flag = FLAG_TRUE;
        }
        
        if (is_null($entity->delete_flag) || $entity->delete_flag === '') {
            $entity->delete_flag = FLAG_FALSE;
        }
        
        if (empty($entity->created)) {
            $entity->created = date('Y-m-d H:i:s');
        }
        
        $entity->updated = date('Y-m-d H:i:s');
        
        return true;
    }
    
    public function beforeFind($query) {
        //error_log(print_r($query, true) . "\n\n=====================\n", 3, '/var/www/DEV_JP/logs/debug_query12345.txt');
        if ($this->hasField($this->deleted_name)) {
            //$query['conditions'][$this->deleted_name] = FLAG_FALSE;
        }
        return $query;
    }
    
    public function commonFind($table, $options = ['type' => 'all', 'joins' => [], 'options' => [], 'get_one' => FLAG_FALSE, 'to_array' => FLAG_FALSE])
    {
        try {
            $tblRegistry = TableRegistry::get($table);
            if(!isset($options ['type']) || empty($options ['type'])) {
                $options ['type'] = 'all';
            }
            
            if(!isset($options ['joins']) || empty($options ['joins']) || !is_array($options ['joins'])) {
                $options ['joins'] = [];
            }
            
            $query = $tblRegistry->find($options ['type'], $options ['options'])->join($options ['joins']);
            if(isset($options ['get_one']) && $options ['get_one'] == FLAG_TRUE && !is_null($query)) {
                $query = $query->first();
            }
            if(isset($options ['to_array']) && $options ['to_array'] == FLAG_TRUE && !is_null($query)) {
                $query = $query->toArray();
            }
            return $query;
        } catch(RecordNotFoundException $ex) {
            return [];
        } catch(Exception $ex) {
            return [];
        }
    }

    public function removeEmptyItem($ary)
    {
        if(!is_array($ary) || empty($ary)) {
            return $ary;
        }
        $emptyPattern = [null, false, '', []];
        return array_diff($ary, $emptyPattern);
    }
    
    public function escapeColumn($name)
    {
        return $name . '_' . $this->get('Config.language');
    }
    
    
    public function generateString($s_length = 8)
    {
        $lower_case = "abcdefghijklmnopqrstuvwxyz";
        $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $num = "0123456789";
        $char_list = [$lower_case, $upper_case, $num];
        $check = FLAG_FALSE;
        while (!$check) {
            $check_list = [0, 0, 0];
            $i = 0;
            $result = "";
            $tmp = "";
            while ($i < $s_length) {
                $type = mt_rand(0, count($char_list) - 1);
                $char = $char_list[$type][mt_rand(0, strlen($char_list[$type]) - 1)];
                if ($char ==  $tmp) {
                    continue;
                }
                $tmp = $char;
                $result.= $char;
                $check_list[$type] = $check_list[$type] + 1;
                $i++;
            }
            if (min($check_list) > 0) {
                $check = FLAG_TRUE;
            }
        }
        return $result;
    }
    
}