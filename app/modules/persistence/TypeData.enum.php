<?php
enum TypeData: string {
    case UUID = "UUID";
    case NUMBER = "INTEGER";
    case STRING = "VARCHAR(255)";
    case BOOLEAN = "BOOLEAN";
    case DATE = "TIMESTAMP";
    case TEXT = "TEXT";
}
