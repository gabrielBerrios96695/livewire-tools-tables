# 📝 CHANGELOG

## [v1.0.0] - 2025-07-01

🎉 Primera versión estable del paquete.

### ✨ Nuevas características

- Comando `make:tools-table` para generar componentes automáticamente desde modelos.
- Soporte para tres tipos de columnas:
  - `Column`: columnas básicas con ordenamiento.
  - `CustomColumn`: columnas evaluadas dinámicamente con expresiones.
  - `ActionColumn`: columnas con múltiples botones y rutas dinámicas.
- Estilos personalizados sin necesidad de Tailwind:
  - `ligth`, `dark`
- BaseTable listo para extender en cualquier componente Livewire.
- Configuración desde `.env` o archivo `config/tools.php`.
- README completo con ejemplos de uso y estructura.

---
## [v1.1.0] - 2025-07-02

### ✨ Nuevas características

- Soporte para ordenamiento múltiple activado con **Ctrl+Click** en las columnas.
- Ordenamiento simple permanece como modo por defecto.
- Botón **Reset** para limpiar todos los criterios de ordenamiento activos.
- Mejoras en la experiencia de usuario para manejo de ordenamientos en la tabla.
