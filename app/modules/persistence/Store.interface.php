<?php
require_once('modules/persistence/entities/CodyObject');

interface Store {
    public function save(CodyObject $object);
    public function getEntities(string $type, string $subtype, string $ownerUUID): array;
    public function annotations(string $uuid): array;
    public function relations(string $uuid, string $relation): array;
}