..  include:: /Includes.rst.txt

..  _installation:

============
Installation
============

Install the extension with Composer:

..  code-block:: bash

    composer require anubit/typo3-paint

Then set up the extension and flush the caches:

..  code-block:: bash

    vendor/bin/typo3 extension:setup -e typo3_paint
    vendor/bin/typo3 cache:flush

The extension does not change anything until at least one color is
configured, see :ref:`configuration`.
