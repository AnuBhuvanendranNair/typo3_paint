..  include:: /Includes.rst.txt

..  _introduction:

============
Introduction
============

..  _what-it-does:

What does it do?
================

TYPO3 v14 ships with the backend themes *Fresh*, *Modern* and *Classic*.
Their colors are fixed. TYPO3 Paint adds settings to change the main colors
of the backend, for example to match a corporate design or to tell several
installations apart (development, staging, production) at a glance.

The settings apply to the whole installation and to all backend users,
independent of the theme each user selected.

..  _features:

Features
========

*   Primary color: buttons, links, focus and active states. In the *Fresh*
    theme the top bar and the module menu are derived from it.
*   Secondary color and icon accent color.
*   Background and text color of the top bar and of the module menu.
*   Tinting: how strongly grey surfaces and state colors (success, info,
    warning, danger) pick up the primary color.
*   Every setting is optional. An empty setting keeps the theme default.
*   Works in the backend shell, in all module iframes, on the login page and
    in the link and element browsers.
*   No influence on the frontend.

..  _requirements:

Requirements
============

*   TYPO3 14.3 or higher (14.x)
