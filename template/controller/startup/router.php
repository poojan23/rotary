<?php
class ControllerStartupRouter extends PT_Controller
{
	public function index()
	{
		# Route
		if (isset($this->request->get['url']) && (string)$this->request->get['url'] != 'startup/router') {
			$route = (string)$this->request->get['url'];
		} else {
			$route = $this->config->get('action_default');
		}

		# Sanitize the call
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', $route);

		# Trigger the pre events
		$result = $this->event->trigger('controller/' . $route . '/before', array(&$route, &$data));

		if (!is_null($result)) {
			return $result;
		}

		# We dont want to use the loader class as it would make an controller callable.
		$action = new Action($route);

		# Any output needs to be another Action object.
		$output = $action->execute($this->registry);

		# Trigger the post events
		$result = $this->event->trigger('controller/' . $route . '/after', array(&$route, &$data, &$output));

		if (!is_null($result)) {
			return $result;
		}

		return $output;
	}
}
