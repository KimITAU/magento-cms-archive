<?php

class Kimit_Cmspack_KimitversionController extends Mage_Adminhtml_Controller_Action
{

    public function restoreAction()
    {
        $pageid = $this->getRequest()->getParam('page_id');
        $versionid = $this->getRequest()->getParam('version_id');

        $page = Mage::getModel('cms/page')->load($pageid);

        $archivepage = Mage::getModel('kimit_cmspack/pagearchive')->load($versionid,'archive_id');


        $page->setTitle($archivepage->getTitle());
        $page->setContent($archivepage->getContent());

        $page->setContentHeading($archivepage->getContentHeading());

        $page->setMetaKeywords($archivepage->getMetaKeywords());
        $page->setMetaDescription($archivepage->getMetaDescription());

        $page->setUpdateTime(Mage::getSingleton('core/date')->gmtDate());

        $page->save();

        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $versionid = $this->getRequest()->getParam('version_id');

        $archivepage = Mage::getModel('kimit_cmspack/pagearchive')->load($versionid,'archive_id');

        $archivepage->delete();

        $this->_redirectReferer();
    }

    public function restoreblockAction()
    {
        $blockid = $this->getRequest()->getParam('block_id');
        $versionid = $this->getRequest()->getParam('version_id');

        $block = Mage::getModel('cms/block')->load(blockid);

        $archiveblock = Mage::getModel('kimit_cmspack/blockarchive')->load($versionid,'archive_id');


        $block->setTitle($archiveblock->getTitle());
        $block->setContent($archiveblock->getContent());

        $block->setUpdateTime(Mage::getSingleton('core/date')->gmtDate());

        $block->save();

        $this->_redirectReferer();
    }

    public function deleteblockAction()
    {
        $versionid = $this->getRequest()->getParam('version_id');

        $archiveblock = Mage::getModel('kimit_cmspack/blockarchive')->load($versionid,'archive_id');

        $archiveblock->delete();

        $this->_redirectReferer();
    }
}