<?php
/**
 * Created by PhpStorm.
 * User: 升值中
 * Date: 2017-08-10
 * Time: 16:33
 */

namespace Admin\Model;


use Think\Model;

class RepairModel extends Model{

/*   protected $_validate = array(
        array('name', 'require', '报修者姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('problem', 'require', '问题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );*/
    protected $_auto = array(
        array('t_time', NOW_TIME, self::MODEL_INSERT),
        array('numbers', NOW_TIME, self::MODEL_INSERT),
        //array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_BOTH),
    );
}