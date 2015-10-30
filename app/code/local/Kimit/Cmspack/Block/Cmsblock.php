<?php

class Kimit_Cmspack_Block_Cmsblock extends Mage_Core_Block_Template
{

    public function getArchiveCollection()
    {
        $block_id = $this->getRequest()->getParam('block_id');

        $archiveCollection = Mage::getModel('kimit_cmspack/blockarchive')->getCollection()
            ->addFieldToFilter('block_id',$block_id)
            ->setOrder('archive_id','desc');

        return $archiveCollection;
    }


}