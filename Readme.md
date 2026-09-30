# 🍽️ Recenzie obedov

Webová aplikácia na prehliadanie jedální a obedov, hodnotenie jedál a zdieľanie recenzií. Používatelia si vytvoria účet, prihlásia sa osobným číslom alebo školským e-mailom a môžu spravovať vlastné recenzie v profile.

## 🚀 Funkcie

* **Jedálne:** Zobrazenie názvov a adries jedální uložených v databáze.
* **Obedy a recenzie:** Zoznam obedov zoradený podľa priemerného hodnotenia, vyhľadávanie podľa názvu a zobrazenie recenzií ku konkrétnemu obedu.
* **Pridanie recenzie:** Prihlásený používateľ vyhľadá obed, ohodnotí ho od 1 do 5 hviezdičiek a napíše recenziu s dĺžkou aspoň 20 znakov. Každý používateľ môže pridať jednu recenziu ku každému obedu.
* **Profil:** Zobrazenie údajov používateľa, zmena hesla, vyhľadávanie vlastných recenzií a ich odstránenie.
* **Účet:** Registrácia kontroluje formát osobného čísla a hesla. Heslá sa ukladajú pomocou PHP `password_hash()`.

## 🛠️ Použité technológie

* **Backend:** PHP a rozšírenie MySQLi
* **Databáza:** MySQL alebo MariaDB
* **Frontend:** HTML a CSS

## 📐 Databáza

Aplikácia používa databázu `recenze_obedu` so štyrmi tabuľkami:

* `menza` obsahuje názov a adresu jedálne.
* `obedy` obsahuje názov a dátum obeda, priemerné hodnotenie a odkaz na jedáleň.
* `users` obsahuje prihlasovacie údaje a profil používateľa.
* `recenze` spája používateľa s obedom a ukladá text, počet hviezdičiek a dátum recenzie.

Priemerné hodnotenie v tabuľke `obedy` sa prepočíta po pridaní recenzie. Väzby medzi tabuľkami sú definované cudzími kľúčmi.

## 📥 Inštalácia a spustenie

1. Umiestnite projekt do priečinka `htdocs` v XAMPP a spustite Apache a MySQL.
2. V MySQL vytvorte databázu s názvom `recenze_obedu`.
3. Cez HeidiSQL alebo phpMyAdmin vyberte túto databázu a importujte súbor `ostatni/TvorbaTabulek_mysql.sql`.
4. Skontrolujte prihlasovacie údaje a názov databázy v `php_skripty/connection.php`. Predvolené nastavenie používa `localhost`, používateľa `root`, prázdne heslo a databázu `recenze_obedu`.
5. Vložte do tabuliek `menza` a `obedy` údaje, ktoré sa majú zobrazovať. Bez obedov nebude možné pridávať recenzie.
6. Otvorte aplikáciu na `http://localhost/VejskaProjekt/` a vytvorte si účet cez registráciu.

Súbor `ostatni/Tabulky (funkční kód).sql` je starší návrh pre PostgreSQL a nie je určený na import do MySQL/MariaDB aplikácie.

## 📂 Štruktúra projektu

* `index.php`, `login.php`, `register.php`, `profil.php` a stránky s prehľadmi tvoria používateľské rozhranie.
* `recenze_form.php` vyhľadáva obedy a zobrazuje formulár na pridanie recenzie.
* `php_skripty/` obsahuje pripojenie k databáze, prihlásenie, registráciu, odhlásenie a operácie s recenziami.
* `style.css` obsahuje štýly stránok.
* `ostatni/` obsahuje SQL skripty a pomocné projektové materiály.
