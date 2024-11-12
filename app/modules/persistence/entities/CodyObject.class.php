<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição:
*/
require_once('modules/persistence/AccessId.enum.php');

class CodyObject {

	private string $UUID;
	private string $ownerUUID;
	private string $type = 'object';
	private string $subtype;
	private AccessId $accessId = AccessId::ACCESS_PRIVATE;

	public function getUUID(): string {
		return $this->UUID;
	}

	public function setUUID(string $UUID) {
		$this->UUID = $UUID;
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
}