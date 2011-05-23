<?php
Class View {
	private $view;
	private $vars = array();
	private $buffer;
	
	public function __construct($view) {
		$this->view = $view;
	}
	
	public function set($key, $value) {
		if($key == 'k' || $key == 'v' || $key == 'vars')
			throw new Exception('View Keyword!');
		$this->vars[$key] = $value;
	}
	
	public function prepare() {
		ob_start();
		foreach($this->vars as $k=>$v) {
			eval("$$k = \$v;");
		}
		include($this->view);
		$this->buffer = ob_get_contents();
		ob_end_clean();
	}
	
	public function flush() {
		echo $this->buffer;
	}
}