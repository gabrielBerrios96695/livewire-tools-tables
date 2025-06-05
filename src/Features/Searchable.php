<?php

namespace GabrielBerrios\LivewireToolsTable\Features;

use Illuminate\Database\Eloquent\Builder;
use GabrielBerrios\LivewireToolsTable\Columns\CustomColumn;

class Searchable
{
    public static function apply(Builder $query, string $search, array $columns): Builder
    {
        return $query->where(function ($q) use ($search, $columns) {
            foreach ($columns as $column) {
                if ($column->searchable) {
                    if ($column instanceof CustomColumn) {
                        // Usamos la expresión CONCAT() generada y la búsqueda LIKE
                        $q->orWhereRaw(
                            $column->getSearchExpression() . ' LIKE ?',
                            ['%' . $search . '%']
                        );
                    } else {
                        // Para columnas normales
                        $q->orWhere($column->name, 'like', '%' . $search . '%');
                    }
                }
            }
        });
    }
}
