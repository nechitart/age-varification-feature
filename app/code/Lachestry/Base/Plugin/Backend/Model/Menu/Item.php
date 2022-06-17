<?php
/**
 * Lachestry Base extension
 * php version 7.1.13
 *
 * @category  Lachestry
 * @package   Lachechestry_Base
 * @author    Lachestry <support@lachestry.com>
 * @copyright 2019 Lachestry (https://lachestry.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://lachestry.com/
 */

namespace Lachestry\Base\Plugin\Backend\Model\Menu;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Menu link plugin
 *
 * @author   Lachestry <support@lachestry.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     http://lachestry.com/
 */
class Item
{
    const MARKETPLACE_ACL = 'Lachestry_Base::marketplace';

    protected $config;

    /**
     * Constructor
     *
     * @param ScopeConfigInterface $config Config
     */
    public function __construct(
        ScopeConfigInterface $config
    ) {
        $this->config = $config;
    }

    /**
     * After get URL
     *
     * @param \Magento\Backend\Model\Menu\Item $subject Subject
     * @param string                           $url     URL
     *
     * @return string
     */
    public function afterGetUrl(\Magento\Backend\Model\Menu\Item $subject, $url)
    {
        $id = $subject->getId();
        $marketUrl = $this->config->getValue('lachestry/base/marketplace_url');
        return $id == self::MARKETPLACE_ACL ? $marketUrl : $url;
    }
}
