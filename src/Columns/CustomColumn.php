<?php

namespace GabrielBerrios\LivewireToolsTable\Columns;

class CustomColumn extends Column
{
    public array $fields;
    public string $separator = ' '; 

    public static function make($fields, ?string $label = null): self
    {
        return new self($fields, $label);
    }

    public function __construct($fields, ?string $label = null)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        $this->fields = $fields;

        // En el nombre de la columna, para la búsqueda y tracking interno
        $this->name = implode($this->separator, $fields);

        // Si no hay label, usar los nombres concatenados
        $this->label = $label ?? implode($this->separator, $fields);

        $this->searchable = true;
    }

    
    public function getSearchExpression(): string
    {
        return "CONCAT(" . implode(", '{$this->separator}', ", $this->fields) . ")";
    }

    public function getValue($row): string
    {
        // Usamos array_map para obtener los valores y trim para evitar espacios dobles
        $values = array_map(fn($field) => trim(data_get($row, $field, '')), $this->fields);

        // Evita espacios adicionales innecesarios y los concatena con el separador
        return trim(implode($this->separator, $values));
    }
}
