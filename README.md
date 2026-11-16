# WordPress Starter Theme — Codebymonk

Tema base profesional para desarrollo en WordPress creado por **Codebymonk**, optimizado con Docker, bloques Gutenberg vía ACF Pro (Advanced Custom Fields), Tailwind CSS v4, GSAP (GreenSock) y compilación modular mediante Laravel Mix.

---

## 🛠 Requisitos del Entorno
* [Docker Desktop](https://www.docker.com/)
* [Node.js](https://nodejs.org/en/) (v18+)
* [Visual Studio Code](https://code.visualstudio.com/) o IDE compatible
* Reverse Proxy local configurado para enrutamiento `*.com` (puertos 80/443).

---

## 🚀 Stack Tecnológico
* **WordPress**: CMS principal con soporte para permalinks amigables.
* **ACF Pro (Advanced Custom Fields Pro)**: Gestión 100% dinámica de bloques Gutenberg y campos personalizados sincronizados en JSON.
* **Tailwind CSS v4 & SCSS Modular**: Utilidades de diseño con `@theme`, variables globales y arquitectura SCSS estructurada.
* **GSAP (GreenSock)**: Interactividad dinámica, animaciones fluidas y timelines modulares (`ScrollTrigger`, etc.).
* **Laravel Mix (Webpack)**: Empaquetado y minificación de scripts y hojas de estilo con soporte para BrowserSync.
* **Font Awesome 6**: Iconografía cargada y lista para su uso.

---

## 💻 Inicio Rápido en Local

### 1. Iniciar Contenedores Docker
```bash
docker compose up -d
```
El contenedor se vinculará a la red local resolviendo bajo el dominio del proyecto:
```text
http://local.{nombre-del-proyecto}.com
```
> Asegúrate de definir `PROXY=local.{nombre-del-proyecto}.com` en tu archivo `.env`.

### 2. Compilar Recursos Frontend
En la raíz del proyecto:
```bash
# Instalar dependencias de Node
npm install

# Compilación de desarrollo
npm run dev

# Modo desarrollo con auto-recarga (Watch / BrowserSync)
npm run watch

# Compilación optimizada para producción
npm run prod
```
Los archivos finales se compilan dentro de `wp-content/themes/codebymonk/assets/build/` con versionado dinámico para evitar problemas de caché.

---

## 📂 Estructura del Proyecto

```text
├── design/                          # Diseños de referencia (Figma, HTML, screenshots)
├── docker-compose.yml               # Configuración de servicios Docker (WP, MariaDB, PhpMyAdmin)
├── AGENTS.md                        # Las 14 Reglas estrictas de desarrollo del proyecto
├── uploads.ini                      # Configuración de límites de subida de PHP
├── webpack.mix.js                   # Configuración de Laravel Mix
├── tailwind.config.js               # Configuración de Tailwind CSS
└── wp-content/
    ├── plugins/                     # Plugins del proyecto (ej. ACF Pro)
    └── themes/
        └── codebymonk/              # Único tema activo permitido
            ├── acf-json/            # Sincronización automática de campos ACF en JSON
            ├── assets/
            │   ├── build/           # Archivos compilados finales (style.css, main.js)
            │   ├── img/             # Estructura semántica estricta de imágenes:
            │   │   ├── backgrounds/ # Fondos, texturas, banners y paisajes
            │   │   ├── blocks/      # Vistas previas / screenshots de bloques ACF
            │   │   ├── icons/       # Iconografía SVG y gráficos de UI
            │   │   ├── logos/       # Logotipos, marcas de agua y favicons
            │   │   └── photos/      # Fotografías de equipo, clientes y testimonios
            │   ├── js/              # Módulos JS (GSAP, router, scripts específicos)
            │   └── scss/            # Arquitectura SCSS modular (main, blocks, sections)
            ├── blocks/              # Plantillas PHP de los bloques Gutenberg de ACF
            ├── classes/             # Clases PHP (POO, DRY, SOLID): BlockHelper, etc.
            ├── functions/           # Módulos de inicialización, scripts y registro de bloques
            ├── footer.php           # Pie de página global
            ├── header.php           # Cabecera y navegación global
            └── functions.php        # Punto de entrada de funciones del tema
```

---

## 🧱 Arquitectura de Bloques ACF (Gutenberg)

Cada componente visual se construye como un bloque ACF en `wp-content/themes/codebymonk/blocks/`:

1. **Auto-registro**: Los bloques en `blocks/*.php` se registran dinámicamente en [functions/blocks.php](file:///Users/kike/work/WordPress-Docker-Starter-Theme/wp-content/themes/codebymonk/functions/blocks.php).
2. **Campo Accordion Obligatorio**: Al definir los campos en ACF, el primer campo **debe ser un Accordion** con el nombre del bloque para facilitar su colapso y organización en el backend.
3. **Preview / Screenshot**: Si existe un screenshot en `assets/img/blocks/{slug}.png`, el selector de bloques de Gutenberg mostrará automáticamente la vista previa visual (`$is_preview`).
4. **Contenido 100% Dinámico**: Todo texto, imagen o enlace debe consumir campos ACF (`get_field()`). Cero contenido hardcodeado.
5. **Estilos dedicados**: Cada bloque cuenta con su archivo SCSS en `assets/scss/blocks/_{slug}.scss`, unificado en `assets/scss/blocks/_all.scss`.

---

## 📜 Resumen de Reglas de Desarrollo (`AGENTS.md`)

Todo colaborador y agente debe respetar las 16 reglas establecidas en [AGENTS.md](file:///Users/kike/work/WordPress-Docker-Starter-Theme/AGENTS.md):
1. **Tema Base**: Todo desarrollo se implementa exclusivamente en `codebymonk`.
2. **Estructura ACF**: Bloques en `blocks/`, campo `Accordion` inicial y esquemas en `acf-json/`.
3. **Tailwind CSS + GSAP**: Tailwind para estilos responsivos y GSAP para animaciones.
4. **Contenido Dinámico**: Cero texto quemado en plantillas PHP.
5. **Clases PHP (`classes/`)**: POO modular con autoloader PSR-4 en `functions/init.php`.
6. **Principios DRY y SOLID**: Centralización de lógica común en clases y constructores.
7. **Preview en Backend**: Screenshot para cada bloque en `assets/img/blocks/{slug}.png`.
8. **SCSS Modular**: Archivo dedicado por bloque compilado vía Laravel Mix.
9. **Carpeta `design/`**: Fuente de verdad de diseño en la raíz del repositorio.
10. **Limpieza Pre-Commit**: Ningún otro tema residual en `wp-content/themes/`.
11. **Entorno Docker & Dominio Local**: `docker compose up -d` y dominio `local.{proyecto}.com`.
12. **Convención de Commits & Push Manual**: Título conciso, cuerpo descriptivo y **cero push automático**.
13. **Organización de Imágenes**: Ubicación obligatoria en subcarpetas semánticas (`logos/`, `photos/`, `backgrounds/`, `blocks/`, `icons/`).
14. **Reestructuración Obligatoria**: Si un proyecto previo se somete a revisión, refactorizarlo íntegramente para cumplir al 100% estas reglas.
15. **Retroalimentación Global al Cierre**: Al finalizar un proyecto, revisar y actualizar este repositorio base con cualquier mejora de reglas de alcance global.
16. **Optimización SEO, GEO SEO, PageSpeed Insights, AdSense y Custom Code**: Metadatos SEO/GEO dinámicos, Schema.org JSON-LD, optimización Core Web Vitals (defer, resource hints, lazy loading, prevención de CLS) y gestión dinámica de custom scripts y Google AdSense desde Theme Options.
