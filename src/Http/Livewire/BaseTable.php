<?php

namespace Gambito\LivewireTable\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Gambito\LivewireTable\Filters\Sortable;

abstract class BaseTable extends Component
{
    public string $template;
    public string $style;
    
    public ?string $sortField = null;
    public ?string $sortDirection = null;
    public array $multiSort = [];
    public bool $multiSortActive = false;

    protected $listeners = ['sortByColumn'];

    public function mount()
    {
        $this->template = 'tools-table::templates.base';
        $this->style = $this->style ?? config('livewire-table.styles', env('LIVEWIRE_TABLE_STYLE', 'ligth'));
    }

    public function sortByColumn(string $field, bool $isMultiSortRequest = false)
    {
        $sortable = new Sortable();
        $sortable->syncFromArray([
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
            'multiSort' => $this->multiSort,
            'multiSortActive' => $this->multiSortActive,
        ]);

        $sortable->sortByColumn($field, $isMultiSortRequest);

        $state = $sortable->toArray();
        $this->sortField = $state['sortField'];
        $this->sortDirection = $state['sortDirection'];
        $this->multiSort = $state['multiSort'];
        $this->multiSortActive = $state['multiSortActive'];
    }

    public function resetSorting()
    {
        $this->sortField = null;
        $this->sortDirection = null;
        $this->multiSort = [];
        $this->multiSortActive = false;
    }

    protected function applySorting(Builder $query): Builder
    {
        $sortable = new Sortable();
        $sortable->syncFromArray([
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
            'multiSort' => $this->multiSort,
            'multiSortActive' => $this->multiSortActive,
        ]);

        return $sortable->applySorting($query);
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
            'columns' => $columns,
            'records' => $this->sortedRecords,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
            'multiSort' => $this->multiSort,
            'multiSortActive' => $this->multiSortActive,
            'style' => $this->style,
        ]);
    }

    abstract protected function getRecords(): Builder;
    abstract protected function columns(): array;
}