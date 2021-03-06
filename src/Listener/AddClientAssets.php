<?php 

namespace Flarum\Auth\FaradayMotion\Listener;

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;

class AddClientAssets
{
	/**
	 * @param Dispatcher $events
	 */
	public function subscribe(Dispatcher $events)
	{
		$events->listen(ConfigureWebApp::class, [$this, 'addAssets']);
	}

	/**
	 * @param ConfigureClientView $event
	 */
	public function addAssets(ConfigureWebApp $event)
	{
		if ($event->isForum()) {
			$event->addAssets([
				__DIR__.'/../../js/forum/dist/extension.js',
				__DIR__.'/../../less/forum/extension.less'
			]);
			$event->addBootstrapper('flarum/auth/faraday-motion/main');
		}

		if ($event->isAdmin()) {
			$event->addAssets([
				__DIR__.'/../../js/admin/dist/extension.js'
			]);
			$event->addBootstrapper('flarum/auth/faraday-motion/main');
		}
	}
}