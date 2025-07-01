---

# 📊 Livewire Tools Table

[![Licencia MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)  
![PHP Version](https://img.shields.io/badge/php-8.1%2B-blue.svg)
![Laravel Version](https://img.shields.io/badge/laravel-10%2B-orange.svg)
![Livewire Version](https://img.shields.io/badge/livewire-3%2B-purple.svg)


---

**Livewire Tools Table** es un paquete Laravel + Livewire que te permite crear **tablas dinámicas, ordenables y personalizadas** a partir de modelos Eloquent, sin depender del stack TALL. Soporta columnas configurables, cálculos personalizados, botones HTML y estilos visuales listos para usar.

> Diseñado para desarrolladores que quieren productividad sin complicaciones.

---

## 🚀 Instalación

```bash
composer require gambito404/tools-table

Opcionalmente, publica los archivos si deseas personalizar vistas o configuración:

php artisan vendor:publish --tag=tools-table-config
php artisan vendor:publish --tag=tools-table-views


---

⚙️ Generación de tablas automáticas

Crea una tabla a partir de un modelo con un solo comando:

php artisan make:tools-table --model=User

Esto generará un componente Livewire como UserToolsTable, listo para usarse:

<livewire:user-tools-table />


---

🧱 Estructura del componente generado

use App\Models\User;
use Gambito\LivewireTable\Columns\Column;
use Gambito\LivewireTable\Http\Livewire\BaseTable;
use Illuminate\Database\Eloquent\Builder;

class UserToolsTable extends BaseTable
{
    protected function columns(): array
    {
        return [
            Column::make('id', 'ID')->sortable(),
            Column::make('name', 'Nombre'),
            Column::make('email', 'Correo')->sortable(),
        ];
    }

    protected function getRecords(): Builder
    {
        return User::query();
    }
}


---

🧠 Tipos de columnas

🔹 Column

Columna estándar con ordenamiento y visibilidad.

Column::make('email', 'Correo')->sortable()->hidden(false)


---

✨ CustomColumn

Define columnas que combinan, transforman o calculan valores de forma dinámica.

🧪 Ejemplo 1: Concatenar nombre completo

CustomColumn::make('name . " " . last_name', 'Nombre completo')

🔢 Ejemplo 2: Calcular edad desde la fecha

CustomColumn::make('(int)((time() - strtotime(birth_date)) / 31556926)', 'Edad')

🛑 Ejemplo 3: Campo condicional con fallback

CustomColumn::make('email ? email : "No disponible"', 'Correo')

💡 Ejemplo 4: Iniciales del usuario

CustomColumn::make('substr(name, 0, 1) . substr(last_name, 0, 1)', 'Iniciales')

> Las expresiones son evaluadas dinámicamente usando los atributos del modelo. No necesitas definir callbacks manuales.




---

🧩 ActionColumn

Permite agregar múltiples botones con rutas y estilos personalizados.

ActionColumn::make('Acciones')
    ->button('<button class="btn btn-sm">✏️ Editar</button>', 'users.edit', ['id'])
    ->button('<button class="btn btn-sm btn-danger">🗑️ Eliminar</button>', 'users.delete', ['id'])


---

🎨 Estilos visuales

Incluye temas por defecto en Blade puro (sin Tailwind):

resources/views/styles/
├── dark.blade.php
├── ligth.blade.php
└── neon-retro.blade.php

Cómo seleccionar el estilo:

Desde el componente:

public string $style = 'dark';

Desde .env:

LIVEWIRE_TABLE_STYLE=neon-retro

O en config/tools.php:

return [
    'styles' => env('LIVEWIRE_TABLE_STYLE', 'ligth'),
];


---

🛠️ Estructura del paquete

livewire-tools-table/
├── src/
│   ├── Columns/
│   │   ├── Column.php
│   │   ├── CustomColumn.php
│   │   └── ActionColumn.php
│   ├── Filters/Sortable.php
│   ├── Http/Livewire/BaseTable.php
│   └── Commands/MakeToolsTableCommand.php
├── resources/views/
│   ├── styles/
│   └── templates/base.blade.php
├── config/tools.php
└── README.md


---

✅ Próximas mejoras

🔍 Búsqueda global por texto

🧪 Filtros por columna

🧾 Exportación a Excel y PDF

🧩 Soporte para CRUD en modales Livewire

🧱 Builder visual para definir columnas desde UI

📦 Presets de columnas por usuario

↕️ Reordenar filas y columnas con drag & drop

💾 Persistencia del orden y visibilidad de columnas

🔄 Recarga automática por eventos

🧮 Nuevas columnas planificadas:

BooleanColumn: muestra ✅ o ❌ según el valor booleano

BadgeColumn: etiquetas con color (ej. estado)

DateColumn: formatea fechas automáticamente

ImageColumn: muestra imágenes desde una URL/campo

ProgressColumn: barras de progreso visuales

ToggleColumn: switches interactivos (on/off)

IconColumn: íconos dinámicos según condición

CheckboxColumn: selección múltiple de filas

RelationColumn: acceso directo a relaciones Eloquent (ej. user.name)




---

👨‍💻 Autor

Gabriel Armando Berrios Mendoza
📧 gabrielberriosmendoza@gmail.com
🔗 GitHub: @gambito404


---

📄 Licencia

Este paquete está licenciado bajo la Licencia MIT.

---

