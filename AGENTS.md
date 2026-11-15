# Reglas de Desarrollo del Proyecto (WordPress / Codebymonk)

Este proyecto utiliza el tema base personalizado **codebymonk** con Docker, ACF Pro (Advanced Custom Fields), Tailwind CSS, GSAP y Laravel Mix. Todo desarrollo futuro debe adherirse estrictamente a las siguientes 12 reglas:

---

### 1. Tema Base: `codebymonk`
- Todos los desarrollos de nuevos sitios o features deben implementarse sobre el tema ubicado en `wp-content/themes/codebymonk`.
- Mantener la integridad de la estructura del tema y sus convenciones.

---

### 2. Estructura de Bloques ACF y `acf-json`
- Cada componente visual se implementa como un **bloque Gutenberg de ACF** en la carpeta `wp-content/themes/codebymonk/blocks/`.
- La configuración de campos de ACF debe guardarse y versionarse siempre en formato JSON dentro de `wp-content/themes/codebymonk/acf-json/`.
- Nunca dejar campos desincronizados; asegurar la sincronización automática de ACF JSON.

---

### 3. Estilos y Animaciones: Tailwind CSS + GSAP
- **Tailwind CSS**: Utilizar Tailwind para utilidades de diseño, espaciados, tipografías y maquetación responsiva.
- **GSAP**: Utilizar GSAP (ScrollTrigger, timelines, etc.) para cualquier animación, transición e interactividad dinámica. Los scripts se organizan modularmente y se integran en el ciclo de carga del tema/bloque.

---

### 4. Contenido 100% Dinámico y Editable en WordPress
- **Cero contenido hardcodeado** en los archivos PHP de plantillas o bloques.
- Todo texto, titular, descripción, botón/enlace, imagen, video o lista debe estar mapeado a campos de ACF (`get_field()`, `the_field()`, etc.) para que el usuario o cliente pueda editarlo directamente desde el backend de WordPress.

---

### 5. Clases PHP y Directorio Dedicado (`classes/`)
- Utilizar Programación Orientada a Objetos (POO) cuando la lógica de negocio, manejo de datos o integración lo amerite.
- Almacenar todas las clases en `wp-content/themes/codebymonk/classes/` (o modularmente bajo namespaces acordes).
- Integrar la carga automática o inclusión ordenada en `functions.php`.

---

### 6. Principios DRY y SOLID
- Evitar duplicación de lógica entre bloques (DRY).
- Aplicar principios SOLID:
  - Responsabilidad única para clases y módulos.
  - Reutilización de lógica común (ej. obtención de datos de usuario, parseo de URLs, helpers de medios) a través de constructores, clases base o servicios auxiliares.
  - Inyectar o instanciar servicios compartidos en lugar de reescribir funciones idénticas en múltiples bloques.

---

### 7. Preview / Screenshot para Bloques ACF en el Backend
- Cada bloque ACF creado debe contar con su **vista previa o captura (screenshot)** para el selector de bloques de Gutenberg.
- Configurar el soporte `example` en el registro del bloque ACF (`acf_register_block_type`) y manejar el modo `$is_preview` para mostrar una imagen o mockup representativo en el editor.
- Almacenar las imágenes de preview organizadas (por ejemplo en `assets/img/blocks/{slug}.png` o `blocks/previews/{slug}.png`).

---

### 8. Arquitectura SCSS Modular y Compilación Global
- Cada bloque tiene su archivo SCSS dedicado (ej. `assets/scss/blocks/_{slug}.scss`).
- Unificar todos los bloques en `assets/scss/blocks/_all.scss`, el cual es importado por `assets/scss/_all.scss` y finalmente compilado vía `assets/scss/style.scss` con Laravel Mix.
- Mantener la separación de responsabilidades:
  - `main/`: Resets, tipografía base, variables globales.
  - `utils/`: Mixins y helpers SCSS.
  - `blocks/`: Estilos específicos por bloque.
  - `sections/`: Estilos de partes globales (header, footer, navegación).

---

### 9. Carpeta de Diseños: `design/`
- Los insumos de diseño se ubican en la carpeta `design/` en la raíz del repositorio.
- Pueden presentarse como archivos/enlaces de Figma, maquetaciones HTML o capturas/screenshots.
- Consultar siempre `design/` como fuente de verdad para la maquetación fiel del diseño.

---

### 10. Limpieza Pre-Commit (Eliminar Otros Temas)
- **Siempre eliminar cualquier otro tema antes de hacer commit.**
- Dentro de `wp-content/themes/` solo debe existir el tema activo `codebymonk`.
- Eliminar de inmediato temas por defecto de WordPress (`twentytwentythree`, `twentytwentyfour`, `twentytwentyfive`, etc.) o cualquier otro tema residual antes de realizar cualquier commit o push.

---

### 11. Inicio del Entorno de Desarrollo (Docker y Dominio Local)
- **Iniciar Docker**: Al comenzar el desarrollo, levantar los contenedores mediante `docker compose up -d`.
- **Dominio Local**: Configurar e iniciar el proyecto bajo el dominio local con el formato `local.{nombre-del-proyecto}.com`.
- Reflejar la URL correspondiente en la variable `PROXY` del archivo `.env` para sincronización con BrowserSync / Laravel Mix y la configuración de WordPress (`siteurl` / `home`).

---

### 12. Convención de Commits y Prohibición de Push Automático
- **Estructura del Commit**:
  - **Título**: Nombre claro y conciso de la tarea principal realizada.
  - **Descripción / Cuerpo**: Resumen estructurado de los cambios introducidos, archivos afectados o funcionalidades agregadas.
- **Push Manual Exclusivo**:
  - **NUNCA hacer `git push` de forma automática.**
  - Mantener los commits únicamente en local hasta que el usuario solicite explícitamente enviarlos al repositorio remoto.



