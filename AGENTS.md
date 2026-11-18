# Reglas de Desarrollo del Proyecto (WordPress / Codebymonk)

Este proyecto utiliza el tema base personalizado **codebymonk** con Docker, ACF Pro (Advanced Custom Fields), Tailwind CSS, GSAP y Laravel Mix. Todo desarrollo futuro debe adherirse estrictamente a las siguientes 17 reglas:

---

### 1. Tema Base: `codebymonk`
- Todos los desarrollos de nuevos sitios o features deben implementarse sobre el tema ubicado en `wp-content/themes/codebymonk`.
- Mantener la integridad de la estructura del tema y sus convenciones.

---

### 2. Estructura de Bloques ACF y `acf-json`
- Cada componente visual se implementa como un **bloque Gutenberg de ACF** en la carpeta `wp-content/themes/codebymonk/blocks/`.
- **Estructura de Acordeón en ACF**: Al crear o definir los campos de cualquier bloque ACF, se debe incluir siempre un campo tipo **Accordion** al inicio con el nombre del bloque para que sea fácil de gestionar y colapsar en el backend de WordPress.
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
- Almacenar las imágenes de preview organizadas dentro de `wp-content/themes/codebymonk/assets/img/blocks/{slug}.png`.

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

---

### 13. Estructura Organizada de Imágenes (`assets/img/`)
- Toda imagen estática del tema debe organizarse obligatoriamente en subcarpetas semánticas dentro de `wp-content/themes/codebymonk/assets/img/`:
  - `logos/`: Logos, isotipos, marcas de agua y favicons.
  - `photos/`: Fotografías de personas, equipo, testimonios y clientes.
  - `backgrounds/`: Fondos, texturas, banners e imágenes de ambientación.
  - `blocks/`: Capturas y vistas previas de bloques ACF para el selector de Gutenberg (Regla 7).
  - `icons/`: Iconos SVG o rasterizados de interfaz.
- Nunca colocar imágenes sueltas en la raíz de `assets/img/`.

---

### 14. Reestructuración Obligatoria en Revisiones y Proyectos Iniciados
- Si el proyecto ya está iniciado (o contiene código previo) y el usuario solicita una revisión, auditoría o check del proyecto, se debe **reestructurar y refactorizar todo lo necesario para alinearlo al 100% con estas reglas sin excepción**:
  - Eliminar cualquier contenido hardcodeado en plantillas o bloques PHP y migrarlo a campos dinámicos de ACF.
  - Comprobar que cada grupo de campos ACF en `acf-json/` inicie con un campo tipo `Accordion` representativo del bloque.
  - Generar o verificar los screenshots de preview para el selector de bloques en `assets/img/blocks/{slug}.png`.
  - Mover y clasificar cualquier imagen suelta dentro de su subcarpeta semántica en `assets/img/` (`logos/`, `photos/`, `backgrounds/`, `blocks/`, `icons/`).
  - Separar estilos en archivos SCSS dedicados (`assets/scss/blocks/_{slug}.scss`) e integrarlos en `_all.scss`.
  - Modularizar scripts con GSAP y trasladar lógica repetitiva a clases en `classes/` aplicando DRY y SOLID.
  - Diferir librerías pesadas (Three.js, WebGL) mediante `requestIdleCallback` para eliminar bloqueos del hilo principal (TBT).
  - Eliminar cualquier directiva `@import url()` en hojas de estilo SCSS/CSS y asegurar `font-display: swap` en todas las fuentes.
  - Asignar atributos `aria-label` a enlaces visuales/botones sin texto y corregir la jerarquía secuencial de encabezados.
  - Verificar la existencia física en disco de todos los assets referenciados para garantizar cero errores 404 en consola.
  - Purgar cualquier tema ajeno a `codebymonk` en `wp-content/themes/`.

---

### 15. Sincronización y Retroalimentación de Reglas Globales al Cierre de Proyecto
- Al concluir o entregar cualquier proyecto derivado, se debe contrastar y revisar este listado maestro de reglas (`AGENTS.md`).
- Si durante el desarrollo de ese proyecto se optimizaron flujos, se corrigieron arquitecturas o se descubrieron mejores prácticas de carácter **global** (aplicables a todos los desarrollos y no específicas de un cliente o funcionalidad aislada), dichas optimizaciones deben transferirse y actualizarse en este repositorio base (`WordPress-Docker-Starter-Theme`).
- Esto garantiza que cada nuevo sitio comience con la base más refinada y actualizada.

---

### 16. Optimización SEO, GEO SEO, PageSpeed Insights, AdSense y Custom Code
- **SEO On-Page y Semántica HTML5**:
  - Estructuración semántica obligatoria con jerarquía lógica y secuencial de encabezados (`<h1>` único por página, seguido de `<h2>`-`<h6>` estrictamente descendentes sin saltos de nivel como `<h2>` a `<h4>`).
  - Metadatos dinámicos integrados: títulos optimizados, meta descriptions obligatorias en todas las páginas, canonical URLs, robots meta (`index, follow`).
  - Open Graph (`og:title`, `og:description`, `og:image`, `og:url`, `og:type`) y Twitter Cards dinámicos para previsualización enriquecida en redes sociales.
  - Atributos `alt` descriptivos obligatorios en todas las imágenes renderizadas (mediante ACF o medios de WordPress).
- **Accesibilidad Web (A11y y WCAG AA - Lighthouse 100)**:
  - **Nombres Discernibles en Enlaces (`link-name`)**: Todo enlace (`<a>`), tarjeta visual de portafolio, mockup interactivo o botón con solo iconos que no contenga texto visible DEBE incluir obligatoriamente un atributo `aria-label` descriptivo (ej: `aria-label="Ver proyecto <?php the_title(); ?>"`).
  - **Jerarquía Secuencial de Encabezados (`heading-order`)**: Nunca colocar etiquetas `<h4>` precedidas por un `<div>` o contenedor no encabezado; asegurar que los subtítulos y bloques sigan un árbol estricto `<h1>` -> `<h2>` -> `<h3>` -> `<h4>`.
  - **Contraste de Color Mínimo (`color-contrast`)**: Todos los textos secundarios, badges o etiquetas mono deben garantizar un ratio de contraste mínimo de `4.5:1` con su fondo (WCAG AA) en ambos modos (claro y oscuro), evitando grises excesivamente claros sobre fondos neutros (ej: preferir `#525252` sobre `#737373` en fondos `#f4f4f0`).
- **GEO SEO (SEO Local y Datos Estructurados Schema.org)**:
  - Soporte para etiquetas meta de geolocalización regional y local (`geo.region`, `geo.placename`, `geo.position`, `ICBM`).
  - Inclusión de Schema.org en formato JSON-LD (`WebSite`, `Organization`, `LocalBusiness`, `GeoCoordinates`, `PostalAddress`, `BreadcrumbList`).
  - Campos configurables en Theme Options para definir datos del negocio, coordenadas geográficas, dirección y teléfono para indexación local precisa.
- **PageSpeed Insights y Core Web Vitals (LCP, TBT, CLS - Performance 95-100)**:
  - **Cero Bloqueo de Hilo Principal (TBT < 50ms) con `requestIdleCallback`**: Módulos pesados en cliente como librerías 3D (Three.js, WebGL), canvas interactivos, cursores complejos o animaciones de fondo NO deben ejecutarse durante el primer render, incluso si están above-the-fold. Deben diferirse sistemáticamente mediante `requestIdleCallback` (o tras el evento `load` en estado ocioso del navegador) para mantener el TBT cercano a cero.
  - **Prohibición de `@import url()` en SCSS/CSS**: Prohibido estrictamente utilizar `@import url(...)` dentro de hojas de estilo SCSS o CSS para tipografías externas o librerías, ya que generan cadenas de solicitudes bloqueantes. Las fuentes deben precargarse exclusivamente en el `<head>` vía `<link rel="preload">` y `<link rel="preconnect">`.
  - **Política `font-display: swap` en todas las fuentes**: Forzar siempre `font-display: swap` tanto en tipografías de Google Fonts como en librerías de iconos externas (Font Awesome, etc.) mediante `@font-face { font-display: swap; }` para evitar texto invisible durante la descarga de fuentes.
  - **Cero Errores de Consola y Red 404 (Best Practices 100)**: Antes de imprimir cualquier imagen estática, icono o archivo SVG (ej: logos en carruseles o tickers), verificar la existencia real del archivo en disco (`file_exists()`) para no generar peticiones fallidas 404 que penalicen la auditoría de Best Practices.
  - Carga asíncrona o diferida de scripts (`defer` / `async`) para eliminar bloqueos de renderizado en el hilo principal.
  - Scripts encolados en el footer siempre que no sean críticos para el primer render.
  - Cero Cumulative Layout Shift (CLS): declarar siempre dimensiones explícitas (`width` y `height`) o relaciones de aspecto (`aspect-ratio`) en imágenes, contenedores y bloques visuales.
  - Atributos nativos `loading="lazy"` y `decoding="async"` en imágenes y elementos multimedia situados bajo el pliegue inicial (below-the-fold).
- **Integración y Soporte para Google AdSense**:
  - Arquitectura preparada para insertar script global de AdSense y bloques de anuncios responsivos sin degradar las métricas de PageSpeed.
  - Carga diferida condicional de scripts publicitarios para no penalizar el tiempo de carga inicial.
  - Contenedores de anuncios con altura mínima o reserva de espacio (`min-height`) para prevenir saltos de diseño (CLS) al renderizar la publicidad.
- **Campos Personalizados en Options para Custom Code (Analytics, Header, Footer)**:
  - Página de opciones dedicada en ACF ("External Scripts & Analytics") con campos de código personalizado:
    - **Header Scripts (`header_scripts`)**: Inyección segura en el `<head>` (Google Analytics GA4, Google Tag Manager, Search Console, AdSense Header).
    - **Body Scripts (`body_scripts`)**: Inyección inmediata tras la apertura de `<body>` (`wp_body_open()`, ej. GTM `<noscript>` iframe).
    - **Footer Scripts (`footer_scripts`)**: Inyección previa al cierre de `</body>` (`wp_footer()`, scripts de chat, píxeles de seguimiento y widgets diferidos).

---

### 17. Protocolo de Blog y Checklist SEO On-Page Pre-Publicación (Estándar CodeByMonk)
Todo módulo de blog, plantilla de artículo (`single.php`) y contenido editorial creado para WordPress debe adherirse rigurosamente a la metodología y checklist de 7 puntos de CodeByMonk ([seo-on-page-wordpress-checklist](https://codebymonk.com/seo-on-page-wordpress-checklist/)):

1. **Título Único y Menor a 60 Caracteres**:
   - Cada entrada o artículo debe contar con un título único y atractivo, con la palabra clave principal situada cerca del inicio.
   - Longitud estricta: menos de 60 caracteres para evitar truncamiento en los SERPs de Google.
2. **Meta Descripción que Invite al Clic (120 a 160 Caracteres)**:
   - Longitud entre 120 y 160 caracteres conteniendo la palabra clave y un beneficio tangible y persuasivo.
   - Tratar la meta descripción como el copy de un anuncio: si no convence en dos líneas, el clic se lo lleva otro resultado.
3. **Estructura de Encabezados y Redacción para Escanear**:
   - **Un solo `<h1>` por artículo**: El `<h1>` representa el tema principal indiscutible.
   - **Capítulos `<h2>` y Secciones `<h3>`**: División en capítulos lógicos estrictamente descendentes sin saltos arbitrarios.
   - **Escribir para escanear**: Párrafos cortos de 2 a 3 oraciones, una idea por párrafo, uso de viñetas (`<ul>`, `<ol>`) y citas destacadas (`<blockquote>`). Si el lector entiende el artículo leyendo únicamente los encabezados, la estructura es correcta.
4. **URLs Limpias y Palabras Clave Estratégicas (Sin Relleno)**:
   - Estructura de enlaces permanentes corta y semántica basada en el nombre de la entrada (`/%postname%/`), sin fechas ni parámetros raros.
   - La palabra clave debe aparecer en los cuatro puntos neurálgicos: en el título, en el primer párrafo (primeras 100 palabras), en al menos un `<h2>` y en la URL. Prohibido el *keyword stuffing*.
5. **Optimización de Imágenes y Texto Alternativo (`alt`)**:
   - Compresión previa a la subida en formatos modernos ligeros (**WebP** o AVIF).
   - Nombres de archivo descriptivos con palabras reales separadas por guiones (ejemplo: `seo-local-wordpress-google-maps.webp` en vez de `IMG_1234.jpg`).
   - El atributo `alt` es contenido accesible para lectores de pantalla y Google: describir fielmente lo que muestra la imagen integrando la palabra clave solo cuando tenga sentido contextual.
6. **Estrategia de Enlazado Interno y Externo (Arquitectura Web)**:
   - Cada artículo debe incluir obligatoriamente **de 2 a 3 enlaces internos** hacia páginas de servicios (`/#servicios`), portafolio (`/#portafolio`), contacto (`/#contacto`) u otros artículos relacionados del blog.
   - Usar texto de anclaje (anchor text) semántico y descriptivo, nunca frases vacías como "haz clic aquí" o "más información".
   - Todo enlace interno y externo debe contar con contrastes accesibles WCAG AA (> 4.5:1), subrayado discernible (`text-underline-offset`) y estados `:hover` y `:focus-visible`.
7. **Velocidad, Experiencia Móvil y Marcado Estructurado Schema.org**:
   - Priorizar métricas de Core Web Vitals (LCP < 1.8s, TBT < 50ms, CLS = 0).
   - Móvil primero: botones táctiles accesibles (mínimo 44x44px), tipografías fluidas legibles sin necesidad de zoom y cero desbordes horizontales.
   - Marcado Schema.org enriquecido con `BlogPosting` o `Article` y `BreadcrumbList` en formato JSON-LD, incluyendo autor (`Person`), fecha de publicación (`datePublished`), fecha de modificación (`dateModified`), descripción y medios.

