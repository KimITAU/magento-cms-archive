<?php

class Kimit_Cmspack_PreviewController extends Mage_Core_Controller_Front_Action
{
    public function previewAction()
    {


        $versionId = $this->getRequest()->getParam('version_id');
        if (!Mage::helper('kimit_cmspack/page')->renderPreview($this, $versionId)) {
            $this->_forward('noRoute');
        }

    }


}