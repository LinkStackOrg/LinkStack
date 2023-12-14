<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Hemsida
    |--------------------------------------------------------------------------
    |
    | resources/views/home.blade.php
    |
    */

    'Log in' => 'Logga in',
    'Register' => 'Registrera',

    'Dashboard' => 'Panel',
    'Copyright' => 'Upphovsrätt',
    'Made with' => 'Skapad med',
    'by' => 'av',

    'HOME.MESSAGE' => '
    <p>Få grepp om din onlineprofil med&nbsp;<a href="https://linkstack.org/"><strong>LinkStack</strong></a>,
     en <strong>länkplattform</strong> med integritet och öppen källkod. Skapa en anpassningsbar profil för att hantera <strong>
     dina viktigaste länkar på ett och samma ställe</strong> och ge din omgivning en sömlös surfupplevelse.</p>
     ',


    /*
    |--------------------------------------------------------------------------
    | Demosida/Hemsidoexempel
    |--------------------------------------------------------------------------
    |
    | resources/views/demo.blade.php
    |
    */
    
    'Example page' => 'Exempelsida',


    /*
    |--------------------------------------------------------------------------
    | Verifikationssidor
    |--------------------------------------------------------------------------
    |
    | Inlogg, registration, glömt lösenord etc.
    | Detta inkluderar verifikationsmail som lösenåterställning och mailbekräftelse.
    | resources/views/auth
    |
    */

    # Inloggningssida
    'Sign In' => 'Logga in',
    'Login to stay connected' => 'Logga in för att hålla dig uppkopplad',
    'Email' => 'Email',
    'Password' => 'Lösenord',
    'Remember Me' => 'Kom ihåg mig',
    'Forgot Password?' => 'Glömt Lösenord?',
    'or sign in with other accounts?' => 'eller logga in med andra konton?',
    'Don’t have an account?' => 'Har du inget konto?',
    'Click here to sign up' => 'Klicka här för att registrera dig',


    # Återställ Lösenord
    'Forgot your password?' => 'Glömt ditt lösenord?',
    'No problem' => 'Inga problem. Ange din mailadress så skickar vi en länk för att återställa ditt lösenord.',
    'Email Password Reset Link' => 'Maila Lösenordsåterställning',


    # Registreringssida
    'Sign Up' => 'Registrera',
    'Register to stay connected' => 'Registrera dig för att hålla dig uppkopplad',
    'Display Name' => 'Visningsnamn',
    'Confirm Password' => 'Bekräfta lösenord',
    'Already have an account?' => 'Har du redan ett konto?',
    'Click here to sign in' => 'Klicka här för att logga in',


    # Väntar verifikation från admin
    'Verification Status' => 'Verifieringsstatus',
    'auth_pending' => 'itt konto väntar fortfarande på verifiering',
    'auth_unverified' => 'Ditt konto är för närvarande overifierat och kräver manuell verifiering av en administratör.',
    'Log out' => 'Logga ut',


    # Lösenordsbekräftelse
    'auth_password' => 'Detta är ett säkert område av applikationen. Vänligen bekräfta ditt lösenord innan du fortsätter.',
    'Confirm' => 'Bekräfta',


    # Lösenordsåterställning
    'Reset Password' => 'Återställ lösenord',
    'Enter a new password' => 'Ange ett nytt lösenord',


    # Testa e-mail
    'Test E-Mail' => 'Testa E-Mail',


    # Registreringsnotis via mail
    'A new user has registered on' => 'En ny användare har registrerat sig på',
    'and is awaiting verification' => 'och väntar på verifiering',
    'The user' => 'Användaren',
    'with the email' => 'med mailadressen',
    'has registered a new account on' => 'har registrerat ett nytt konto på',
    'and is awaiting confirmation by an admin' => 'och väntar på bekräftelse från en administratör.',
    'Click' => 'Klicka',
    'here' => 'här',
    'to verify the user' => 'för att verifiera användaren.',
    'Manage Users' => 'Hantera användare',


    # Maila bekräftelsemail
    'auth_thanks' => 'Tack för att du registrerade dig! Innan du börjar, kan du verifiera din e-mailadress genom att klicka på länken vi just skickade till dig via e-mail? Om du inte har fått e-mailmeddelandet skickar vi gärna ett till. Om du inte ser e-mailmeddelandet inom några minuter, kontrollera din skräppost.',
    'auth_verification' => 'En ny bekräftelselänk har skickats till mailadressen du angav under registreringen.',
    'Resend Verification Email' => 'Skicka verifieringsmail igen',


    /*
    |--------------------------------------------------------------------------
    | Anpassning Sidofält
    |--------------------------------------------------------------------------
    |
    | resources/views/layouts/sidebar.blade.php
    |
    */

    'Settings' => 'Inställningar',
    'Scheme' => 'Schema',
    'Auto' => 'Auto',
    'Dark' => 'Mörkt',
    'Light' => 'Ljust',
    'Color Customizer' => 'Färganpassare',
    'Sidebar Color' => 'Färg på Sidofältet',
    'Default' => 'Standard',
    'Color' => 'Färg',
    'Transparent' => 'Genomskinlig',
    'Sidebar Types' => 'Typer av Sidofält',
    'Mini' => 'Mini',
    'Hover' => 'Sväva',
    'Boxed' => 'Boxad',
    'Sidebar Active Style' => 'Aktiv stil i sidofältet',
    'Rounded One Side' => 'Rundad på en sida',
    'Rounded All' => 'Rundad på alla sidor',
    'Pill One Side' => 'Piller på en sida',
    'Pill All' => 'Piller på alla sidor',


    /*
    |--------------------------------------------------------------------------
    | Anpassning
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/site.blade.php
    |
    */

    'Home' => 'Hem',
    'Add Link' => 'Lägg till länk',
    'Administration' => 'Administration',
    'Admin' => 'Admin',
    'Config' => 'Konfiguration',
    'Footer Pages' => 'Sidfötter',
    'Site Customization' => 'Webbplatsanpassning',
    'Site Logo' => 'Webbplatsens logga',
    'Personalization' => 'Anpassning',
    'Links' => 'Länkar',
    'Appearance' => 'Utseende',
    'Themes' => 'Teman',
    'Site logo' => 'Webbplatsens logga',
    'Favicon' => 'Favicon',
    'Home message' => 'Hemmedelande',


    /*
    |--------------------------------------------------------------------------
    | Navbar
    |--------------------------------------------------------------------------
    |
    | resources/views/layouts/sidebar.blade.php
    |
    */
    
    'View Page' => 'Visa Sida',
    'Share your profile' => 'Dela din profil',
    'Share your profile:' => 'Dela din profil:',
    'Error sharing:' => 'Fel vid delning:',
    'Text copied to clipboard!' => 'Text kopierad till urklipp!',
    'Error copying text:' => 'Fel vid kopiering av text:',
    'QR Code' => 'QR-kod',
    'Scan QR Code' => 'Skanna QR-kod',
    'QR code could not be generated' => 'QR-kod kunde inte skapas',
    'Reason:' => 'Anledning:',

    # QR-kod-meny
    'Close' => 'Stäng',
    'Dismiss' => 'Avvisa',
    
    # Notis-meny
    'All Notifications' => 'Alla Notiser',

    # Uppdateringsmeny
    'Updater' => 'Uppdaterare',
    'Beta Mode' => 'Beta-läge',
    'Local version' => 'Lokal version',
    'Latest beta' => 'Senaste beta',
    'Run updater' => 'Kör uppdaterare',
    'Update available' => 'Uppdatering tillgänglig',
    'Up to date' => 'Senaste version installerad',
    'Check again' => 'Kontrollera igen',

    # Användarsektion i navbar
    'Administrator' => 'Administratör',
    'Verified user' => 'Verifierad användare',
    'User' => 'Användare',
    'Profile' => 'Profil',
    'Styling' => 'Formgivning',
    'Logout' => 'Logga ut',


    /*
    |--------------------------------------------------------------------------
    | Panelsida
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/index.blade.php
    |
    */

    # Header med bild
    'Hi' => 'Hej',
    'stranger' => 'främling',
    'welcome' => 'Välkommen till :appName!',
    'Set a handle' => 'Ställ in användarnamn',

    # Panelsida
    'Total Links:' => 'Totalt antal länkar:',
    'Link Clicks:' => 'Länkklick:',
    'View/Edit Links' => 'Visa/Redigera Länkar',
    'Top Links:' => 'Topplänkar:',
    'You haven’t added any links yet' => 'Du har inte lagt till några länkar än.',
    'clicks' => 'klick',
    'Clicks' => 'Klick',
    'Site statistics:' => 'Sidostatistik:',
    'Total links' => 'Totalt antal länkar',
    'Total clicks' => 'Antal klick',
    'Total users' => 'Totalt antal användare',
    'Registrations:' => 'Registrationer:',
    'Last 30 days' => 'Sista 30 dagarna',
    'Last 7 days' => 'Sista 7 dagarna',
    'Last 24 hours' => 'Sista 24 timmarna',
    'Active users:' => 'Aktiva användare:',
    
    

    /*
    |--------------------------------------------------------------------------
    | Knappredigerare
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/button-editor.blade.php
    |
    */

    'Button Editor' => 'Knappredigerare',
    'Back' => 'Tillbaka',
    'Custom Button' => 'Egenanpassad Knapp',
    'CSS' => 'CSS',
    'background' => 'bakgrund',
    'gradient' => 'övertoning',
    'Show CSS' => 'Visa CSS',
    'Custom CSS' => 'Egen CSS',
    'Save' => 'Spara',
    'Reset to default' => 'Återställ till standard',
    'Result' => 'Resultat:',
    'Custom Icon' => 'Anpassad Ikon',
    'Custom Alert' => 'Din anpassade ikons shortcode innehåller inte "fa-". Använd alltid ikoner i följande format: fa-ghost, till exempel.',
    'cb.description.1-4' => 'Anpassade ikoner kan tillämpas knappar via Font Awesome. Du kan använda vilken ikon du vill från listan nedan, du kan nå den här listan genom att klicka på "Se alla ikoner"-knappen. Varje ikon på den listan har en shortcode, som du kan klistra in i "Anpassad Ikon"-fältet.',
    'cb.description.2-4' => 'Varje ikons shortcode består av ett prefix och en huvuddel. Om shortcoden inte representerar ett märke, så kan du skriva koden i följande format: fa-ikon-namn. Formatteringen "fa-..." har betydelse. Till exempel "fa-kod".',
    'cb.description.3-4' => 'Om shortcoden representerar ett märke, så är det viktigt att inkludera "fab" som prefix. "fa-..."-formatteringen gäller fortfarande här. Till exempel, "fab fa-github"',
    'cb.description.4-4' => 'För att tillämpa färg till dina ikoner, så kan du enkelt fylla i färgnamnet eller HEX-värdet innan ikonen, följt av ";". Det är viktigt att färgen definieras innan ikonen. Färgkoden måste avslutas med semikolon.<br>En lista med tillgängliga färger finns <a href="https://www.w3schools.com/cssref/css_colors.asp" target="_blank">här</a>.',
    'Style' => 'Stil',
    'Prefix' => 'Prefix',
    'Icon' => 'Ikon',
    'Short Code' => 'Shortcode',
    'Regular' => 'Standard',
    'Brands' => 'Märken',
    'Color name' => 'färg_namn',
    'Color HEX' => 'Färg HEX',
    'Color HEX1' => 'Färg HEX',
    'Update icon' => 'Uppdatera ikon',
    'See all icons' => 'Se alla ikoner',


    /*
    |--------------------------------------------------------------------------
    | Ändra länksida
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/edit-link.blade.php
    |
    */

    'Edit' => 'Redigera',
    'Add' => 'Lägg till',
    'Block' => 'Block',
    'Blocks' => 'Block: ',
    'Select Block' => 'Välj Block ',
    'Toggle Dropdown' => 'Växla Meny',
    'Cancel' => 'Avbryt',
    'Save and Add More' => 'Spara och lägg till fler',
    'Click to change link blocks' => 'Klicka för att ändra länkblock',
    'Click for a list of available link blocks' => 'Klicka för en lista med tillgängliga länkblock',


    /*
    |--------------------------------------------------------------------------
    | Länksida
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/links.blade.php
    |
    */

    'My Links' => 'Mina Länkar',
    'Add new Link' => 'Lägg till ny Länk',
    'No Link Added' => 'Du har inte lagt till några länkar än.',
    'Download' => 'Ladda ner',
    'Preview' => ' Förhandsvisning:',
    'No compatible browser' => 'Din webbläsare är ej kompatibel',
    'Page Icons' => 'Sidikoner',
    'Save links' => 'Spara länkar',

    # Tooltips
    'Customize' => 'Anpassa',
    'Delete' => 'Radera',
    'Clear icon cache' => 'Rensa cacheminne för ikoner',
    
    'confirm_delete' => 'Är du säker på att du vill radera :title?',


    /*
    |--------------------------------------------------------------------------
    | "Min Profil"/Utseendesida
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/page.blade.php
    |
    */

    'My Profile'=> 'Min Profil',
    'Profile Picture' => 'Profilbild',
    'Page URL' => 'Sido-URL',
    'Display name' => 'Visningsnamn',
    'Name:' => 'Namn:',
    'Page Description' => 'Sidobeskrivning',
    'Show checkmark' => 'Visa verifieringsbock',
    'disableverified' => 'Du är en verifierad användare. Med den här inställningen kan du dölja din verifieringsbock.',
    'Show share button' => 'Visa delningsknapp',
    'disablesharebutton' => 'Med den här inställningen kan du dölja knappen för att dela din profil.',


    /*
    |--------------------------------------------------------------------------
    | Personlig inställningssida
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/profile.blade.php
    |
    */

    'Account Settings' => 'Kontoinställningar',
    'Change email' => 'Ändra email',
    'Change password' => 'Ändra lösenord',
    'Export user data' => 'Exportera användardata',
    'Export your user data' => 'Exportera din användardata för att föra över till en annan instans.',
    'Export all data' => 'Exportera all data',
    'Export links only' => 'Exportera enbart länkar',
    'Import user data' => 'Importera användardata',
    'import.user.alert' => 'Är du säker på att du vill importera den här filen? Detta kommer att ersätta all nuvarande data, inklusive länkar!',
    'Import your user data from another instance' => 'Importera din användardata från en annan instans.',
    'Import' => 'Importera',
    'Delete your account' => 'Radera ditt konto',
    'You are about to delete' => 'Du är på väg att radera ditt konto!',
    'You are about to delete This action cannot be undone' => 'Du är på väg att radera ditt konto! Det är en permanent ändring och går ej att återställa.',
    'Delete account' => 'Radera konto',

    # Alerts
    'Profile updated successfully!' => 'Profilen uppdaterades!',
    'An error occurred while updating your profile.' => 'Ett fel uppstod medans din profil uppdaterades.',

    'That handle has already been taken' => 'Det angivna användarnamnet är upptaget.',
    'The selected file must be an image' => 'Den valda filen måste bestå av en bild.',
    'The image must be' => 'Bilden måste:',
    'The image size should not exceed 2MB' => 'Bildstorleken bör ej överskrida 2MB.',
    'Please select an image' => 'Vänligen välj en bild.',

    /*
    |--------------------------------------------------------------------------
    | Tema-anpassningssida
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/theme.blade.php
    |
    */

    'Select a theme' => 'Välj ett tema',
    'Select theme' => 'Välj tema',
    'Custom background' => 'Egen bakgrund',
    'No image selected' => 'Ingen bild vald',
    'Remove background' => 'Radera bakgrund',
    'Manage themes' => 'Hantera teman',
    'Loading...' => 'Laddar...',
    'Upload themes' => 'Ladda upp teman',
    'Delete themes' => 'Radera teman',
    'Download themes' => 'Ladda ner teman',
    'Delete a theme' => 'Radera ett tema',


    /*
    |--------------------------------------------------------------------------
    | Temauppdaterare
    |--------------------------------------------------------------------------
    |
    | resources/views/studio/theme-updater.blade.php
    |
    */

    'Theme Updater' => 'Temauppdaterare',
    'Theme name' => 'Temanamn:',
    'Update status' => 'Uppdateringsstatus:',
    'Version' => 'Version:',
    'Error!' => 'Fel!',
    'Update manually' => 'Uppdatera manuellt',
    'Update all themes' => 'Uppdatera alla teman',


    /*
    |--------------------------------------------------------------------------
    | Hantera Användare
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/edit-user.blade.php
    |
    */
    
    'Edit User' => 'Redigera Användare',
    'Logo' => 'Logga',
    'Page description' => 'Sidbeskrivning',
    'Role' => 'Roll',


    /*
    |--------------------------------------------------------------------------
    | Länksida
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/links.blade.php
    |
    */

    'Title' => 'Titel',


    /*
    |--------------------------------------------------------------------------
    | Länksida (Admin)
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/links.blade.php
    |
    */

    'Link' => 'Länk',


    /*
    |--------------------------------------------------------------------------
    | PHP info-sida
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/phpinfo.blade.php
    |
    */

    'Information about PHP’s configuration' => 'Information om PHP:s konfiguration',
    'Outputs information about the current state of PHP' => 'Visar information om PHP:s nuvarande tillstånd',


    /*
    |--------------------------------------------------------------------------
    | Radera teman
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/theme.blade.php
    |
    */

    'Delete theme' => 'Radera tema',


    /*
    |--------------------------------------------------------------------------
    | Hantera Användare
    |--------------------------------------------------------------------------
    |
    | resources/views/panel/users.blade.php
    |
    */

    'Users:' => 'Användare:',
    'Search user' => 'Sök användare',
    'ID' => 'ID',
    'Name' => 'Namn',
    'E-Mail' => 'E-Mail',
    'Page' => 'Sida',
    'Created at' => 'Skapad',
    'Last seen' => 'Senast sedd',
    'Status' => 'Status',
    'Action' => 'Handling',
    'N/A' => 'Otillgänglig',
    'Pending' => 'Väntar',
    'Verified' => 'Verifierad',
    'Approved' => 'Godkänd',
    'Add new user' => 'Lägg till ny användare',

    # Tooltips
    'tt.Delete' => 'Radera',
    'tt.Impersonate' => 'Imitera',
    'tt.Edit' => 'Redigera',
    'tt.All links' => 'Alla länkar',

    'confirm.delete.user' => 'Är du säker på att du vill ta bort den här användaren? \nDetta är permanent!',

    # Datumformat
    'date.format' => 'd/m/Å',

    'days ago' => 'dagar sedan',
    '1 day ago' => '1 dag sedan',
    'Today' => 'Idag',
    '1 year ago' => '1 år sedan',
    'years ago' => 'år sedan',


    /*
    |--------------------------------------------------------------------------
    | Konfigurationssida
    |--------------------------------------------------------------------------
    |
    | resources/views/components/config/
    | resources/views/panel/config-editor.blade.php
    |
    */

    'Advanced Config' => 'Avancerad Konfiguration',
    'Take Backup' => 'Skapa Backup',
    'All Backups' => 'Alla Backups',
    'Diagnosis' => 'Diagnos',

    'Alternative Config Editor' => 'Alternativ Konfigurationsredigerare',
    'Use the Alternative Config Editor to edit the config directly' => 'Använd den Alternativa Konfigurationsredigeraren för att redigera konfigurationen direkt',

    'PHP info' => 'PHP info',
    'Display debugging information about your PHP setup' => 'Visa felsökningsinformation om din PHP-instans',

    'Jump directly to:' => 'Hoppa direkt till:',

    'Application' => 'Applikation',
    'Panel settings' => 'Panelinställningar',
    'Security' => 'Säkerhet',
    'Advanced' => 'Avancerat',
    'SMTP' => 'SMTP',
    'Footer links' => 'Sidfotslänkar',
    'Debug' => 'Felsök',
    'Language' => 'Språk',

    'default' => 'standard',
    'Apply' => 'Verkställ',

    'AC.description' => 'Tillåter redigering av webbplatsens frontsystem. Bl.a. tillåter den här filen redigering av: Hemsida, länkar, titlar, Google Analytics och meta-taggar.',
    'Advanced Configuration file.' => 'Avancerad konfigurationsfil.',
    'Restore defaults' => 'Återställ till standard',

    'Backup' => 'Backup',
    'You can back up your entire instance:' => 'Du kan skapa en backup av hela din instans:',
    'The backup system won’t save more than two backups at a time' => 'Backupsystemet sparar ej fler än två backups åt gången.',
    'Backup Instance' => 'Skapa Backup av Instans',

    'wtrue' => 'Allt fungerar som avsett!',
    'wfalse' => 'Den här filen kan ej skrivas till. Detta kan förhindra normal drift.',
    'utrue' => 'En säkerhetsrisk har upptäckts. Den här filen kan nås av utomstående. Omedelbar handling krävs!',
    'ufalse' => 'Allt fungerar som avsett!',
    'unull' => 'Något gick fel. Detta kan vara normalt om instansen ligger bakom en proxy eller en docker-container.',
    'Debugging information' => 'Felsökningsinformation',
    'security.risk' => 'En säkerhetsrisk har upptäckts. Den här filen kan nås av utomstående. Omedelbar handling krävs! Klicka på detta meddelande för mer information.',
    'security.risk.1-3' => 'Här kan du enkelt kontrollera om kritiska systemfiler kan nås av utomstående. Det är viktigt att ingen utomstående kan nå filerna, annars kan användardata som lösenord läckas. Fält markerade med ett',
    'security.risk.2-3' => 'kan ej nås av utomstående, fält markerade med ett',
    'security.risk.3-3' => 'kan nås av vem som helst och kräver omedelbar handling för att skydda din data.',
    'Hover for more' => 'Sväva för mer',
    'Write access' => 'Skrivåtkomst',
    'Write access.description.1-3' => 'Här kan du enkelt kontrollera om viktiga systemfiler har skrivåtkomst. Detta är viktigt för att alla funktioner ska fungera som tänkt. Fält markerade med ett',
    'Write access.description.2-3' => 'fungerar som avsett, fält markerade med ett',
    'Write access.description.3-3' => 'fungerar inte som avsett.',
    'File' => 'Fil',
    'Dependencies' => '',
    'Required PHP modules' => 'Obligatoriska PHP-moduler.',
    'PHP Extension' => 'PHP-tillägg',
    'No backups found' => 'Ingen backup hittad',
    'Backup your instance' => 'Skapa Backup av din instans',

    'Go back' => 'Gå tillbaka',

    'Strings with a # in front of them are comments and wont affect anything' => 'Teckensträngar med # framför dem är kommentarer och påverkar ingenting.',

    'Download your updater backups:' => 'Ladda ner backups från uppdateraren:',
    'The server will never store more that two backups at a time' => 'Servern lagrar aldrig fler än två backups åt gången.',

    'SMTP.title' => 'Använd inbyggd SMTP-server',
    'SMTP.description' => 'Använder LinkStacks egna SMTP-server. Är ej nödvändigtvis 100% pålitlig. Måste inaktiveras för att använda en egen SMTP-server.',
    'SMTP.description.alt' => '(Spara ändringar med "Verkställ ändringar" nedan)',
    'Enable' => 'Aktivera',
    'Custom SMTP server:' => 'Egen SMTP-server:',
    'Host' => 'Värd',
    'Port' => 'Port',
    'Username' => 'Användarnamn',
    'Encryption type' => 'Krypteringstyp',
    'From address' => 'Från-adress',
    'Apply changes' => 'Verkställ ändringar',
    'Test E-Mail setup:' => 'Testa E-Mail-konfiguration:',
    'Send Test E-Mail' => 'Skicka Testmail',

    'Debug.title' => 'Felsökningsläge',
    'Debug.description' => 'Bör inaktiveras i produktion. Användbar vid felsökning under uppstart.',

    'DISPLAY_FOOTER_HOME.title' => 'Sidfotslänk hemsida',
    'DISPLAY_FOOTER_HOME.description' => 'Aktivera sidfot på hemsidan.',
    'REGISTER_AUTH.title' => 'Aktivera mailverifikation',
    'REGISTER_AUTH.description' => 'Avgör om användare måste bekräfta sin email när de registrerar sig.',
    'ALLOW_REGISTRATION.title' => 'Aktivera registrering',
    'ALLOW_REGISTRATION.description' => 'Avgör om användare kan registrera sig till din instans.',
    'NOTIFY_EVENTS.title' => 'Notis vid händelser',
    'NOTIFY_EVENTS.description' => 'Visar en notis när något händer.',
    'NOTIFY_UPDATES.title' => 'Notis vid uppdatering',
    'NOTIFY_UPDATES.description' => 'Visar en notis om en ny uppdatering finns tillgänglig.',
    'DISPLAY_FOOTER.title' => 'Visa sidfot',
    'DISPLAY_FOOTER.description' => 'Avgör om sidfotslänkar ska visas.',
    'DISPLAY_CREDIT.title' => 'Visa källhänvisning på användarsidor',
    'DISPLAY_CREDIT.description' => 'Avgör om källhänvisningen ska visas på användarsidor.',
    'DISPLAY_CREDIT_FOOTER.title' => 'Visa källhänvisning i sidfot',
    'DISPLAY_CREDIT_FOOTER.description' => 'Avgör om källhänvisningen ska visas i sidfötterna.',
    'HOME_URL.title' => 'Ställ in användarsida som Hemsida',
    'HOME_URL.description' => 'Ställer in användarsida som hemsida. Detta flyttar den vanliga hemsidan till example.com/home.',
    'ALLOW_USER_HTML.title' => 'Tillåt utökad syntax i användares biografier',
    'ALLOW_USER_HTML.description' => 'Detta tillåter användare att tillämpa speciell formattering som rubriker och länkar i deras sidobiografi.<br>Detta anses generellt vara säkert.',
    'APP_NAME.title' => 'Applikationstitel',
    'APP_NAME.description' => 'Avgör titeln på din app. Ändring av detta värde loggar ut alla aktiva användare.',
    'APP_KEY.title' => 'APP_KEY',
    'APP_KEY.description' => 'APP_KEY',
    'APP_URL.title' => 'APP_URL',
    'APP_URL.description' => 'APP_URL',
    'ENABLE_BUTTON_EDITOR.title' => 'Aktivera Knappredigerare',
    'ENABLE_BUTTON_EDITOR.description' => 'Avgör om användare får anpassa sina egna knappar med hjälp av CSS.',
    'APP_DEBUG.title' => 'APP_DEBUG',
    'APP_DEBUG.description' => 'APP_DEBUG',
    'APP_ENV.title' => 'APP_ENV',
    'APP_ENV.description' => 'APP_ENV',
    'LOG_CHANNEL.title' => 'LOG_CHANNEL',
    'LOG_CHANNEL.description' => 'LOG_CHANNEL',
    'LOG_LEVEL.title' => 'LOG_LEVEL',
    'LOG_LEVEL.description' => 'LOG_LEVEL',
    'MAINTENANCE_MODE.title' => 'Aktivera Underhållsläge',
    'MAINTENANCE_MODE.description' => 'Visar att underhåll pågår på alla publika sidor. Detta inaktiverar även inloggningssidorna.',
    'MAIL_MAILER.title' => 'MAIL_MAILER',
    'MAIL_MAILER.description' => 'MAIL_MAILER',
    'MAIL_HOST.title' => 'MAIL_HOST',
    'MAIL_HOST.description' => 'MAIL_HOST',
    'MAIL_PORT.title' => 'MAIL_PORT',
    'MAIL_PORT.description' => 'MAIL_PORT',
    'MAIL_USERNAME.title' => 'MAIL_USERNAME',
    'MAIL_USERNAME.description' => 'MAIL_USERNAME',
    'MAIL_PASSWORD.title' => 'MAIL_PASSWORD',
    'MAIL_PASSWORD.description' => 'MAIL_PASSWORD',
    'MAIL_ENCRYPTION.title' => 'MAIL_ENCRYPTION',
    'MAIL_ENCRYPTION.description' => 'MAIL_ENCRYPTION',
    'MAIL_FROM_ADDRESS.title' => 'MAIL_FROM_ADDRESS',
    'MAIL_FROM_ADDRESS.description' => 'MAIL_FROM_ADDRESS',
    'JOIN_BETA.title' => 'Gå med i beta-programmet',
    'JOIN_BETA.description' => 'Aktiverar betaversioner vid uppdatering. Läs mer om detta <a target=\'_blank\' href=\'https://linkstack.org/b\'>här</a>.',
    'SKIP_UPDATE_BACKUP.title' => 'Skippa backup vid uppdatering',
    'SKIP_UPDATE_BACKUP.description' => 'Skippar backups vid uppdatering. Detta alternativ rekommenderas att alltid vara inaktiverat, <br>men kan i vissa konfigurationer skapa problem.',
    'CUSTOM_META_TAGS.title' => 'Aktivera egna meta-taggar',
    'CUSTOM_META_TAGS.description' => 'Aktiverar anpassningsbara meta-taggar i "head"-stycket på alla sidor. Definieras i Advancerad Konfiguration.',
    'FORCE_HTTPS.title' => 'Tvinga HTTPS på länkar',
    'FORCE_HTTPS.description' => 'Tvingar alla länkar att använda HTTPS som standard. Detta alternativ rekommenderas om omvänd proxy är i bruk.',
    'ALLOW_CUSTOM_CODE_IN_THEMES.title' => 'Tillåt anpassad kod i teman',
    'ALLOW_CUSTOM_CODE_IN_THEMES.description' => 'Tillåter bruk av anpassad kod i teman. Om du använder teman från okännda källor, <br>så kan detta innebära en säkerhetsrisk.',
    'ENABLE_THEME_UPDATER.title' => 'Aktivera Temauppdateraren',
    'ENABLE_THEME_UPDATER.description' => 'Avgör om temauppdateraren ska vara aktiv.',
    'ENABLE_ADMIN_BAR_USERS.title' => 'Aktivera administrationsfält för alla användare',
    'ENABLE_ADMIN_BAR_USERS.description' => 'Om det här alternativet är aktivt kommer alla inloggade användare att ha ett administrationsfält tillgängligt på deras länksidor.',
    'ENABLE_SOCIAL_LOGIN.title' => 'Aktivera social inloggning',
    'ENABLE_SOCIAL_LOGIN.description' => 'Aktiverar inloggning via sociala medier. Det här alternativer kräver vidare konfiguration. Läs mer om detta <a target=\'_blank\' href=\'https://linkstack.org/social-login\'>här</a>.',
    'USE_THEME_PREVIEW_IFRAME.title' => 'Använd iframe som temaförhandsvisning',
    'USE_THEME_PREVIEW_IFRAME.description' => 'Avgör om en intern iframe skall användas som förhandsvisning för teman på temasidan.',
    'FORCE_ROUTE_HTTPS.title' => 'Omdirigera alla sidor till HTTPS',
    'FORCE_ROUTE_HTTPS.description' => 'Det här alternativet kommer att förstöra din konfiguration om du använder omvänd proxy.',
    'DISPLAY_FOOTER_TERMS.title' => 'Sidfotslänk för villkor',
    'DISPLAY_FOOTER_TERMS.description' => 'Aktiverar länk i sidfot för villkor.',
    'DISPLAY_FOOTER_PRIVACY.title' => 'Sidfotslänk för Integritet',
    'DISPLAY_FOOTER_PRIVACY.description' => 'Aktiverar länk i sidfot för Integritet.',
    'DISPLAY_FOOTER_CONTACT.title' => 'Sidfotslänk för Kontakt',
    'DISPLAY_FOOTER_CONTACT.description' => 'Aktiverar länk i sidfot för Kontakt.',
    'TITLE_FOOTER_HOME.title' => '<div style="margin-top:-40px"></div>',
    'TITLE_FOOTER_HOME.description' => 'Titel för sidfotslänk till hem.',
    'TITLE_FOOTER_TERMS.title' => '<div style="margin-top:-40px"></div>',
    'TITLE_FOOTER_TERMS.description' => 'Titel för sidfotslänk till villkor.',
    'TITLE_FOOTER_PRIVACY.title' => '<div style="margin-top:-40px"></div>',
    'TITLE_FOOTER_PRIVACY.description' => 'Titel för sidfotslänk till integritet.',
    'TITLE_FOOTER_CONTACT.title' => '<div style="margin-top:-40px"></div>',
    'TITLE_FOOTER_CONTACT.description' => 'Titel för sidfotslänk till kontakt.',
    'HOME_FOOTER_LINK.title' => '<div style="margin-top:-40px">Home footer link URL</div>',
    'HOME_FOOTER_LINK.description' => 'Ange valfri URL för att omdirigera din hemlänks URL.<br>Lämna fältet tomt för standard.',
    'ALLOW_CUSTOM_BACKGROUNDS.title' => 'Tillåt egna bakgrunder',
    'ALLOW_CUSTOM_BACKGROUNDS.description' => 'Tillåter användare att ladda upp egna bakgrundsbilder till deras sidor.',
    'ALLOW_USER_IMPORT.title' => 'Tillåt användare att importera profiler från andra instanser',
    'ALLOW_USER_IMPORT.description' => 'Tillåter användera att importera deras profiler och länkar från en extern fil.',
    'ALLOW_USER_EXPORT.title' => 'Tillåt användare att exportera deras profil',
    'ALLOW_USER_EXPORT.description' => 'Tillåter användera att exportera deras egna profiler och länkar.',
    'MANUAL_USER_VERIFICATION.title' => 'Verifiera användare manuellt',
    'MANUAL_USER_VERIFICATION.description' => 'Avgör om administratörer ska verifiera nyregistrerade medlemmar manuellt.',
    'ADMIN_EMAIL.title' => 'Administratörsmail',
    'ADMIN_EMAIL.description' => 'Används för att skicka notiser via mail.',
    'HIDE_VERIFICATION_CHECKMARK.title' => 'Dölj verifieringsbock',
    'HIDE_VERIFICATION_CHECKMARK.description' => 'Döljer verifieringsbock som visas på administratörers samt VIP-medlemmars sidor.',
    'ENABLE_REPORT_ICON.title' => 'Aktivera rapportikon',
    'ENABLE_REPORT_ICON.description' => 'Visar en ikon på användarsidor som låter användare rapportera sidor.',
    'LOCALE.title' => 'Appspråk',
    'LOCALE.description' => 'Ändrar språket på din applikation',


    /*
    |--------------------------------------------------------------------------
    | Installerare
    |--------------------------------------------------------------------------
    |
    | resources/views/installer/installer.blade.php
    |
    */

    # Title Tag
    'LinkStack setup' => 'Installation av LinkStack',

    'Setup LinkStack' => 'Installera LinkStack',
    'Welcome to the setup for LinkStack!' => 'Välkommen till installationsguiden för LinkStack!',
    'This setup will:' => 'Den här installationsguiden kommer att:',
    'Check the server dependencies' => '1. Kontrollera serverkrav',
    'Setup the database' => '2. Installera databasen',
    'Create the admin user' => '3. Skapa administratörsanvändaren',
    'Configure the app' => '4. Konfigurera applikationen',
    'Choose a language' => 'Välj ett språk',

    'Next' => 'Nästa',
    'Yes' => 'Ja',
    'No' => 'Nej',
    'Finish setup' => 'Slutför installationen',

    'Setup failed' => 'Installation misslyckades',
    'An error has occured. Please try again' => 'Ett fel har uppstått. Var vänlig och försök igen.',
    'Depending on your database type:' => 'Beroende på din typ av databas:',
    'Try again' => 'Försök igen',

    'Dependency check' => 'Kontroll av systemkrav',
    'Required PHP modules:' => 'Obligatoriska PHP-moduler:',

    'Select a database type' => 'Välj en typ av database',
    'Under most circumstances, we recommend using SQLite' => 'I de flesta fall rekommenderar vi SQLite.',
    'MySQL requires a separate, empty MySQL database' => 'MySQL kräver en separat och tom MySQL-databas.',

    'Database type:' => 'Databastyp:',
    'Database host:' => 'Databasvärd:',
    'Database port:' => 'Databasport:',
    'Database name:' => 'Databasenamn:',
    'Database username:' => 'Databasens användarnamn:',
    'Database password:' => 'Databasens lösenord:',

    'Create an admin account' => 'Skapa ett administrationskonto.',
    'Admin email:' => 'Administratörens email:',
    'Admin password:' => 'Administratörens password:',
    'Handle:' => 'Användarnamn:',
    'Name:' => 'Namn:',

    'Configure your page' => 'Konfigurera din sida',
    'Enable registration:' => 'Aktivera registrering:',
    'Enable email verification:' => 'Aktivera mailbekräftelse:',
    'Set your page as Home Page' => 'Använd din sida som hemsida',
    'This will move the Home Page to /home' => 'Detta flyttar den ordinarie hemsidan till /home',
    'App Name:' => 'Appnamn:',


    /*
    |--------------------------------------------------------------------------
    | Uppdaterare/Uppdaterar-backup
    |--------------------------------------------------------------------------
    |
    | resources/views/update.blade.php
    |
    */

    # Titel-tagg
    'Update LinkStack' => 'Uppdatera LinkStack',

    'Latest beta version' => 'Senaste betaversion',
    'Installed beta version' => 'Installerad betaversion',
    'none' => 'ingen',
    'You need to update to the latest mainline release' => 'Du behöver uppdatera till den senaste mainline-versionen',
    'You’re running the latest mainline release' => 'Du använder den senaste mainline-versionen',

    'update.manually' => 'Du kan uppdatera din installation automatiskt eller ladda ner och installera uppdateringen manuellt:',
    'update.windows' => 'Windows-användare kan använda den alternativa uppdateraren. Den här uppdateraren skapar ingen backup. Använd efter eget omdöme.',
    'Update automatically' => 'Uppdatera automatiskt',

    'Updating' => 'Uppdaterar',
    'Creating backup' => 'Skapar backup',
    'Preparing update' => 'Förbereder uppdatering',
    'No new version' => 'Ingen ny version',
    'There is no new version available' => 'Det finns ingen ny version tillgänglig',
    'Admin Panel' => 'Administrationspanel',
    'Finishing up' => 'Slutför',
    'Success!' => 'Lyckades!',
    'The update was successful' => 'Uppdateringen lyckades, du kan nu återvända till Administrationspanelen.',
    'View the release notes' => 'Visa versionsnoteringar',
    'Run again' => 'Kör igen',
    'Error' => 'Fel',
    'Something went wrong with the update' => 'Något gick fel med uppdateringen',

    
    /*
    |--------------------------------------------------------------------------
    | Backup
    |--------------------------------------------------------------------------
    |
    | resources/views/backup.blade.php
    |
    */

    # Title Tag
    'Backup.title' => 'Backup',

    'The backup was successful' => 'Skapandet av backup lyckades, du kan nu gå tillbaka till Administrationspanelen eller se alla dina backups.',


    /*
    |--------------------------------------------------------------------------
    | Sidblock
    |--------------------------------------------------------------------------
    |
    | Parts are stored in the database.
    | resources/views/studio/edit-link.blade.php
    |
    */

    # fördefinierat
    'block.title.predefined' => 'Förinställd Sida',
    'block.description.predefined' => 'Välj från en lista över förinställda webbplatser och låt din länk automatiskt stilhanteras med hjälp av webbplatsens färger och ikon.',

    # länk
    'block.title.link' => 'Egen Länk',
    'block.description.link' => 'Skapa en egen länk som leder till valfri webbplats. Anpassa knappens stil och ikon, eller använd webbplatsens favicon som knappens ikon.',

    # vcard
    'block.title.vcard' => 'Vcard',
    'block.description.vcard' => 'Skapa eller ladda upp ett elektroniskt visitkort.',

    # email
    'block.title.email' => 'E-Mail adress',
    'block.description.email' => 'Lägg till en mailadress som öppnar enhetens standardapp för att skriva ett mail till den adressen.',

    # telefon
    'block.title.telephone' => 'Telefonnummer',
    'block.description.telephone' => 'Lägg till ett telefonnummer som öppnar enhetens standardapp för att ringa till det numret.',

    # rubrik
    'block.title.heading' => 'Rubrik',
    'block.description.heading' => 'Använd rubriker för att organisera dina länkar och dela in dem i grupper.',

    # Tomrum
    'block.title.spacer' => 'Tomrum',
    'block.description.spacer' => 'Lägg till tomrum i din länklista. Du kan ställa in höjden.',

    # text
    'block.title.text' => 'Text',
    'block.description.text' => 'Lägg till fast text som ej går att klicka på.',


    /*
    |--------------------------------------------------------------------------
    | Sidobjekt
    |--------------------------------------------------------------------------
    |
    | resources/views/components/pageitems/
    |
    */

    'Default Email' => 'Standardmail',
    'Custom Title' => 'Egen Titel',
    'Leave blank for default title' => 'Lämna fältet tomt för standardtitel',
    'E-Mail address' => 'Mailadress',
    'Enter your E-Mail' => 'Ange din E-Mail',

    'Heading Text:' => 'Rubriktext:',

    'URL' => 'URL',
    'Show website icon on button' => 'Visa webbplatsens ikon på knappen',

    'Select a predefined site' => 'Välj en förinställd sida',
    'Enter the link URL' => 'Ange länkens URL',

    'Spacing height' => 'Tomrumshöjd',

    'Phone' => 'Telefon',
    'Telephone number' => 'Telefonnummer',
    'Enter your telephone number' => 'Ange ditt telefonnummer',

    'Text to display' => 'Text att visa',

    'Vcard' => 'Vcard',
    'First Name' => 'Förnamn',
    'Middle Name' => 'Mellannamn',
    'Last Name' => 'Efternamn',
    'Suffix' => 'Suffix',
    'Work' => 'Arbete',
    'Organization' => 'Organisation',
    'Work URL' => 'URL till arbete',
    'Emails' => 'Email',
    'Enter your personal email' => 'Ange din personliga email',
    'Work Email' => 'Email till arbete',
    'Enter your work email' => 'Ange ditt arbetes email',
    'Phones' => 'Telefoner',
    'Home Phone' => 'Hemtelefon',
    'Work Phone' => 'Jobbtelefon',
    'Cell Phone' => 'Mobiltelefon',
    'Home Address' => 'Hemadress',
    'Label' => 'Etikett',
    'Street' => 'Gata',
    'City' => 'Stad',
    'State/Province' => 'Landskap',
    'Zip/Postal Code' => 'Postkod',
    'Country' => 'Land',
    'Work Address' => 'Jobbadress',

    'URL to the video' => 'URL till videon',


    /*
    |--------------------------------------------------------------------------
    | Underhållssida
    |--------------------------------------------------------------------------
    |
    | resources/views/mainenance.blade.php
    |
    */

    'Maintenance Mode' => 'Underhållsläge',
    'We are performing scheduled site maintenance at this time' => 'Vi utför schemalagt underhåll av webbplatsen för tillfället.',
    'Please check back with us later' => 'Återkom vänligen senare.',
    'Admin options:' => 'Administratörsalternativ:',
    'Turn off' => 'Inaktivera',
    'Warn.Disable.Maintenance' => 'Du är på väg att inaktivera Underhållsläget. Är du säker?',


    /*
    |--------------------------------------------------------------------------
    | LinkStack (Länk-sida)
    |--------------------------------------------------------------------------
    |
    | resources/views/littlelink.blade.php
    |
    */

    'Share this page' => 'Dela den här sidan',
    'Share' => 'Dela',
    'Copy URL to clipboard' => 'Kopiera URL',
    'URL has been copied to your clipboard!' => 'URL:en har kopierats till ditt urklipp!',
    
    
    'Delete User' => 'Radera användare',
    'Block User' => 'Blockera användare',
    'Users Theme' => 'Tema',
    'Search User' => 'Leta upp användare',
    
    'Edit my profile' => 'Redigera min profil',


    /*
    |--------------------------------------------------------------------------
    | Sidfot
    |--------------------------------------------------------------------------
    |
    | Added to the bottom of certain pages.
    | resources/views/layouts/footer.blade.php
    |
    */

    'Learn more about LinkStack' => 'Lär dig mer om LinkStack',
    'Learn more' => 'Lär dig mer',

    /*
    |--------------------------------------------------------------------------
    | Notismeddelanden
    |--------------------------------------------------------------------------
    |
    | All internal notifications.
    | resources/views/layouts/notifications.blade.php
    |
    */

    'No notifications' => 'No notifications',

    # Säkerhetsnotis
    'Your security is at risk!' => 'Din säkerhet riskeras!',
    'Immediate action is required!' => 'Omedelbar handling krävs!',
    'security.msg1' => 'Din säkerhet riskeras.',
    'security.msg2' => 'Vissa filer kan nås av utomstående. Omedelbar handling krävs!',
    'security.msg3' => 'Vissa viktiga filer kan nås av allmänheten, detta sätter din säkerhet på spel. Vänligen ta omedelbart handling för att dra in allmän tillgång till dessa filer för att förhindra obehörig tillgång till känslig information.',
    'security.msg4' => 'Lär dig mer',

    # "Hjälp oss"-notis
    'Hide this notification' => 'Dölj den här notisen',
    'Help Us Out' => 'Hjälp Oss',
    'Enjoying Linkstack?' => 'Gillar du LinkStack?',
    'Support Linkstack' => 'Stöd LinkStack',
    'support.msg1' => 'Om du har fått nöje av att använda LinkStack, så skulle vi verkligen uppskatta om du kunde',
    'support.msg2' => 'stjärnmarkera projektet på GitHub',
    'support.msg3' => 'Ditt stöd hjälper oss nå en bredare publik och förbättrar kvalitén på vårt projekt.',
    'support.msg4' => 'Om du har möjlighet att',
    'support.msg5' => 'stödja oss finansiellt</a>, så skulle även en liten summa hjälpa oss att täcka kostnaderna för underhåll och förbättring av LinkStack.',
    'support.msg6' => 'Tack för ditt stöd och för att du är en del av LinkStacks gemenskap!',


    /*
    |--------------------------------------------------------------------------
    | Sidfotslänkar
    |--------------------------------------------------------------------------
    |
    */

    'footer.Home' => 'Hem',
    'footer.Terms' => 'Villkor',
    'footer.Privacy' => 'Integritet',
    'footer.Contact' => 'Kontakt',


    /*
    |--------------------------------------------------------------------------
    | Rapportsida
    |--------------------------------------------------------------------------
    |
    */

    'report_violation' => 'Rapportera missbruk',
    'url_label' => 'URL till sidan du vill rapportera',
    'report_type_label' => 'Typ av rapport',
    'hate_speech' => 'Hets mot folkgrupp eller trakasseri',
    'violence_threats' => 'Våld eller hot',
    'illegal_activities' => 'Olagliga aktiviteter',
    'copyright_infringement' => 'Missbruk av upphovsrätt',
    'misinformation_fake_news' => 'Desinformation',
    'identity_theft' => 'Identitetsstöld',
    'drug_related_content' => 'Drogrelaterat innehåll',
    'weapons_harmful_objects' => 'Vapen eller farliga objekt',
    'child_exploitation' => 'Utnyttjande av barn',
    'fraud_scams' => 'Bedrägeri',
    'privacy_violation' => 'Integritetskränkning',
    'impersonation' => 'Personifiering',
    'other_specify' => 'Annat (specifiera)',
    'additional_comments_label' => 'Övriga kommentarer',
    'submit_button' => 'Skicka',
    

    'report_mail_admin_subject' => 'Profilrapport',
    'report_mail_admin_report' => 'En profil har rapporterats',

    'report_mail_reported_profile' => 'Rapporterad profil',
    'report_mail_reported_url' => 'Rapporterad URL',
    'report_mail_type' => 'Typ',
    'report_mail_message' => 'Meddelande',

    'report_mail_report_submitted_by' => 'Rapport inskickad av',
    'report_mail_reported_by' => 'Rapporterad av',
    'report_mail_profile' => 'Profil',

    'report_mail_button_profile' => 'Visa på användarens sida',
    'report_mail_button_delete' => 'Radera användarrapport',


    'report_error' => 'Profilen kunde inte rapporteras',
    'report_success' => 'Profilen har rapporterats',    
    

    #=============================================================================#
    # Laravel internal translations                                               #
    #=============================================================================#


    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Dessa värden stämmer inte överens med vår data.',
    'password' => 'Det angiivna lösenorder är ej korrekt.',
    'throttle' => 'För många inloggningsförsök. Vänligen försök igen om :seconds sekunder.',


    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'previous' => '&laquo; Föregående',
    'next' => 'Nästa &raquo;',


];
