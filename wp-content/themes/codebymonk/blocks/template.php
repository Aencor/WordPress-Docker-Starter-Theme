<?php
/**
 * Block Template Boilerplate
 *
 * Puedes usar `cbm_block_attributes($block)` para renderizar los atributos automáticamente,
 * o `$b = cbm_get_block_attributes($block)` si necesitas acceder a $b['id'], $b['name'] o $b['class'] por separado.
 */
$block_attrs = cbm_block_attributes($block);

// Renderizado de Vista Previa / Screenshot para el backend de Gutenberg (Regla 7)
if (!empty($block['data']['is_preview'])) {
	$preview = $block['data']['preview_image'] ?? null;
	if ($preview) {
		echo '<div class="block-preview-wrapper p-2 bg-slate-100 rounded-lg text-center"><img src="' . esc_url($preview) . '" alt="Preview" class="max-w-full h-auto mx-auto shadow-sm rounded" /></div>';
		return;
	}
}
?>

<section <?= $block_attrs; ?>>
	<div class="container mx-auto px-4">
		<!-- Contenido editable vía ACF (Regla 4) -->
	</div>
</section>

