..  include:: /Includes.rst.txt

..  _known-problems:

==============
Known problems
==============

Backend CSS is internal API
===========================

The TYPO3 core considers the backend CSS framework internal API (see the
changelog of TYPO3 14.0, *Feature: #108240 - Introduce Fresh theme*). The CSS
custom properties used by this extension can change in any TYPO3 release.
Check the backend appearance after every TYPO3 update.

Changes need a full reload
==========================

The colors are added when a backend document is loaded. After saving the
extension configuration, reload the whole backend in the browser.

Primary color lightness is ignored
==================================

The core derives the primary shades and the *Fresh* top bar and module menu
from hue and saturation only. See :confval:`typo3-paint-primarycolor`.

Workspace colors
================

The colored workspace bar at the top is not controlled by this extension. The
Live workspace is always red. Other workspaces use the color set in their
workspace record.
