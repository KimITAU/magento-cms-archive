<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 9/17/15
 * Time: 5:05 PM
 */ 
class Kimit_Cmspack_Model_Resource_Blockarchive extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('kimit_cmspack/blockarchive', 'blockarchive_id');
    }

}