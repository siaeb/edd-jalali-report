<?php

namespace siaeb\edd\persian_report\includes;

class Initializer {

	/**
	 * @var AssetsLoader
	 */
	private $_assets_loader;

	/**
	 * @var Actions
	 */
	private $_actions;

	/**
	 * @var Filters
	 */
	private $_filters;

	public function __construct() {
		$this->_actions       = new Actions();
		$this->_filters       = new Filters();
		$this->_assets_loader = new AssetsLoader();
	}



}
