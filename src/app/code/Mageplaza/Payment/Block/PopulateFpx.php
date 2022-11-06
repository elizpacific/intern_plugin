<?php

namespace Mageplaza\Payment\Block;

use Magento\Framework\View\Asset\Repository as AssetRepository;

class PopulateFpx extends \Magento\Framework\View\Element\Template
{
    protected $assetRepository;

    public function __construct(
        AssetRepository $assetRepository
    ){
        $this->assetRepository = $assetRepository;
    }

    public function getFpxConfig() {
        $output['fpxLogoImageUrl'] = $this->getViewFileUrl('Mageplaza_Payment:images/fpx_logo.png');

        return $output;
    }

    public function getViewFileUrl($fileId, array $params = [])
    {
        $params = array_merge(['_secure' => $this->request->isSecure()], $params);
        return $this->assetRepository->getUrlWithParams($fileId, $params);
    }
}
