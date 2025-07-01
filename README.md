# Livewire Tools Tables

[![Licencia MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![PHP Version](https://img.shields.io/badge/php-8.1%2B-blue.svg)](https://php.net/)
[![Laravel Version](https://img.shields.io/badge/laravel-9%2B-orange.svg)](https://laravel.com)

Generador de tablas dinámicas para Laravel Livewire con columnas configurables.

## 📋 Requisitos

- **PHP 8.1 o superior**
- **Laravel 9.x o 10.x**
- **Livewire 2.x o 3.x**
- **Composer** (para la instalación)

## Instalación

```bash
composer require gambito/livewire-tools-tables
```

## Uso rápido

1. Genera un componente para tu modelo:
```bash
php artisan make:tools-table --model=Producto
```

2. Usa el componente en tus vistas:
```blade
<livewire:producto-tools-table />
```

## Tipos de Columnas

### Columna Básica
```php
use Gambito\LivewireTable\Columns\Column;

Column::make('nombre_campo', 'Título Columna')
    ->sortable()    # Hace la columna ordenable
    ->hidden(false) # Oculta/muestra la columna
```

### Columna de Acciones
```php
use Gambito\LivewireTable\Columns\ActionColumn;

ActionColumn::make('Acciones')
    ->button('<i class="fas fa-edit"></i>', 'ruta.editar', ['id'])
    ->button('<i class="fas fa-trash"></i>', 'ruta.eliminar', ['id'])
```

### Columna Personalizada (Expresiones)
```php
use Gambito\LivewireTable\Columns\CustomColumn;

CustomColumn::make('precio * cantidad', 'Total')
```

## Estructura del Proyecto

```
src/
├── Commands/
│   └── MakeToolsTableCommand.php
├── Columns/
│   ├── Column.php
│   ├── ActionColumn.php
│   └── CustomColumn.php
└── Http/
    └── Livewire/
        └── BaseTable.php
```

## Ejemplo Completo

```php
// En App\Livewire\ProductoToolsTable
protected function columns(): array
{
    return [
        Column::make('id', 'ID')->sortable(),
        Column::make('nombre', 'Producto'),
        CustomColumn::make('precio * stock', 'Valor Total'),
        ActionColumn::make('Acciones')
            ->button('<i class="fas fa-eye"></i>', 'productos.show', ['id'])
    ];
}
```

## Limitaciones

- Las relaciones deben estar precargadas con `with()`
- CustomColumn solo accede a atributos directos del modelo
- Requiere Livewire instalado

## Contribución

1. Haz fork del proyecto
2. Crea tu rama (`git checkout -b feature/nueva-funcionalidad`)
3. Haz commit de tus cambios (`git commit -am 'Añade nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Licencia

MIT - Ver [LICENSE](LICENSE) para más detalles.
```
