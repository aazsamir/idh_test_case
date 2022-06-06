## IDH Test Case

Projekt napisany jest w Laravelu, wersja 9, który korzysta z PHP wersji 8.0.2 lub wyższej.

Struktura MVC frameworku składa się z:

-   Kontrolerów
-   Modeli
-   Widoków

Jednak zostało to rozszerzone o:

-   Repozytoria
-   Serwisy (tu akurat bardzo, bardzo prosty, do wysyłania maili)
-   Stałe (a dokładniej Enumy)

## CRUD

Jest to prosty CRUD, z endpointami:

-   [GET] /products
-   [GET] /products/{id}
-   [POST] /products
-   [PUT] /products/{id}
-   [DELETE] /products/{id}

## Autoryzacja

Aplikacja posiada prostą autoryzację poprzez Bearer Token (zaszyty w configu, `idh_test_case`).

## Konwencja

-   MVC
-   Repository Pattern
-   CQS (choć przyznam, mam parę wątpliwości co do jego zastosowania przeze mnie)
-   REST API
-   Dependency Injection (w przypadku korzystania z Fasad, nie wynika ono wprost np. DB::class)
-   Zgodnie z standardem PSR, nazwy klas to UpperCamelCase, nazwy metod to lowerCamelCase
-   Standard PSR nie standaryzuje nazewnictwa zmiennych, tylko mówi o tym by wszędzie była ta sama konwencja, więc w całym projekcie występuje snake_case
-   Brak tzw. magic numbers, są zaszyte w konfiguracji, konstruktorach, etc.

## Testy

Zostało napisanych parę testów, sprawdzają tylko czy endpointy działają poprawnie. (choć 100% coverage to nie jest)

## Środowisko

Aby uruchomić aplikację, należy wykonać polecenia:

-   `composer install`
-   `php artisan migrate`
-   `php artisan db:seed`
-   `php artisan serve`

Aby przetestować

-   `php artisan test`

## Autor

Autorem jest Samir Al-Azazi. Jeśli gdzieś w projekcie występuje błąd, jest niespójny z przyjętą konwencją, albo zastosowałem coś niezgodnego z sztuką - mój błąd, z chęcią dowiem się jak to robić lepiej.
