<?php

namespace SS6\ShopBundle\Model\PKGrid;

class Column {

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $queryId;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var bool
	 */
	private $sortable;

	/**
	 * @var string
	 */
	private $classAttribute;

	/**
	 * @param string $id
	 * @param string $queryId
	 * @param string $title
	 * @param bool $sortable
	 */
	public function __construct($id, $queryId, $title, $sortable) {
		$this->id = $id;
		$this->queryId = $queryId;
		$this->title = $title;
		$this->sortable = $sortable;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getQueryId() {
		return $this->queryId;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return bool
	 */
	public function getSortable() {
		return $this->sortable;
	}

	/**
	 * @return string
	 */
	public function getClassAttribute() {
		return $this->classAttribute;
	}

	/**
	 * @param string $class
	 * @return \SS6\ShopBundle\Model\PKGrid\Column
	 */
	public function setClassAttribute($class) {
		$this->classAttribute = $class;

		return $this;
	}

}
