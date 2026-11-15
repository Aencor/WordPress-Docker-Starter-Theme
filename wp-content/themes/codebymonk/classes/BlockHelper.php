<?php
namespace Monk;

/**
 * Class BlockHelper
 *
 * Aplica principios DRY y SOLID (Regla 6):
 * Proporciona métodos compartidos y reutilizables para bloques ACF,
 * como resolución de usuarios, normalización de enlaces/imágenes de ACF, etc.
 */
class BlockHelper {
	protected ?int $userId;
	protected ?\WP_User $user;

	/**
	 * Constructor: Recibe o resuelve el ID de usuario una sola vez.
	 *
	 * @param int|null $userId
	 */
	public function __construct(?int $userId = null) {
		$this->userId = $userId ?: get_current_user_id();
		$this->user   = $this->userId ? get_userdata($this->userId) ?: null : null;
	}

	public function getUserId(): ?int {
		return $this->userId;
	}

	public function getUser(): ?\WP_User {
		return $this->user;
	}

	public function getUserDisplayName(): string {
		return $this->user ? $this->user->display_name : '';
	}

	/**
	 * Normaliza arrays de enlaces de ACF a un formato seguro y estandarizado.
	 *
	 * @param array|null $link
	 * @return array{url: string, title: string, target: string}
	 */
	public static function parseAcfLink(?array $link): array {
		if (empty($link) || !is_array($link)) {
			return ['url' => '', 'title' => '', 'target' => '_self'];
		}

		return [
			'url'    => esc_url($link['url'] ?? ''),
			'title'  => esc_html($link['title'] ?? ''),
			'target' => !empty($link['target']) ? esc_attr($link['target']) : '_self',
		];
	}

	/**
	 * Extrae la URL de imagen o fallback seguro.
	 *
	 * @param array|int|string|null $image
	 * @param string $size
	 * @return string
	 */
	public static function getImageUrl($image, string $size = 'full'): string {
		if (is_array($image) && !empty($image['url'])) {
			return esc_url($image['sizes'][$size] ?? $image['url']);
		}
		if (is_numeric($image)) {
			$src = wp_get_attachment_image_url((int) $image, $size);
			return $src ? esc_url($src) : '';
		}
		if (is_string($image) && filter_var($image, FILTER_VALIDATE_URL)) {
			return esc_url($image);
		}
		return '';
	}
}

