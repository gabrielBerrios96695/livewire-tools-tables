<?php

namespace Gambito\LivewireTable\Columns;

class ActionColumn extends Column
{
    protected array $buttons = [];

    public static function make(string $title, string $field = ''): static
    {
        return new static($field, $title);
    }

    public function __construct(string $field, string $title)
    {
        parent::__construct($field, $title);
    }

    /**
     * Agrega un botón que apunta a una ruta
     *
     * @param string $label Texto del botón
     * @param string|null $route Nombre de la ruta
     * @param array $params Campos para construir la URL (ej: ['id'])
     * @param string $class Clases CSS para el botón
     * @param string|null $icon Nombre del icono para blade lucide (sin x-lucide-)
     * @param string|null $title Texto tooltip
     * @return static
     */
    public function button(
        string $label,
        ?string $route = null,
        array $params = [],
        string $class = 'bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition',
        ?string $icon = null,
        ?string $title = null
    ): static {
        $this->buttons[] = compact('label', 'route', 'params', 'class', 'icon', 'title');
        return $this;
    }

    public function resolve($record): string
{
    $output = '<div class="flex justify-center items-center space-x-2">';
    foreach ($this->buttons as $btn) {
        $url = $btn['route']
            ? route($btn['route'], collect($btn['params'])->mapWithKeys(fn($key) => [$key => $record->{$key}])->toArray())
            : '#';

        $output .= sprintf(
            '<a href="%s" class="%s" title="%s">%s</a>',
            $url,
            $btn['class'],
            e($btn['title'] ?? ''),
            e($btn['label'])
        );
    }
    return $output . '</div>';
}

}
