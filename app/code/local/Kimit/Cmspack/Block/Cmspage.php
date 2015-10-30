<?php

class Kimit_Cmspack_Block_Cmspage extends Mage_Core_Block_Template
{

    public function getArchiveCollection()
    {
        $page_id = $this->getRequest()->getParam('page_id');

        $archiveCollection = Mage::getModel('kimit_cmspack/pagearchive')->getCollection()
            ->addFieldToFilter('page_id',$page_id)
            ->setOrder('archive_id','desc');

        return $archiveCollection;
    }


}