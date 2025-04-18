CREATE TABLE "obedy" (
  "obed_id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "nazev_obedu" varchar,
  "datum_vydani" date,
  "hodnoceni" float,
  "menza_id" integer,
  "cas_vyhodnoceni" timestamp
);

CREATE TABLE "menza" (
  "menza_id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "nazev" varchar,
  "adresa" varchar
);

CREATE TABLE "users" (
  "user_id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "osobni_cislo" varchar UNIQUE NOT NULL,
  "skolni_email" varchar UNIQUE,
  "heslo" varchar NOT NULL,
  "avatar" image,
  "jmeno" varchar,
  "prijmeni" varchar,
  "role" varchar,
  "created_at" timestamp,
  "last_login" timestamp,
  "is_admin" bool
);

CREATE TABLE "recenze" (
  "recenze_id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "user_id" integer,
  "id_obedu" integer,
  "text_recenze" text,
  "hodnoceni" integer,
  "created_at" timestamp
);

ALTER TABLE "menza" ADD CONSTRAINT "obed_menza" FOREIGN KEY ("menza_id") REFERENCES "obedy" ("menza_id");

ALTER TABLE "users" ADD CONSTRAINT "user_recenze" FOREIGN KEY ("user_id") REFERENCES "recenze" ("user_id");

ALTER TABLE "obedy" ADD CONSTRAINT "obedy_recenze" FOREIGN KEY ("obed_id") REFERENCES "recenze" ("id_obedu");
