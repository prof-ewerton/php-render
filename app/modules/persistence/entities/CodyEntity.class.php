<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Entidade principal do Cody.
*/
require_once('modules/persistence/AccessId.enum.php');
require_once('modules/persistence/postgres/CodyEntityDAO.class.php');

class CodyEntity {

	private string $UUID;
	private DateTime $createdAt;
	private string $type = 'object';

	private string $ownerUUID = '';
	private string $subtype = '';
	private AccessId $accessId = AccessId::ACCESS_PRIVATE;
	private string $name = '';

	public function getUUID(): string {
		return $this->UUID;
	}

	public function setUUID(string $UUID) {
		$this->UUID = $UUID;
	}

	public function getCreatedAt(): DateTime {
		return $this->createdAt;
	}

	public function setCreatedAt(DateTime $createdAt) {
		$this->createdAt = $createdAt;
	}

	public function getType(): string {
		return $this->type;
	}

	public function setType(string $type) {
		$this->type = $type;
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

	public function getName(): string {
		return $this->name;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function save() {
		$dao = new CodyEntityDAO();
		if (isset($this->UUID)) {
			if ($dao->exists($this->UUID)) {
				$dao->update($this);
				return;
			}
		}
		$dao->create($this);
	}

	public function exists(): bool {
		$dao = new CodyEntityDAO();
		return $dao->exists($this->UUID);
	}

	public function annotate(string $name, $value): string {
		$annotateId = 0;
		return $annotateId;
	}

	public function relationship(string $name, string $UUID) {
		$relationId = 0;
		return $relationId;
	}
	
    public function json() {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }
}