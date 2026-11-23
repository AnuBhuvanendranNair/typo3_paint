<?php

declare(strict_types=1);

namespace AnuBit\Typo3Paint\EventListener;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Page\Event\BeforeStylesheetsRenderingEvent;

/**
 * Injects configured backend colors as CSS custom properties into every
 * backend document (shell, module iframes, login, link/element browser).
 *
 * Core derives shades, tints and theme-specific scaffold colors from these
 * base tokens. Note: the backend CSS variables are internal API (see core
 * changelog 14.0 Feature-108240) and may change with core updates.
 */
#[AsEventListener(identifier: 'typo3-paint/inject-colors')]
final readonly class InjectBackendThemeColors
{
    private const EXTENSION_KEY = 'typo3_paint';

    /**
     * Configuration key => CSS custom property, applied on the root element.
     */
    private const ROOT_COLOR_PROPERTIES = [
        'primaryColor' => '--token-color-primary-base',
        'secondaryColor' => '--token-color-secondary-base',
        'headerBackgroundColor' => '--typo3-scaffold-header-bg',
        'headerTextColor' => '--typo3-scaffold-header-color',
        'sidebarBackgroundColor' => '--typo3-scaffold-sidebar-bg',
        'sidebarTextColor' => '--typo3-scaffold-sidebar-color',
    ];

    private const ROOT_PERCENT_PROPERTIES = [
        'neutralMix' => '--typo3-color-neutral-mix',
        'stateHarmonize' => '--typo3-color-state-harmonize',
    ];

    public function __construct(
        private ExtensionConfiguration $extensionConfiguration,
    ) {}

    public function __invoke(BeforeStylesheetsRenderingEvent $event): void
    {
        // Event is dispatched 4x per page (inline/file x priority/normal) - act once
        if (!$event->isInline() || !$event->isPriority()) {
            return;
        }
        $request = $GLOBALS['TYPO3_REQUEST'] ?? null;
        if (!$request instanceof ServerRequestInterface
            || !ApplicationType::fromRequest($request)->isBackend()
        ) {
            return;
        }

        $css = $this->buildCss($this->getConfiguration());
        if ($css === '') {
            return;
        }
        $event->getAssetCollector()->addInlineStyleSheet(
            'typo3-paint-colors',
            $css,
            [],
            ['priority' => true, 'csp' => true]
        );
    }

    /**
     * @param array<string, mixed> $configuration
     */
    private function buildCss(array $configuration): string
    {
        $rootDeclarations = [];
        foreach (self::ROOT_COLOR_PROPERTIES as $key => $property) {
            $color = $this->sanitizeColor($configuration[$key] ?? '');
            if ($color !== null) {
                $rootDeclarations[] = $property . ':' . $color;
            }
        }
        foreach (self::ROOT_PERCENT_PROPERTIES as $key => $property) {
            $percent = $this->sanitizePercent($configuration[$key] ?? '');
            if ($percent !== null) {
                $rootDeclarations[] = $property . ':' . $percent . '%';
            }
        }

        $css = '';
        // html:root (0,1,1) beats :root and [data-theme=fresh|classic] (0,1,0)
        if ($rootDeclarations !== []) {
            $css .= 'html:root{' . implode(';', $rootDeclarations) . '}';
        }
        // Icon accent: core sets it on :root (modern/classic) and on
        // [data-theme=fresh] .scaffold-sidebar (0,2,0), so override both levels
        $iconAccent = $this->sanitizeColor($configuration['iconAccentColor'] ?? '');
        if ($iconAccent !== null) {
            $css .= 'html:root,html:root .scaffold-sidebar{--typo3-icons-accent:' . $iconAccent . '}';
        }
        return $css;
    }

    /**
     * Only hex colors are accepted to prevent CSS injection.
     */
    private function sanitizeColor(mixed $value): ?string
    {
        $value = trim((string)$value);
        return preg_match('/^#(?:[0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/i', $value) === 1 ? $value : null;
    }

    private function sanitizePercent(mixed $value): ?int
    {
        $value = trim((string)$value);
        if ($value === '' || !ctype_digit($value)) {
            return null;
        }
        $percent = (int)$value;
        return $percent <= 100 ? $percent : null;
    }

    /**
     * @return array<string, mixed>
     */
    private function getConfiguration(): array
    {
        try {
            $configuration = $this->extensionConfiguration->get(self::EXTENSION_KEY);
        } catch (\Throwable) {
            return [];
        }
        return is_array($configuration) ? $configuration : [];
    }
}
