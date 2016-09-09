# AMM2015
Progetto fine corso amm 2015

# PROGETTO AMM 2015 #

### DESCRIZIONE DELL'APPLICAZIONE ###

Guitar Bazar è un sito web d'esempio che permette di eseguire alcune funzionalità presenti nei mercatini di strumenti usati online.
Un utente, dopo essersi registrato al sito,  potrà inserire annunci di vendita di una o più chitarre oppure, sfogliando gli annunci, potrà cercarne e acquistarne. Gli amministratori potranno visualizzare gli annunci oppure visualizzare gli utenti registrati ed eliminarli dal sistema (se necessario).
L'acquisto verrà effettuato tramite una transazione e, dopo di essa, l'annuncio verrà rimosto dalla lista degli annunci e potrà essere visualizzato solo dal venditore e dall'acquirente nell'apposita sezione.
Ci sono pochissimi controlli sull'input dell'utente e dunque, eseguendo le prove bisogna cercare di imettere dati del giusto tipo a seconda del campo.

### STRUTTURA DELL'APPLICAZIONE ###

Il database dell'applicazione è stato progettato con tre tabelle, nel seguente modo : 

-UTENTE: contiene le informazioni base (e anche alcune che alla fine non sono state utilizzate) degli utenti e consente di
         tenere le informazioni di login

-INSERZIONE: contiene le inserzioni inserite dagli utenti e i dettagli dello strumento in vendida. Tramite i campi acquirente e              data_acquisto consente di risalire alla disponibilità e a chi ha acquistato lo strumento.

Utilizzo del pattern MVC : Ci sono varie viste a seconda della pagina richiesta per la parte front-end, 3 controller per direzionare le scelte, uno per l'utente, uno per l'amministartore e uno per le scelte in comune e 3 modelli per eseguire i cambi di stato derivati dai tre controller e per modellare gli oggetti che compongono il sistema. 

- modelSession: contiene le funzioni comuni a tutti i tipi di utenza (login, logout, listaStrumenti .....)
- modelUser: contiene le funzioni eseguibili dall'utente base
- modelAmm : contiene le funzioni dell'amministratore

L'amministratore può : 
- Visualizzare le inserzioni degli utenti
- Visulaizzare gli utenti registrati
- Eliminare un utente

L'utente base loggato puo:
- Visualizzare la lista delle inserzioni 
- Aprire i dettagli di un inserzione (cliccando sul nome)
- Inserire un inserzione di vendita
- Acquistare uno strumento passando dalla pagina di dettagli dell'inserzione
- Modificare il proprio profilo

L'utente generico non loggato puo:
- Registrarsi al sito
- Effettuare il login


### SPECIFICHE RISPETTATE ###
     1.Utilizzo di HTML e CSS: Si, l'html è stato utilizzato per le viste e il file css per stilizzarle.
     2. Utilizzo di PHP e MySQL : Si, per la creazione del controller, dei modelli e un pò nelle viste. MySQL è stato
        utilizzato nei modelli.
     3. Utilizzo del pattern MVC : Si, viste per la parte front-end, controller per direzionare le scelte utente e modelli per    eseguire i cambi di stato e per modellare gli oggetti che compongono il sistema.  
     4. Almeno due ruoli : Si, utente e amministratore.
     5. Almeno una transazione : Si, quando si modifica lo stato del DB (ad esempio quando si conferma l'acquisto).

 
### CREDENZIALI ###

Per l'autenticazione, le credenziali degli utenti che son già creati sono : 
  1. AMMINISTRATORE --> Nome utente: admin     Password: administrator
  2. Utente1 ---> Nome utente: enricocortes    Password: enricocortespass
  3. Utente2 ---> Nome utente: italo.oberti    Password: italoobertipass

E' possibile creare nuovi utenti, per far si che essi accedano al sito, tramite il form di registrazione oppure popolando la tabella utente del database.

Il link alla homepage è il seguente : http://spano.sc.unica.it/amm2015/cortesEnrico/
