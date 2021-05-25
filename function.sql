--FUNKCJE------------------------------------

create or replace NONEDITIONABLE function login(a in varchar2, b in varchar2)
return varchar2
as
  dopasowania number;
begin
  select count(*)
    into dopasowania
    from klienci
    where email=a
    and haslo=b;
  if dopasowania = 0 then
    return 'bad';
  elsif dopasowania = 1 then
    return 'zalogowano';
  else
    return 'za_duzo';
  end if;
end;

----------

reate or replace NONEDITIONABLE function checkBeforeRegister(a in klienci.email%type)
return varchar2
as
  dopasowania number;
begin
  select count(*)
    into dopasowania
    from klienci
    where email=a;
    return dopasowania;
end;

----------

create or replace NONEDITIONABLE function adminLogin(a in varchar2, b in varchar2)
return varchar2
as
  dopasowania number;
begin
  select count(*)
    into dopasowania
    from Administratorzy
    where email=a
    and haslo=b;
  if dopasowania = 0 then
    return 'bad';
  else
    return 'zalogowano';
  end if;
end;

----------

CREATE OR REPLACE NONEDITIONABLE FUNCTION dodaj_film(
    tytul in filmy.tytul%type,
    rezyser in filmy.rezyser%type,
    gatunek in filmy.gatunek%type,
    czas in filmy.czas_trwania%type
)
return varchar2
IS komunikat varchar2(10);
BEGIN
    DECLARE
        a integer := 0;
    BEGIN
        BEGIN
            SELECT MAX(id_filmu) INTO a FROM filmy;
            a := a+1;
            EXCEPTION
                WHEN NO_DATA_FOUND THEN
                a := 1;
        END;
        insert into filmy values(a, tytul, rezyser, gatunek, czas);
        komunikat := 'dodano';
        EXCEPTION
            WHEN OTHERS THEN
                komunikat := NULL;
    END;    
    return komunikat;
END;

----------

CREATE OR REPLACE NONEDITIONABLE FUNCTION dodaj_seans(
    nr in seanse.id_sali%type,
    ty in filmy.tytul%type,
    dzien in varchar2,
    godzina in seanse.godzina_rozpoczecia%type,
    cena_d in seanse.cena_biletu_dorosly%type,
    cena_u in seanse.cena_biletu_ulgowy%type,
    trzy_de in seanse.czy_seans_jest_w_3d%type,
    cena_sz in seanse.cena_dla_szkoly%type
)
return varchar2
IS komunikat varchar2(50);
BEGIN
    DECLARE
        a integer := 0;
        idFilm integer := 0;
    BEGIN
        begin
            komunikat := 'nie wykonano';
            select filmy.id_filmu into idFilm from filmy where filmy.tytul=ty;
            exception
                when OTHERS then
                    idFilm := NULL;
                    komunikat := 'blad_filmu';
        end;
        if idFilm > 0 then
            begin
                BEGIN
                    SELECT MAX(id_seansu) INTO a FROM seanse;
                    a := a+1;
                    EXCEPTION
                        WHEN NO_DATA_FOUND THEN
                        a := 1;
                END;
                insert into seanse values(a, nr, idFilm, to_date(dzien, 'dd/mm/yyyy'), godzina, cena_d, cena_u, trzy_de, cena_sz);
                komunikat := 'added';
                EXCEPTION
                    WHEN no_data_found THEN
                        komunikat := 'database_insert_error';
            end;
        end if;
    END;       
    return komunikat;
END;


-----------------------------


create or replace NONEDITIONABLE function usun_konto(a in klienci.email%type)
return varchar2
is
  res varchar2(10);
begin
    begin
        delete from klienci where a=email;
        res := 'deleted';
        exception
            when no_data_found then
            res := 'error';
    end;
    return res;
end;

----------

create or replace NONEDITIONABLE function zmien_haslo(
    a in klienci.email%type,
    b in klienci.haslo%type
)
return varchar2
is
  res varchar2(20);
begin
    begin
        update klienci set haslo=b where email=a;
        res := 'changed';
        exception
            when no_data_found then
            res := 'error';
    end;
    return res;
end;

----------

create or replace NONEDITIONABLE function zmien_imie(
    a in klienci.email%type,
    b in klienci.imie%type
)
return varchar2
is
  res varchar2(20);
begin
    begin
        update klienci set imie=b where email=a;
        res := 'changed';
        exception
            when no_data_found then
            res := 'error';
    end;
    return res;
end;

----------

create or replace NONEDITIONABLE function zmien_nazwisko(
    a in klienci.email%type,
    b in klienci.nazwisko%type
)
return varchar2
is
  res varchar2(20);
begin
    begin
        update klienci set nazwisko=b where email=a;
        res := 'changed';
        exception
            when no_data_found then
            res := 'error';
    end;
    return res;
end;

----------

create or replace NONEDITIONABLE function usun_klienta(a in klienci.email%type)
return varchar2
is
  res varchar2(20);
begin
    begin
        delete from klienci where email=a;
        res := 'deleted';
        exception
            when OTHERS then
            res := 'error';
    end;
    return res;
end;

-------------------

create or replace NONEDITIONABLE function pokaz_liczbe_miejsc(a in sale.nr_sali%type)
return number
is
  res number;
begin
    begin
        select liczba_miejsc into res from sale where nr_sali=a;
        exception
            when OTHERS then
            res := 'error';
    end;
    return res;
end;

create or replace NONEDITIONABLE function kup_bilet(
    email in zamowienia.email%type,
    ty in filmy.tytul%type,
    dz in varchar2,
    go in seanse.godzina_rozpoczecia%type,
    ids in seanse.id_sali%type
)
return varchar2
is
    res varchar2(10);
begin
    DECLARE
        idSeans integer := 0;
        idFilm integer := 0;
    BEGIN
        begin
            select filmy.id_filmu into idFilm from filmy where filmy.tytul=ty;
            exception
                when OTHERS then
                    idFilm := 0;
        end;
        if idFilm > 0 then
            begin
                BEGIN
                    SELECT seanse.id_seansu INTO idSeans FROM seanse
                    where seanse.id_filmu=idFilm and seanse.dzien=to_date(dz, 'dd-mm-yyyy') and seanse.godzina_rozpoczecia=go and seanse.id_sali=ids;
                    EXCEPTION
                        WHEN NO_DATA_FOUND THEN
                        idSeans := 0;
                END;
                if idSeans > 0 then
                    begin
                        open c4 for
                            select bilety.miejsce from bilety
                            inner join zamowienia
                            on bilety.id_biletu=zamowienia.id_biletu
                            where zamowienia.id_seansu=idSeans;
                        dbms_sql.return_result(c4); 
                    end;
                end if;
            end;
        end if;
    END;   
    return res;
end;

--PROCEDURY------------------------------------

create or replace NONEDITIONABLE PROCEDURE pokaz_seanse
AS
c1 SYS_REFCURSOR;
BEGIN
  open c1 for
    SELECT SEANSE.id_sali, FILMY.TYTUL, filmy.rezyser, to_char(SEANSE.dzien, 'DD-MM-YYYY'), seanse.godzina_rozpoczecia, SEANSE.czy_seans_jest_w_3d, seanse.cena_biletu_dorosly, seanse.cena_biletu_ulgowy, SEANSE.cena_dla_szkoly 
    FROM SEANSE
    inner join FILMY
    on SEANSE.id_filmu=FILMY.Id_filmu;
    DBMS_sql.return_result(c1);
END pokaz_seanse;

----------

create or replace NONEDITIONABLE PROCEDURE pokaz_uzytkownika(
    x in klienci.email%type,
    y in klienci.haslo%type)
as
c2 sys_refcursor;
BEGIN
    open c2 for
        select klienci.imie, klienci.nazwisko 
        from klienci 
        where klienci.email=x and klienci.haslo=y;
        dbms_sql.return_result(c2);
END pokaz_uzytkownika;

----------

create or replace NONEDITIONABLE PROCEDURE rejestracja(
    email in klienci.email%type,
    haslo in klienci.haslo%type, 
    imie in klienci.imie%type, 
    nazwisko in klienci.nazwisko%type)
IS
BEGIN
    INSERT INTO KLIENCI(email, haslo, imie, nazwisko) values (email, haslo, imie, nazwisko);
END rejestracja;

----------

create or replace NONEDITIONABLE PROCEDURE pokaz_bilety(
    x in klienci.email%type)
as
c3 sys_refcursor;
BEGIN
    open c3 for
        select bilety.id_biletu, bilety.miejsce, seanse.id_sali, seanse.dzien, seanse.godzina_rozpoczecia, seanse.czy_seans_jest_w_3d, filmy.tytul, filmy.rezyser, filmy.czas_trwania
        from bilety
        inner join zamowienia
        on bilety.id_biletu=zamowienia.id_biletu
        inner join seanse
        on zamowienia.id_seansu=seanse.id_seansu
        inner join filmy
        on seanse.id_filmu=filmy.id_filmu
        inner join klienci
        on zamowienia.email_klienta=klienci.email
        where klienci.email=x;
        dbms_sql.return_result(c3);
END pokaz_bilety;

----------

create or replace NONEDITIONABLE PROCEDURE nowe_zamowienie(
    miejsce in bilety.miejsce%type,
    email in klienci.email%type,
    seans in zamowienia.id_seansu%type)
IS
BEGIN
    DECLARE
        a INTEGER := 0;
    BEGIN
        BEGIN
            SELECT MAX(id_biletu) INTO a FROM bilety;
            a := a+1;
            EXCEPTION
                WHEN NO_DATA_FOUND THEN
                a := 1;
        END;
        INSERT INTO bilety(id_biletu, miejsce) values (a, miejsce);
        INSERT INTO zamowienia(email_klienta, id_seansu, id_biletu) values (email, seans, a);
    END;
END nowe_zamowienie;

----------

create or replace NONEDITIONABLE PROCEDURE pokaz_miejsca(
    ty in filmy.tytul%type,
    dz in varchar2,
    go in seanse.godzina_rozpoczecia%type,
    ids in seanse.id_sali%type
)
as
c4 sys_refcursor;
BEGIN
    DECLARE
        idSeans integer := 0;
        idFilm integer := 0;
    BEGIN
        begin
            select filmy.id_filmu into idFilm from filmy where filmy.tytul=ty;
            exception
                when OTHERS then
                    idFilm := 0;
        end;
        if idFilm > 0 then
            begin
                BEGIN
                    SELECT seanse.id_seansu INTO idSeans FROM seanse
                    where seanse.id_filmu=idFilm and seanse.dzien=to_date(dz, 'dd-mm-yyyy') and seanse.godzina_rozpoczecia=go and seanse.id_sali=ids;
                    EXCEPTION
                        WHEN NO_DATA_FOUND THEN
                        idSeans := 0;
                END;
                if idSeans > 0 then
                    begin
                        open c4 for
                            select bilety.miejsce from bilety
                            inner join zamowienia
                            on bilety.id_biletu=zamowienia.id_biletu
                            where zamowienia.id_seansu=idSeans;
                        dbms_sql.return_result(c4); 
                    end;
                end if;
            end;
        end if;
    END;   
END pokaz_miejsca;

--TESTOWE WYWOLANIA W PL/SQL--------------------------------

begin
  DECLARE a varchar2(40);
  begin
    a := dodaj_seans(1, 'Kiler', '03/06/2021', '13:30', 16, 14, 'NIE', 10);
    dbms_output.put_line(a);
  end;
end;

--------------------

begin
  DECLARE a varchar2(40);
  begin
    a := usun_konto('test@wp.pl');
    dbms_output.put_line(a);
  end;
end;

---------------
begin
  DECLARE a varchar2(40);
  begin
    a := zmien_nazwisko('Kowalski');
    dbms_output.put_line(a);
  end;
end;
