<?php

class Kimit_Cmspack_Block_Cms_Page_Edit_Tab_Version extends Mage_Core_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('cms')->__('Revisions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('cms')->__('Revisions');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/page/' . $action);
    }

    public function getArchiveCollection()
    {
        $page_id = $this->getRequest()->getParam('page_id');

        $archiveCollection = Mage::getModel('kimit_cmspack/pagearchive')->getCollection()
            ->addFieldToFilter('page_id',$page_id)
            ->setOrder('archive_id','desc');

        return $archiveCollection;
    }

    public function getPageId()
    {
        return $this->getRequest()->getParam('page_id');
    }
}