<?php defined('BASEPATH') or exit('No direct script access allowed');

use Pyro\Module\Variables\VariableData;

/**
 * Variable Plugin
 *
 * Allows tags to be used in content items.
 *
 * @author   PyroCMS Dev Team
 * @package  PyroCMS\Core\Modules\Variables\Plugins
 */
class Plugin_Variables extends Plugin
{

	public $version = '1.0.0';
	public $name = array(
		'en' => 'Variables',
            'fa' => 'متغییر ها',
	);
	public $description = array(
		'en' => 'Set and retrieve variable data.',
            'fa' => 'ایجاد و نمایش متغییر ها',
	);

	protected $variables;

	public function __construct()
	{
		$this->variables = new VariableData;
	}


	/**
	 * Returns a PluginDoc array that PyroCMS uses 
	 * to build the reference in the admin panel
	 *
	 * @return array
	 */
	public function _self_doc()
	{
		$info = array();

		// dynamically build the array for the magic method __call
		$variables = $this->variables->get_all();
		ksort($variables);

		foreach ($variables as $slug => $value)
		{
			$info[$slug]['description'] = array(
				'en' => 'Retrieve the value for variable '.$slug.'.'
			);
			$info[$slug]['single'] = true;
			$info[$slug]['double'] = false;
			$info[$slug]['variables'] = '';
			$info[$slug]['params'] = array();
		}

		return $info;
	}

	/**
	 * Load a variable
	 *
	 * Magic method to get the variable.
	 *
	 * @param string $name
	 * @param string $arguments
	 * @return string
	 */
	public function __call($name, $arguments)
	{
		return $this->variables->$name;
	}
	
	/**
	 * Load a variable
	 *
	 * Magic method to get the variable.
	 *
	 * @param string
	 * @param string
	 * @return string
	 */
	public function set()
	{
		$this->variables->{$this->attribute('name')} = $this->attribute('value');
	}
}

/* End of file plugin.php */