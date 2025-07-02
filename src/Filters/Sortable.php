<?php

namespace Gambito\LivewireTable\Filters;

use Illuminate\Database\Eloquent\Builder;

class Sortable
{
    protected ?string $sortField = null;
    protected ?string $sortDirection = null;
    protected array $multiSort = [];
    protected bool $multiSortActive = false;

    public function sortByColumn(string $field, bool $isMultiSortRequest = false): void
    {
        if ($isMultiSortRequest) {
            $this->multiSortActive = true;
        }

        if (!$this->multiSortActive) {
            $this->handleSimpleSort($field);
            return;
        }

        $this->handleMultiSort($field);
    }

    protected function handleSimpleSort(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = match ($this->sortDirection) {
                'asc' => 'desc',
                'desc' => null,
                default => 'asc',
            };

            if ($this->sortDirection === null) {
                $this->sortField = null;
            }
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->multiSort = [];
    }

    protected function handleMultiSort(string $field): void
    {
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

        if (empty($this->multiSort)) {
            $this->multiSortActive = false;
        }

        $this->sortField = null;
        $this->sortDirection = null;
    }

    public function applySorting(Builder $query): Builder
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

    public function resetSorting(): void
    {
        $this->sortField = null;
        $this->sortDirection = null;
        $this->multiSort = [];
        $this->multiSortActive = false;
    }

    // Métodos para sincronización con Livewire
    public function syncFromArray(array $state): void
    {
        $this->sortField = $state['sortField'] ?? null;
        $this->sortDirection = $state['sortDirection'] ?? null;
        $this->multiSort = $state['multiSort'] ?? [];
        $this->multiSortActive = $state['multiSortActive'] ?? false;
    }

    public function toArray(): array
    {
        return [
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
            'multiSort' => $this->multiSort,
            'multiSortActive' => $this->multiSortActive,
        ];
    }

    // Getters
    public function getSortField(): ?string { return $this->sortField; }
    public function getSortDirection(): ?string { return $this->sortDirection; }
    public function getMultiSort(): array { return $this->multiSort; }
    public function isMultiSortActive(): bool { return $this->multiSortActive; }
}