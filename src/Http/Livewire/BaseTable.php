<?php

namespace Gambito\LivewireTable\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseTable extends Component
{
    public ?string $sortField = null;
    public ?string $sortDirection = null;

    public array $multiSort = [];

    public bool $useMultiSort = true; // multiordenamiento forzado

    public string $template;
    public string $style;

    protected $listeners = ['sortByColumn'];

    public function mount()
    {
        $this->template = 'tools-table::templates.base';
        $this->style = $this->style ?? config('livewire-table.styles', env('LIVEWIRE_TABLE_STYLE', 'ligth'));
    }

    // Método llamado por wire:click en las cabeceras para ordenar
    public function sortByColumn(string $field)
    {
        if (!$this->useMultiSort) {
            // Solo para referencia, si quieres orden simple lo puedes implementar
            $this->sortField = $field;
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            $this->multiSort = [];
            return;
        }

        // Multiordenamiento con 3 estados
        $current = $this->multiSort[$field] ?? null;

        $next = match ($current) {
            null => 'asc',
            'asc' => 'desc',
            'desc' => null,
        };

        if ($next) {
            $this->multiSort[$field] = $next;
        } else {
            unset($this->multiSort[$field]);
        }

        // Limpia orden simple
        $this->sortField = null;
        $this->sortDirection = null;
    }

    protected function applySorting(Builder $query): Builder
    {
        if (!empty($this->multiSort)) {
            foreach ($this->multiSort as $field => $direction) {
                $query->orderBy($field, $direction);
            }
        } elseif ($this->sortField && $this->sortDirection) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return $query;
    }

    public function getSortedRecordsProperty()
    {
        $query = $this->getRecords();

        if (!$query instanceof Builder) {
            throw new \Exception('El método getRecords debe devolver un Builder.');
        }

        return $this->applySorting($query)->get();
    }

    public function render()
    {
        $columns = collect($this->columns())->filter(function ($column) {
            return !method_exists($column, 'isHidden') || !$column->isHidden();
        })->values()->all();

        return view($this->template, [
            'columns'       => $columns,
            'records'       => $this->sortedRecords,
            'sortField'     => $this->sortField,
            'sortDirection' => $this->sortDirection,
            'multiSort'     => $this->multiSort,
            'style'         => $this->style,
            'useMultiSort'  => $this->useMultiSort,
        ]);
    }

    abstract protected function getRecords(): Builder;
    abstract protected function columns(): array;
}
