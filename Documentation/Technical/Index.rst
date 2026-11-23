..  include:: /Includes.rst.txt

..  _technical:

====================
Technical background
====================

..  _technical-how:

How it works
============

An event listener for the PSR-14 event
:php:`\TYPO3\CMS\Core\Page\Event\BeforeStylesheetsRenderingEvent` adds one
inline :html:`<style>` block to every backend document. The block only
contains CSS custom properties built from the configured values, for example:

..  code-block:: css

    html:root{--token-color-primary-base:#205eb5}

The TYPO3 backend CSS derives shades, tints and theme-specific colors from
these base properties. The extension does not ship its own stylesheet.

..  _technical-properties:

CSS custom properties
=====================

==========================  ==========================================
Setting                     CSS custom property
==========================  ==========================================
``primaryColor``            ``--token-color-primary-base``
``secondaryColor``          ``--token-color-secondary-base``
``iconAccentColor``         ``--typo3-icons-accent``
``headerBackgroundColor``   ``--typo3-scaffold-header-bg``
``headerTextColor``         ``--typo3-scaffold-header-color``
``sidebarBackgroundColor``  ``--typo3-scaffold-sidebar-bg``
``sidebarTextColor``        ``--typo3-scaffold-sidebar-color``
``neutralMix``              ``--typo3-color-neutral-mix``
``stateHarmonize``          ``--typo3-color-state-harmonize``
==========================  ==========================================

The selector :css:`html:root` is more specific than the theme selectors
(:css:`:root`, :css:`[data-theme=fresh]`, :css:`[data-theme=classic]`), so
the configured values win over all core themes.

..  _technical-security:

Security
========

*   Only hexadecimal colors and whole numbers from 0 to 100 are accepted.
    All other values are ignored, so no CSS can be injected through the
    configuration.
*   The :html:`<style>` block is registered with the ``csp`` option, so TYPO3
    adds a nonce for the Content Security Policy.
*   The listener only runs for backend requests. The frontend is not
    affected.
