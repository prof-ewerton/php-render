<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição:
*/
require_once('modules/persistence/AccessId.enum.php');
require_once('modules/persistence/postgres/CodyEntityDAO.class.php');

class CodyEntity {

	private string $UUID;
	private DateTime $createdAt;
	private string $type = 'object';

	private string $ownerUUID;
	private string $subtype;
	private AccessId $accessId = AccessId::ACCESS_PRIVATE;
	private string $title;
	private string $description;

	private CodyEntityDAO $dao;

	public function __construct() {
        $this->dao = new CodyEntityDAO();
    }

	public function getUUID(): string {
		return $this->UUID;
	}

	public function setUUID(string $UUID) {
		$this->UUID = $UUID;
	}

	public function getType(): string {
		return $this->type;
	}

	public function getCreatedAt(): DateTime {
		return $this->createdAt;
	}

	public function getOwnerUUID(): string {
		return $this->ownerUUID;
	}

	public function setOwnerUUID(string $ownerUUID) {
		$this->ownerUUID = $ownerUUID;
	}

	public function getSubtype(): string {
		return $this->subtype;
	}

	public function setSubtype(string $subtype) {
		$this->subtype = $subtype;
	}

	public function getAccessId(): AccessId {
		return $this->accessId;
	}

	public function setAccessId(AccessId $accessId) {
		$this->accessId = $accessId;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function setTitle(string $title) {
		$this->title = $title;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function setDescription(string $description) {
		$this->description = $description;
	}

	public function save() {
		if (isset($this->UUID)) {
			if ($this->dao->exists($this->UUID)) {
				$this->dao->update($this);
				return;
			}
		}
		$uuid = $this->dao->create($this);
		$this->setUUID($uuid);
	}

	public function exists(): bool {
		return $this->dao->exists($this->UUID);
	}

	public function annotate(string $name, $value): string {
		$annotateId = 0;
		return $annotateId;
	}

	public function relationship(string $name, string $UUID) {
		$relationId = 0;
		return $relationId;
	}
}