# 🍽️ Systém na hodnotenie a prehľadávanie jedál v menze

Semestrálny projekt do predmetu Databázové systémy. Cieľom projektu je navrhnúť a implementovať relačnú databázu, ktorá umožňuje študentom a zamestnancom prehliadať denné menu, vyhľadávať jedlá podľa rôznych kritérií a pridávať recenzie.

## 🚀 Hlavné funkcie

* **Prehľad menu:** Zobrazovanie aktuálnej ponuky jedál pre konkrétne dni a menzy.
* **Pokročilé vyhľadávanie:** Filtrovanie jedál podľa kategórií (polievky, hlavné jedlá, dezerty), ceny, alergénov a priemerného hodnotenia.
* **Hodnotenie a recenzie:** Používatelia môžu jedlá hodnotiť hviezdičkami (1-5) a pridávať textové komentáre.
* **Štatistiky pre jedálne:** Prehľad najlepšie hodnotených jedál a vyťaženia menzy v jednotlivých dňoch.

## 🛠️ Použité technológie

* **Databáza:** PostgreSQL / MySQL (doplň podľa seba)
* **Jazyk:** SQL (DDL pre tvorbu tabuliek, DML pre prácu s dátami)
* **Voliteľné (Backend/Frontend):** napr. Python (Flask/FastAPI), Node.js, PHP

## 📐 Návrh databázy (ERD)

Databáza pozostáva z nasledujúcich hlavných entít:
* `Pouzivatel` (študenti, zamestnanci, administrátori)
* `Menza` (zoznam jedální v rámci univerzity)
* `Jedlo` (názov, cena, kategória, alergény)
* `DenneMenu` (prepojovacia tabuľka pre priradenie jedál ku dňom a menzám)
* `Hodnotenie` (recenzie, hviezdičky, časový údaj)

*(Sem môžeš vložiť odkaz na obrázok ER diagramu, napr.: `![ERD Diagram](docs/erd_diagram.png)`)*

## 📥 Inštalácia a spustenie

1. **Klonovanie repozitára:**
   ```bash
   git clone https://github.com
   cd projekt-menza
   ```

2. **Vytvorenie databázy a import dát:**
   Prihláste sa do svojho databázového nástroja a spustite SQL skripty v tomto poradí:
   ```bash
   psql -U pouzivatel -d databaza -f sql/schema.sql  # Vytvorenie tabuliek
   psql -U pouzivatel -d databaza -f sql/seeds.sql   # Import testovacích dát
   ```

## 📊 Ukážky SQL dopytov

### 1. Zobrazenie top 5 najlepšie hodnotených jedál
```sql
SELECT j.nazov, ROUND(AVG(h.skore), 2) AS priemerne_hodnotenie
FROM Jedlo j
JOIN Hodnotenie h ON j.id = h.jedlo_id
GROUP BY j.id, j.nazov
ORDER BY priemerne_hodnotenie DESC
LIMIT 5;
```

### 2. Vyhľadanie jedál bez obsahu lepku (alergén č. 1)
```sql
SELECT nazov, cena 
FROM Jedlo 
WHERE allergen_mask NOT LIKE '%1%';
```

## 👥 Autori

* **Tvoje Meno** - *Návrh DB, SQL dopyty, Optimalizácia* - [Môj GitHub](https://github.com)
