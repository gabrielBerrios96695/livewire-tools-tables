<?php

namespace Gambito\LivewireTable\Columns;

class Column
{
    public string $field;
    public string $title;

    protected bool $sortable = false;

    public function __construct(string $field, string $title)
    {
        $this->field = $field;
        $this->title = $title;
    }

    public static function make(string $field, string $title): self
    {
        return new self($field, $title);
    }

    public function sortable(bool $value = true): self
    {
        $this->sortable = $value;
        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }
}
