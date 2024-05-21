<?php
/**
* UltimateXnova
* basato su 2moons di Jan-Otto Kröpke 2009-2016
 *
 * Per informazioni complete su copyright e licenza, consultare la LICENZA
 *
 * @pacchetto UltimateXnova
 * @autore Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Fortunato
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2022 Koray Karakuş <koraykarakus@yahoo.com>
 * @copyright 2024 Pfahli (https://github.com/Pfahli)
 * @licenza MIT
 * @versione 1.8.x Koray Karakuş <koraykarakus@yahoo.com>
 * @link https://github.com/ultimateXnova/ultimateXnova
 */

// Tradotto in inglese da QwataKayean. Tutti i diritti invertiti (C) 2012
// 2Moons - Copyright (C) 2010-2012 Schiavista



$LNG['indietro'] = 'Indietro';
$LNG['continue'] = 'Continua';
$LNG['continueUpgrade'] = 'Aggiorna!';
$LNG['login'] = 'Accedi';

$LNG['menu_intro'] = 'Introduzione';
$LNG['menu_install'] = 'Installazione';
$LNG['menu_license'] = 'Licenza';
$LNG['menu_upgrade'] = 'Aggiorna';

$LNG['title_install'] = 'Installazione';

$LNG['intro_lang'] = 'Lingua';
$LNG['intro_install'] = 'All'installazione';
$LNG['intro_welcome'] = 'Ciao utente di UltimateXnova!';
$LNG['intro_text'] = 'Questo gioco è basato su SteemNova, che è stato il successore di 2Moons e ha avuto origine in XNova<br><br>Il sistema di installazione ti guiderà attraverso l'installazione o l'aggiornamento da una versione precedente a quella più recente uno. Ogni domanda, un problema, non esitare a chiedere al nostro sviluppo e supporto in caso di dubbio!<br><br>UltimateXnova è un progetto Open Source, concesso in licenza con GNU GPL v3. Per verificarlo, fare clic sul collegamento sopra dove si riferisce alla "licenza"<br><br>Prima dell'installazione è possibile avviare un piccolo test per vedere se il proprio piano/dominio ha tutti i requisiti per supportare UltimateXnova';
$LNG['intro_upgrade_head'] = 'ultimateXnova già installato?';
$LNG['intro_upgrade_text'] = '<p>Hai già installato UltimateXnova e desideri un aggiornamento semplice?</p><p>Qui puoi aggiornare il tuo vecchio database con pochi clic!</p>';


$LNG['upgrade_success'] = 'Aggiornamento del database riuscito. Il database è ora disponibile nella revisione %s.';
$LNG['upgrade_nothingtodo'] = 'Non è richiesta alcuna azione. Il database è già aggiornato alla revisione %s.';
$LNG['upgrade_back'] = 'Indietro';
$LNG['upgrade_intro_welcome'] = 'Benvenuti nell'aggiornamento del database!';
$LNG['upgrade_available'] = 'Aggiornamenti disponibili per il tuo database! Il database è alla revisione %se può essere aggiornato alla revisione %s.<br><br>Scegli dal seguente menu il primo aggiornamento SQL da installare:';
$LNG['upgrade_notavailable'] = 'La revisione utilizzata %s è la più recente per il tuo database.';
$LNG['upgrade_required_rev'] = 'L'Updater può funzionare solo dalla revisione r2579 (ultimateXnova v1. 7) o successiva.';


$LNG['licence_head'] = 'Termini di licenza';
$LNG['licence_desc'] = 'Leggi i termini di licenza riportati di seguito. Utilizza la barra di scorrimento per vedere tutto il contenuto del documento';
$LNG['licence_accept'] = 'Per continuare l'installazione di UltimateXnova, è necessario accettare i termini e le condizioni di licenza di UltimateXnova';
$LNG['licence_need_accept'] = 'Se desideri continuare con l'installazione, accetterai i termini della licenza';

$LNG['req_head'] = 'Requisiti di sistema';
$LNG['req_desc'] = 'Prima di procedere con l'installazione, UltimateXnova eseguirà alcuni test per verificare che il tuo server supporti UltimateXnova, quindi assicurati che UltimateXnova possa essere installato. Si consiglia di leggere attentamente i risultati e di non procedere finché non saranno stati tutti controllati.';
$LNG['reg_yes'] = 'Sì';
$LNG['reg_no'] = 'No';
$LNG['reg_found'] = 'Trovato';
$LNG['reg_not_found'] = 'Non trovato';
$LNG['reg_writable'] = 'Registrabile';
$LNG['reg_not_writable'] = 'Non registrabile';
$LNG['reg_file'] = 'Il file &raquo;%s&laquo; È registrabile?';
$LNG['reg_dir'] = 'La cartella &raquo;%s&laquo; È registrabile?';
$LNG['req_php_need'] = 'Versione installata del linguaggio di scripting &raquo;PHP&laquo;';
$LNG['req_php_need_desc'] = '<strong>Obbligatorio</strong> — PHP è il codice base del linguaggio di UltimateXnova. Questa è la versione PHP 5.2.5 o successiva richiesta affinché tutti i moduli funzionino correttamente';
$LNG['reg_gd_need'] = 'Versione installata dello script GD PHP &raquo;gdlib&laquo;';
$LNG['reg_gd_desc'] = '<strong>Facoltativo</strong> — Libreria di elaborazione grafica &raquo;gdlib&laquo; È responsabile della generazione di immagini dinamiche. Funzionano senza alcune funzionalità del software.';
$LNG['reg_json_need'] = 'Estensione &raquo;JSON&laquo; disponibile?';
$LNG['reg_iniset_need'] = 'Funzione PHP &raquo;ini_set&laquo; disponibile?';
$LNG['reg_global_need'] = 'register_global disabilitati?';
$LNG['reg_global_desc'] = 'ultimateXnova funzionerà anche se questa configurazione è installata sul tuo server. Tuttavia, per motivi di sicurezza, si consiglia di disabilitare "register_globals" nell'installazione di PHP, se possibile.';
$LNG['req_ftp_head'] = 'Inserisci informazioni su FTP';
$LNG['req_ftp_desc'] = 'Scrivi le tue informazioniinformazioni da FTP in modo che UltimateXnova risolva automaticamente i problemi. In alternativa, puoi anche assegnare manualmente i permessi di scrittura.';
$LNG['req_ftp_host'] = 'Nome host';
$LNG['req_ftp_username'] = 'Nome utente';
$LNG['req_ftp_password'] = 'Password';
$LNG['req_ftp_dir'] = 'Directory di UltimateXnova';
$LNG['req_ftp_send'] = 'Invia';
$LNG['req_ftp_error_data'] = 'Le informazioni fornite non ti consentono di connetterti al server FTP, quindi questo collegamento non è riuscito';
$LNG['req_ftp_error_dir'] = 'La storia nella directory che hai inserito non è valida o non esiste';
$LNG['reg_pdo_active'] = 'Supporta &raquo;PDO&laquo; Estensione';
$LNG['reg_pdo_desc'] = '<strong>Prerequisito</strong> — È necessario fornire il supporto per PDO in PHP.';

$LNG['step1_head'] = 'Configura il database di installazione';
$LNG['step1_desc'] = 'Ora che è stato stabilito che UltimateXnova può essere installato sul tuo server, i s dovrebbero fornire alcune informazioni. Se non sai come eseguire un database di collegamenti, contatta prima il tuo provider di hosting o il forum UltimateXnova per aiuto e supporto. Quando hai inserito i dati i controlli sono stati introdotti correttamente';
$LNG['step1_mysql_server'] = 'Server database o DSN';
$LNG['step1_mysql_port'] = 'Porta del database';
$LNG['step1_mysql_dbuser'] = 'Utente del database';
$LNG['step1_mysql_dbpass'] = 'Password del database';
$LNG['step1_mysql_dbname'] = 'Nome database';
$LNG['step1_mysql_prefix'] = 'Prefisso tabella:';

$LNG['step2_prefix_invalid'] = 'Il prefisso del database deve contenere caratteri alfanumerici e un trattino basso come ultimo carattere';
$LNG['step2_db_no_dbname'] = 'Non hai specificato il nome per il database';
$LNG['step2_db_too_long'] = 'Il prefisso della tabella è troppo lungo. Deve contenere al massimo 36 caratteri';
$LNG['step2_db_con_fail'] = 'C'è un errore nel collegamento al database. I dettagli verranno visualizzati di seguito';
$LNG['step2_conf_op_fail'] = "config.php non può essere scritto!";
$LNG['step2_conf_create'] = 'config.php creato con successo!';
$LNG['step2_config_exists'] = 'config.php esiste già!';
$LNG['step2_db_done'] = 'La connessione al database ha avuto successo!';

$LNG['step3_head'] = 'Crea tabelle di database';
$LNG['step3_desc'] = 'Le tabelle necessarie per il database lastXnova sono già state create e popolate con valori predefiniti. Per passare allo step successivo concludere l'installazione di latestXnova';
$LNG['step3_db_error'] = 'Impossibile creare le tabelle del database:';

$LNG['step4_head'] = 'Account amministratore';
$LNG['step4_desc'] = 'La procedura guidata di installazione creerà ora un account amministratore per te. Scrivi il nome utente, la tua password e la tua email';
$LNG['step4_admin_name'] = 'Utilizza il nome dell'amministratore:';
$LNG['step4_admin_name_desc'] = 'Digita il nome da utilizzare con una lunghezza compresa tra 3 e 20 caratteri';
$LNG['step4_admin_pass'] = 'Password dell'amministratore:';
$LNG['step4_admin_pass_desc'] = 'Digita una password con una lunghezza da 6 a 30 caratteri';
$LNG['step4_admin_mail'] = 'E-mail di contatto:';

$LNG['step6_head'] = 'Installazione completata!';
$LNG['step6_desc'] = 'Hai installato con successo il sistema UltimateXnova';
$LNG['step6_info_head'] = 'Ottieni e usa UltimateXnova adesso!';
$LNG['step6_info_additional'] = 'Se si fa clic sul pulsante in basso, verranno reindirizzati alla pagina di amministrazione. L'AI sarà un buon vantaggio per ottenere aree per esplorare gli strumenti di amministrazione di UltimateXnova.<br/><br/><strong >Elimina la sezione &raquo;include/ENABLE_INSTALL_TOOL&laquo; o modificare il nome del file. Con l'esistenza di questo file puoi mettere a rischio il tuo gioco permettendo a qualcuno di riscrivere l'installazione!</strong>';

$LNG['step8_need_fields'] = 'Devi compilare tutti i campi.';


$LNG['sql_close_reason'] = 'Il gioco è chiuso';
$LNG['sql_welcome'] = 'Benvenuti in UltimateXnova v';
