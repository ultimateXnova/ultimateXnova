# Welcome to ultimateXnova

ultimateXnova is an open-source browser-based space exploration and conquest game. It provides a platform for players to build and manage their own interstellar empires, engage in diplomacy and warfare with other players, and explore the vastness of space.

#New Theme

* Introducing a brand new design called "Office". This Design is based on Teams to blend more fluidly into an office environment. By reducing visual clutter to a minimum and using a similiar styling, it is easier to play in public without other people noticing.
 
![Screenshot](screenshots/office-v1.png)

This game is based on SteemNova 1.8.

For more information about SteemNova 1.8, you can visit the official repository on GitHub: [SteemNova 1.8 Repository](https://github.com/koraykarakus/steemnova-1.8-x)

What is done so far ?

GENERAL

* Updated for PHP 8.2

* Smarty 4.3.0 version update

INSTALL ISSUES

* BBCodeParser2 was causing problems at the stage of install, wrong url links of BBCodeParser2 is corrected

* BBCodeParser2 problems on Tickets page corrected, tickets working efficiently

LOGIN & REGISTER

* Login system changed, now users login with email instead of username

* Recaptcha is updated to new version

* Login and register systems now uses recaptcha if captcha is activated from admin panel

* Register links on Index page corrected

* Some visual corrections for register page

* Manual stats page on admin panel was not reporting stats update time for languages Tr and Fr, these language files corrected

* new javascript added for login and register pages to avoid form submit on page refresh

* login and systems are changed to support AJAX submit

* Bootstrap 5 - responsive login & register pages are generated

* csrf token is added for login & register forms

* added remember me option for login



ADMIN

* steem connect removed from admin login page

* includes/pages/adm converted from mysqli (old database) to new database ( PDO )

* bug fix: ShowAccountEditorPage - removing buildings from planets, avoid negative level for buildings

* bug fix: ShowAccountEditorPage - removing buildings from planets, avoid negative level for planet fields

* bug fix: ShowAccountEditorPage - removing ships from planets, avoid negative number of ships

* bug fix: ShowAccountEditorPage - removing defence units from planets, avoid negative number of defences units

* bug fix: ShowAccountEditorPage - removing research levels from planets, avoid negative number of research

* bug fix: ShowAccountEditorPage - removing resources from planets, avoid negative number of resources

* bug fix: ShowAccountEditorPage - removing darkmatter from users, avoid negative number of dark matter

* Added an option to activate and deactivate recaptcha for login and register pages separately

* Added an ability to chose current theme from admin panel , nova, gow, epic blue, DEFAULT_THEME constant removed, theme class changed

* Added a search bar for admin panel

* added options whether to show buildings, research, and ships if technology is not accessible
(unlearned ships, buildings and research can be made visible from admin panel)


INGAME

* A bug in alliance page is fixed caused by BBCode

* bugs caused by page.error.default.tpl fixed

* Theme update: Epic Blue XIII buildings page is updated and visual problems solved

* Theme update: Epic Blue XIII research page is updated and visual problems solved

* Theme update: Epic Blue XIII shipyard page is updated and visual problems solved

* Theme update:Epic Blue XIII technologies page is updated and visual problems solved

* forum and discord pages now can be removed from admin panel / modules page

* Theme update: Galaxy of Wars overview page is updated and visual problems solved

* Theme update: Galaxy of Wars buildings page is updated and visual problems solved

* Theme update: Galaxy of Wars research page is updated and visual problems solved

* Theme update: Galaxy of Wars shipyard page is updated and visual problems solved

* Theme update:Galaxy of Wars technologies page is updated and visual problems solved

* Galaxy page change with keyboard stroke is possible, Galaxy page refresh does not show form submit alert

* Bug fix : MissionCaseSpy can be used in all themes

* visual bug fixed related to body length for Epic Blue XIII Theme

* StatBanner problems solved

* A limit is set for number of notes of a user, this limit can be changed from admin panel

* Fixed a bug which prevents displaying alliance applications

* active color for current page on menu, GOW theme
