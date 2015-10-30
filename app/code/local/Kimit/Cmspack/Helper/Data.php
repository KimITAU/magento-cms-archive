<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 9/17/15
 * Time: 4:40 PM
 */ 
class Kimit_Cmspack_Helper_Data extends Mage_Core_Helper_Abstract {


    /**
     * Renders CMS page on front end
     *
     * Call from controller action
     *
     * @param $action
     * @param integer $pageId
     * @return boolean
     */
    public function renderPage($action, $versionId = null)
    {
        return $this->_renderPage($action, $versionId);
    }

    /**
     * Renders CMS page
     *
     * @param $action
     * @param integer $pageId
     * @param bool $renderLayout
     * @return boolean
     */
    protected function _renderPage($action, $versionId, $renderLayout = true)
    {

        //$page = Mage::getSingleton('cms/page');
        $archive = Mage::getModel('kimit_cmspack/pagearchive')->load($versionId,'archive_id');

        $page = Mage::getModel('cms/page');

        $page->setData($archive->getData());

        if (!$page->getPageId()) {
            return false;
        }

        $inRange = Mage::app()->getLocale()
            ->isStoreDateInInterval(null, $page->getCustomThemeFrom(), $page->getCustomThemeTo());

        if ($page->getCustomTheme()) {
            if ($inRange) {
                list($package, $theme) = explode('/', $page->getCustomTheme());
                Mage::getSingleton('core/design_package')
                    ->setPackageName($package)
                    ->setTheme($theme);
            }
        }

        $action->getLayout()->getUpdate()
            ->addHandle('default')
            ->addHandle('cms_page')
            ->addHandle('cms_page_view');

        $action->addActionLayoutHandles();
        if ($page->getRootTemplate()) {
            $handle = ($page->getCustomRootTemplate()
                && $page->getCustomRootTemplate() != 'empty'
                && $inRange) ? $page->getCustomRootTemplate() : $page->getRootTemplate();
            $action->getLayout()->helper('page/layout')->applyHandle($handle);
        }

        Mage::dispatchEvent('cms_page_render', array('page' => $page, 'controller_action' => $action));

        $action->loadLayoutUpdates();
        $layoutUpdate = ($page->getCustomLayoutUpdateXml() && $inRange)
            ? $page->getCustomLayoutUpdateXml() : $page->getLayoutUpdateXml();
        $action->getLayout()->getUpdate()->addUpdate($layoutUpdate);
        $action->generateLayoutXml()->generateLayoutBlocks();

        $contentHeadingBlock = $action->getLayout()->getBlock('page_content_heading');
        if ($contentHeadingBlock) {
            $contentHeading = $this->escapeHtml($page->getContentHeading());
            $contentHeadingBlock->setContentHeading($contentHeading);
        }

        if ($page->getRootTemplate()) {
            $action->getLayout()->helper('page/layout')
                ->applyTemplate($page->getRootTemplate());
        }

        /* @TODO: Move catalog and checkout storage types to appropriate modules */
        $messageBlock = $action->getLayout()->getMessagesBlock();
        foreach (array('catalog/session', 'checkout/session', 'customer/session') as $storageType) {
            $storage = Mage::getSingleton($storageType);
            if ($storage) {
                $messageBlock->addStorageType($storageType);
                $messageBlock->addMessages($storage->getMessages(true));
            }
        }

        if ($renderLayout) {
            $action->renderLayout();
        }

        return true;
    }

}