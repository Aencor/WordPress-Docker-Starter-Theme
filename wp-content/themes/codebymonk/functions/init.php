<?php
/**
 * Initial setup and constants
 */
function monk_theme_setup() {
	// Enable plugins to manage the document title
	add_theme_support("title-tag");

	// Add post thumbnails
	add_theme_support("post-thumbnails");

	// Add Menus
	add_theme_support("menus");

	// Add HTML5 markup for captions
	add_theme_support("html5", ["caption", "comment-form", "comment-list"]);
}
add_action("after_setup_theme", "monk_theme_setup");

// Adding Theme Support
add_theme_support("custom-logo");

/**
 * Autoloader para las clases en la carpeta `classes/` (Regla 5 y 6: POO, SOLID, DRY).
 * Soporta tanto el namespace `Monk\` como clases directas.
 */
spl_autoload_register(function ($class) {
	$base_dir = get_template_directory() . '/classes/';
	$prefix = 'Monk\\';

	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) === 0) {
		$relative_class = substr($class, $len);
		$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
		if (file_exists($file)) {
			require_once $file;
			return;
		}
	}

	$file = $base_dir . str_replace('\\', '/', $class) . '.php';
	if (file_exists($file)) {
		require_once $file;
	}
});

