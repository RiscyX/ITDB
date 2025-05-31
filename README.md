# ITDB – Videojáték Webshop

## Telepítés
1. Másold a projektet a webszerver (pl. XAMPP) `htdocs` mappájába.
2. Importáld a `db.sql`-t a phpMyAdmin-ban vagy MySQL-ben.
3. Állítsd be a `config/db_config.php`-ban az adatbázis elérést.
4. Az admin felülethez állíts be .htaccess + .htpasswd védelmet az `admin/` mappában.

## Fő funkciók
- Publikus webshop: játékok listázása, keresés, kosár, rendelés.
- Admin: CRUD a játékokra, rendelések megtekintése.
- Saját CSS, reszponzív design.

## Fájlstruktúra
Lásd a projektmappát és a Task.md-t.

## Fejlesztői követelmények
- PHP 8+, MySQL, Apache
- Nincs CSS framework, minden stílus saját.

## Elérhetőségek
- Főoldal: `/public/index.php`
- Admin: `/admin/index.php`
