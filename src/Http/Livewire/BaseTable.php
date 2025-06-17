<?php

namespace Gambito\LivewireTable\Http\Livewire;

use Livewire\Component;
use Gambito\LivewireTable\Filters\Sortable;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseTable extends Component
{
    public ?string $sortField = null;
    public ?string $sortDirection = null;

    protected Sortable $sortable;

    public string $theme = '';

    public function mount()
    {
        $this->sortable = new Sortable();
    }

    public function sortBy(string $field)
    {
        if (! isset($this->sortable)) {
            $this->sortable = new Sortable();
        }

        $this->sortable->sortField = $this->sortField;
        $this->sortable->sortDirection = $this->sortDirection;

        $this->sortable->sortBy($field);

        $this->sortField = $this->sortable->sortField;
        $this->sortDirection = $this->sortable->sortDirection;
    }

    protected function applySorting(Builder $query): Builder
    {
        if (! isset($this->sortable)) {
            $this->sortable = new Sortable();
        }

        $this->sortable->sortField = $this->sortField;
        $this->sortable->sortDirection = $this->sortDirection;

        return $this->sortable->apply($query);
    }

    public function getSortedRecordsProperty()
    {
        $query = $this->getRecords();

        if (! $query instanceof Builder) {
            throw new \Exception('El método getRecords debe devolver un Builder.');
        }

        return $this->applySorting($query)->get();
    }

    public function render()
    {
        $theme = $this->theme ?: config('tools.theme');

        return view("tools::components.{$theme}.table", [
            'columns' => $this->columns(),
            'records' => $this->sortedRecords,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
        ]);
    }

    abstract protected function getRecords(): Builder;

    protected function columns(): array
    {
        return [];
    }
}
