<?php


function theme_scripts() {

	if (is_single() && comments_open() && get_option("thread_comments")) {
		wp_enqueue_script("comment-reply");
	}

	wp_register_script(
		"theme-defer",
		get_template_directory_uri() . "/assets/js/main.js",
		"",
		2,
		true
	);
	wp_enqueue_script("theme-defer");
	
	// Main Style
	wp_enqueue_style(
		"master",
		get_template_directory_uri() . "/dist/css/style.min.css",
		true,
		"1.1",
		"all"
	);
}

add_action("wp_enqueue_scripts", "theme_scripts", 9999);
