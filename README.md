# Symfony_project
# Instalacja na serwerze
- Tworzymy folder, w którym będziemy przetrzymywali naszą aplikację: 'Symfony'
- Usuwamy plik .env.local
- W pliku .env ustawiamy paramtetry dostępowe do bazy danych,
- W katalogu app/public tworzymy plik .htaccess o następującej zawartości:
```text
<IfModule mod_rewrite.c>
    Options -MultiViews
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /index.php/
    </IfModule>
</IfModule>
```
- W katalogu projektu (/app) wykonujemy:
```text
composer install
composer update
```
w przypadku problemów patrz w sekcja "Ogólne"
- nadajemy uprawnienia folderom vendor oraz var
```text
chmod 777 vendor
chmod 77 var
```
- W katalogu projektu na serwerze (w public_html) wykonujemy link symboliczny do naszej aplikacji:
```text
ln -s ~/Symfony/app/public SymfonyProject
```
- ładujemy migracje bazodanowe i zapełniamy bazę danych losowymi danymi:
```text
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
#Uruchamianie lokalne
- W pliku .env.local ustawiamy paramtetry dostępowe do bazy danych,
- Jeżeli nie mamy zainstalowanego composera, to w katalogu projektu (/app) wykonujemy:
```text
composer install
```
jeżeli jednak mamy to:
```text
composer update
```
- ładujemy migracje bazodanowe i zapełniamy bazę danych losowymi danymi:
```text
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
!Ważne jest, aby usunąć wczesniej wszystkie instniejące migracje i bazy danych, które mogłyby wpływać na działanie aplikacji.
Aby to uczynić wykonujemy:
```text
bin/console doctrine:schema:drop --force
bin/console doctrine:query:sql "TRUNCATE TABLE migration_versions"
```
następnie fizycznie usuwamy migracje z folderu /app/migrations i wykonujemy:
```text
bin/console make:migration
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
```
#Ogólne
 W przypadku ewentualnych problemów przy komendzie "composer update" należy zakomentować w pliku /app/config/packages/doctrine.migrations.yaml:
 ```yaml
doctrine_migrations:
    dir_name: '%kernel.project_dir%/src/Migrations'
    # namespace is arbitrary but should be different from App\Migrations
    # as migrations classes should NOT be autoloaded
    namespace: DoctrineMigrations
```
i odkomentować:
```yaml
#    doctrine_migrations:
#        migrations_paths:
#            'DoctrineMigrations': '%kernel.project_dir%/src/Migrations'
```
w przypadku problemów z "composer install" postapić odwrotnie.