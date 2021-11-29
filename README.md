# SelectWizard

[![LGPLv3](https://img.shields.io/badge/license-LGPLv3-blue)](https://choosealicense.com/licenses/gpl-3.0/) [![PHP >7.4](https://img.shields.io/badge/PHP%3A-%20%3E7.2.0-blue)](https://www.php.net/downloads.php#v7.4.26) [![Contao >4.9](https://img.shields.io/badge/Contao%3A-%3E=%204.9.0-orange)](https://github.com/contao/contao/tree/4.9)

Es handelt sich bei dieser Erweiterung für das [Open Source CMS Contao](https://contao.org) um ein Backend Widget, das dem `listWizard` sehr ähnlich ist. Manchmal benötigt man eine Möglichkeit, den Nutzer aus einer bestimmten Anzahl von Optionen beliebig viele auswählen zu lassen. Diese Erweiterung stellt zu diesem Zweck das Widget `selectmenuWizard` zur Verfügung. Es handlet sich hierbei um eine variable Liste an Auswahlfeldern.

Die Erweiterung richtet sich an Entwickler, da die Felder im DCA definiert werden müssen. Es können die gängigen Einstellungen vorgenommen werden, die Contao für das DCA vorsieht.


## Voraussetzungen

- php: ^7.4||^8.0
- contao/core-bundle: ^4.9

## Installation

Einfach im __Contao Manager__ nach __SelectWizard__ suchen und installieren.


## Getting Started

### Beispielkonfiguration

```php
<?php
// YOUR_EXTENSION/Resources/contao/dca/tl_demotable.php

/* set table name */
$table = 'tl_demotable';

/* palettes */
$GLOBALS['TL_DCA'][$table]['palettes']['default'] = '{testfield_legend},testfield;';

/* field */
$GLOBALS['TL_DCA'][$table]['fields']['testfield'] = [
    'label'     => &$GLOBALS['TL_LANG'][$table]['testfield'],
    'inputType' => 'selectmenuwizard',
    'options'   => [1 => 'Test 001', 2 => 'Test 002'],
    'eval'      => ['tl_class'=>'w50', 'includeBlankOption'=>true],
    'sql'       => 'text NOT NULL'
];
```

__Einschränkungen:__

- `submitOnChange` funktioniert nicht, macht aber auch wenig Sinn, da dies hauptsächliche für Subpaletten o.ä. wichtig ist. Diese können hier aber nicht verwendet werden, da es nicht nur einen Wert gibt.

### Ausgabe

![Ausgabe](https://github.com/eS-IT/selectwizard/blob/master/selectboxwizard_output.png?raw=true "Ausgabe")


## Running the tests

Im Verzeichnis der Erweiterung folgendes aufrufen:

```bash
$> build/runtest.sh
```


## Autor

__e@sy Solutions IT:__ Patrick Froch <info@easySolutionsIT.de>


## Lizenz

This project is licensed under the LGPLv3 License - see the `LICENSE` file for details
