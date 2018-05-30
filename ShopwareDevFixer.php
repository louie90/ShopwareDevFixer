<?php
namespace ShopwareDevFixer;

use Shopware\Components\Plugin;

class ShopwareDevFixer extends Plugin
{
	public static function getSubscribedEvents()
	{
		return [
			"Enlight_Controller_Action_PreDispatch_frontend" => "beforeFrontendCaching"
		];
	}

	public function beforeFrontendCaching ()
	{
		$config = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName($this->getName());
		$webCachePath = $this->container->getParameter('kernel.cache_dir');

		if ($config["clear_js_cache_before_request"]) {
			foreach (glob("$webCachePath/*.js") as $path) {
				unlink($path);
			}
		}
	}
}
