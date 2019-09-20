# [Płatności Online BM](https://platnosci.bm.pl/)

Biblioteka integracyjna do systemu Płatności online BM

## Wymagania

1. PHP od wersji 7.0
2. Wymagane rozszeżenia:
    - xmlwriter
    - xmlreader
    - iconv
    - mbstring
    - hash
    - cURL


## Instalacja

### Composer

Zalecanym sposobem instalacji za pośrednictwem [Composer](http://getcomposer.org).

1. [Zainstaluj Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. Aby zainstalować "Płatności Online BM" wraz z zależnościami, uruchom Composer w głównym katalogu "Płatności Online BM":

```bash
composer.phar install
```

3. Po zainstalowaniu, w projekcie należy załadować autoloader Composer:

```php
require 'vendor/autoload.php';
```

Można potem aktualizować "Płatności Online BM" za pomocą Composer:

```bash
composer.phar update blue-media/online-payments
```

## Dokumentacja

1. Strona informacyjna [Płatności Online BM](https://platnosci.bm.pl/)
2. [Przykłady użycia](examples)
3. [Specyfikacja](docs/System_platnosci_online_obsluga_transakcji_2.3.2.pdf)
