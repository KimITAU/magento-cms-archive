<?php

class Kimit_Cmspack_Model_Observer
{


    public function cmspageSave($observer)
    {
        $page = $observer->getObject();

        $archivepage = Mage::getModel('kimit_cmspack/pagearchive');

        $data = $page->getData();
        $archivepage->setData($data);
        $archivepage->setUpdateTime(Mage::getSingleton('core/date')->gmtDate());

        $archivepage->save();
    }

    public function cmsblockSave($observer)
    {
        $block = $observer->getObject();

        if(get_class($block) == "Mage_Cms_Model_Block") {

            $archiveblock = Mage::getModel('kimit_cmspack/blockarchive');

            $data = $block->getData();
            $archiveblock->setData($data);

            $archiveblock->setUpdateTime(Mage::getSingleton('core/date')->gmtDate());

            $archiveblock->save();
        }
    }

}