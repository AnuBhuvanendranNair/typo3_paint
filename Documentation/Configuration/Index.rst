..  include:: /Includes.rst.txt

..  _configuration:

=============
Configuration
=============

All settings are made in :guilabel:`Admin Tools > Settings >
Extension Configuration > typo3_paint`. The settings are grouped in the tabs
:guilabel:`Colors`, :guilabel:`Header & Sidebar` and :guilabel:`Tinting`.

..  important::

    After saving, reload the whole backend in the browser (for example
    :kbd:`F5`). The backend frame around the modules is not reloaded
    automatically.

Every setting is optional. Leave a setting empty to keep the default of the
active theme. Colors must be hexadecimal values (for example ``#205eb5``).
Invalid values are ignored.

The settings can also be set in :file:`config/system/settings.php` or
:file:`config/system/additional.php`:

..  code-block:: php
    :caption: config/system/additional.php

    $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['typo3_paint']['primaryColor'] = '#205eb5';

..  _configuration-colors:

Colors
======

..  confval-menu::
    :name: confval-colors
    :display: table
    :type:
    :default:

..  confval:: primaryColor
    :name: typo3-paint-primarycolor
    :type: color
    :default: (empty)

    Main accent color for buttons, links, focus and active states. All shades
    of the primary color are derived from it. In the *Fresh* theme the top bar
    and the module menu are derived from it as well.

    ..  note::

        Only hue and saturation of this color are used. The lightness is set
        by the theme. Two colors with the same hue therefore look nearly the
        same. To get an exact color in the top bar or module menu, use
        :confval:`typo3-paint-headerbackgroundcolor` and
        :confval:`typo3-paint-sidebarbackgroundcolor`.

..  confval:: secondaryColor
    :name: typo3-paint-secondarycolor
    :type: color
    :default: (empty)

    Color of secondary buttons and badges. Empty: derived from the primary
    color by the theme.

..  confval:: iconAccentColor
    :name: typo3-paint-iconaccentcolor
    :type: color
    :default: (empty)

    Accent part of the core icons, including the icons in the module menu.

..  _configuration-scaffold:

Header & Sidebar
================

..  confval-menu::
    :name: confval-scaffold
    :display: table
    :type:
    :default:

..  confval:: headerBackgroundColor
    :name: typo3-paint-headerbackgroundcolor
    :type: color
    :default: (empty)

    Background of the top bar. Used exactly as entered.

..  confval:: headerTextColor
    :name: typo3-paint-headertextcolor
    :type: color
    :default: (empty)

    Text and icon color in the top bar. Choose a color with enough contrast
    to the background.

..  confval:: sidebarBackgroundColor
    :name: typo3-paint-sidebarbackgroundcolor
    :type: color
    :default: (empty)

    Background of the module menu on the left. Used exactly as entered.

..  confval:: sidebarTextColor
    :name: typo3-paint-sidebartextcolor
    :type: color
    :default: (empty)

    Text color in the module menu. Choose a color with enough contrast to the
    background.

..  _configuration-tinting:

Tinting
=======

..  confval-menu::
    :name: confval-tinting
    :display: table
    :type:
    :default:

..  confval:: neutralMix
    :name: typo3-paint-neutralmix
    :type: int (0-100)
    :default: (empty)

    How strongly grey surfaces pick up the primary color, in percent.
    Theme defaults: *Modern* 8, *Fresh* 12, *Classic* 0.

..  confval:: stateHarmonize
    :name: typo3-paint-stateharmonize
    :type: int (0-100)
    :default: (empty)

    How strongly the state colors (success, info, warning, danger, notice)
    pick up the primary color, in percent.
    Theme defaults: *Modern* and *Fresh* 5, *Classic* 0.
