<?php

namespace GabrielBerrios\LivewireToolsTable\Columns;

class Column
{
    public string $name;
    public string $label;
    public bool $searchable = false;

    public function __construct(string $name, ?string $label = null)
    {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
    }

    public static function make(string $name, ?string $label = null): self
    {
        return new self($name, $label);
    }

    public function searchable(bool $value = true): self
    {
        $this->searchable = $value;
        return $this;
    }
}
