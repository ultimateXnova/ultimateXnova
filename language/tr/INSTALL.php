<?php
/**
 *  ultimateXnova
*  based on 2moons by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package ultimateXnova
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2022 Koray Karakuş <koraykarakus@yahoo.com>
 * @copyright 2024 Pfahli (https://github.com/Pfahli)
 * @licence MIT
 * @version 1.8.x Koray Karakuş <koraykarakus@yahoo.com>
 * @link https://github.com/jkroepke/ultimateXnova
 */

// Turkce'ye Ibrahim Senyer tarafindan cevirilmistir. Butun Haklari saklidir (C) 2013
// ultimateXnova - Copyright (C) 2010-2012 Slaver
// Translated into Turkish by Ibraihm Senyer . All rights reversed (C) 2013
// ultimateXnova - Copyright (C) 2010-2012 Slaver


$LNG['back']					= 'Geri';
$LNG['continue']				= 'Devam Et';
$LNG['continueUpgrade']			= 'Güncelleştir!';
$LNG['login']					= 'Giriş';

$LNG['menu_intro']				= 'Tanıtım';
$LNG['menu_install']			= 'Kurulum';
$LNG['menu_license']			= 'Lisans';
$LNG['menu_upgrade']			= 'Güncelle';

$LNG['title_install']			= 'Kurulum';

$LNG['intro_lang']				= 'Dil';
$LNG['intro_install']			= 'Kuruluma git';
$LNG['intro_welcome']			= 'Hoşgeldin yeni ultimateXnova Kullanıcısı!';
$LNG['intro_text']				= 'ultimateXnova gerek kullanim kolayligi, gerek kod esnekligi, dinamizmi, kod kalitesi ve islevleri ile goz almaktadir. Her zaman sizin beklentilerinizden daha iyi olmaya calistik. <br><br> Kurulumdaki direktifler kurulum esnasinda size rehberlik edecektir. Her sorun ve problemde, bize danismak icin kesinlikle tereddut etmeyin!<br><br>The ultimateXnova bir acik kod uygulamasidir ve GNU GPL v3 lisanslidir. Lisans hakkinda bilgi edinmek icin asagidaki "Lisans" linkine tiklayabilirsiniz.  <br><br> Kurulum islemine baslamadan once sisteminiz ultimateXnova kurmak icin gerekli ozelliklere sahip olup olmadigi test edilecektir. ';
$LNG['intro_upgrade_head']		= 'Sisteminizde ultimateXnova mevcut kurulu mu?';
$LNG['intro_upgrade_text']		= '<p>Sisteminizde ultimateXnova kurulu, kolay bir guncelleme istermisiniz?</p><p>Buraya tiklayarak sisteminizin eski veritabanini bir kac tiklama ile guncelleyebilirsiniz.!</p>';


$LNG['upgrade_success']			= 'Güncelleme başarı ile tamamlandı. Veritabanınız şu an sürüm %s için uygun.';
$LNG['upgrade_nothingtodo']		= 'Herhangi bir eylem gerekmiyor. Veritabanı sürüm %s için uygun.';
$LNG['upgrade_back']			= 'Geri';
$LNG['upgrade_intro_welcome']	= 'Veritabanı güncellemeye hoşgeldiniz!';
$LNG['upgrade_available']		= 'Veritabanınız için gerekli güncellemeler! Veritabanınızın şu anki sürümü %s ve sürüm %s güncellenebilir.<br><br Lütfen aşagıdaki menüden ilk SQL güncellemesini tıklayınız:';
$LNG['upgrade_notavailable']	= 'Mevcut sürüm %s zaten son versiyon.';
$LNG['upgrade_required_rev']	= 'Güncelleme programı versiyon  r2579 (ultimateXnova v1. 7) yada üst versiyonlari icin uygulanabilir.';


$LNG['licence_head']			= 'Lisans Koşulları';
$LNG['licence_desc']			= 'Lütfen asagidaki lisans koşullarını iyice okuyunuz.';
$LNG['licence_accept']			= 'ultimateXnova kurulumuna devam etmek icin, lisans şartlarini kabul etmeniz gerekmektedir. ';
$LNG['licence_need_accept']		= 'Eğer kuruluma devam etmek istiyorsanız lisans koşullarını kabul etmelisiniz.';

$LNG['req_head']				= 'Sistem Gereksinimleri';
$LNG['req_desc']				= 'Kuruluma baslamadan önce, ultimateXnova sistemin kurulum icin uygun olup olmadigini test edecek. Sonuçları dikkatlice okumanız tavsiye edilir ve bütün testleri geçmeden bir sonraki adıma geçmeyiniz';
$LNG['reg_yes']					= 'Evet';
$LNG['reg_no']					= 'Hayır';
$LNG['reg_found']				= 'Bulundu';
$LNG['reg_not_found']			= 'Bulunamadı';
$LNG['reg_writable']			= 'Kaydedilebilir';
$LNG['reg_not_writable']		= 'Kaydedilemez';
$LNG['reg_file']				= 'Dosya &raquo;%s&laquo; Kaydedilebilir mi?';
$LNG['reg_dir']					= 'Klasör &raquo;%s&laquo; Kaydedilebilir mi?';
$LNG['req_php_need']			= 'Mevcut script dili/versiyonu &raquo;PHP&laquo;';
$LNG['req_php_need_desc']		= '<strong>Gereken:</strong> — PHP ultimateXnova yazılım dilidir. Bu sebeple, bütün fonksiyonlarin tam çalısabilmesi için mevcut PHP versiyonu 5.2.5 yada üstü olması gereklidir. ';
$LNG['reg_gd_need']				= 'Yuklu GD PHP Script var mı? &raquo;gdlib&laquo;';
$LNG['reg_gd_desc']				= '<strong>Opsiyonel</strong> — Grafik işleme kütüphanesi &raquo;gdlib&laquo; sistemdeki dinamik resimlerin oluşturma işinden sorumludur. Bu olmadan sistemdeki bazı fonksiyonlar calişmayabilir.';
$LNG['reg_mysqli_active']		= 'Extension support &raquo;MySQLi&laquo;';
$LNG['reg_mysqli_desc']			= '<strong>Gereken</strong> — PHP de MYSQL icin destek olmali. Eğer girilen hiç bir veritabanı uygun değilse domain sağlayıcınız ile görüşmeli yada PHP dosyalarını gözden geçirmelisiniz.';
$LNG['reg_json_need']			= ' &raquo;JSON&laquo; uzantısı uygun mu?';
$LNG['reg_iniset_need']			= 'PHP fonksiyonu &raquo;ini_set&laquo; uygun mu?';
$LNG['reg_global_need']			= 'Globallerin kaydi aktif mi?';
$LNG['reg_global_desc']			= 'ultimateXnova globaller aktif olsun ya da olmasın çalışacaktır. Ama, eğer mümkünse güvenlik önlemleri için bunu inaktif yapmanız önerilir.';
$LNG['req_ftp_head']			= 'FTP bilgilerini giriniz';
$LNG['req_ftp_desc']			= 'FTP bilgilerinizi giriniz ve ultimateXnova otomatik olarak problemleri düzeltsin. Alternatif olarak, kendiniz yetki verebilirsiniz.';
$LNG['req_ftp_host']			= 'Domain Adi(HostName)';
$LNG['req_ftp_username']		= 'Kullanıcı Adı';
$LNG['req_ftp_password']		= 'Şifre';
$LNG['req_ftp_dir']				= 'ultimateXnova klasörü';
$LNG['req_ftp_send']			= 'Gönder';
$LNG['req_ftp_error_data']		= 'Verilen bilgiler ile FTP sunucusuna bağlanılamadı. Görev başarısız oldu.';
$LNG['req_ftp_error_dir']		= 'Girdiğiniz dizin yanlış ya da mevcut degil.';

$LNG['step1_head']				= 'Kurulum veritabanını konfigure et';
$LNG['step1_desc']				= 'ultimateXnova sisteminize kurululabilir. Simdi, veritabanina baglanmak icin asagidaki bilgileri girmelisiniz. Eger gerekli bilgileri bilmiyorsaniz, domain (alan) saglayiciniz ile irtibata geciniz yada ultimateXnova forumlarindaki direktifleri okuyunuz.';
$LNG['step1_mysql_server']		= 'Veritabanı sunucusu (SQL Server)';
$LNG['step1_mysql_port']		= 'Veritabanı-Port';
$LNG['step1_mysql_dbuser']		= 'Veritabanı-Kullanıcı adı';
$LNG['step1_mysql_dbpass']		= 'Veritabanı-Şifre';
$LNG['step1_mysql_dbname']		= 'Veritabanı';
$LNG['step1_mysql_prefix']		= 'Veritabanı prefix eki: (Değiştirmeniz gerekmez)';

$LNG['step2_prefix_invalid']	= 'Prefix eki sadece alfanumerik karakterlerden olusur ve son karakter altcizgi ( _ ) olmalidir. ';
$LNG['step2_db_no_dbname']		= 'Veritabano adı girmediniz.';
$LNG['step2_db_too_long']		= 'Prefiks eki cok uzun. En fazla 36 hane olabilir.';
$LNG['step2_db_con_fail']		= 'Veritabanına baglanirken hata olustu. Detaylar : ';
$LNG['step2_conf_op_fail']		= "config.php yazılamadı!";
$LNG['step2_conf_create']		= 'config.php başarıyla oluştu!';
$LNG['step2_config_exists']		= 'config.php zaten mevcut!';
$LNG['step2_db_done']			= 'Başarı ile veritabananına bağlandı!';

$LNG['step3_head']				= 'Veritabanı dosyaları oluşturuluyor';
$LNG['step3_desc']				= 'ultimateXnova veritabanı için mevcut tablolar yaratıldı ve varsayılan değerler yüklendi. Bir sonraki işleme geçip kurulumu tamamlamak için;';
$LNG['step3_db_error']			= 'Veritabanı tabloları oluşturulamadı:';

$LNG['step4_head']				= 'Admin Hesabı';
$LNG['step4_desc']				= 'Kurulum sihirbazi şimdi sizin için admin hesabı yaratacak. Aşağıya kullanıcı adı, şifre ve mail adresinizi yazınız.';
$LNG['step4_admin_name']		= 'Admin-kullanıcı adı:';
$LNG['step4_admin_name_desc']	= '3-20 karakter arası kullanıcı adı giriniz.';
$LNG['step4_admin_pass']		= 'Admin şifresi:';
$LNG['step4_admin_pass_desc']	= '6-30 karakter arasi şifre giriniz';
$LNG['step4_admin_mail']		= 'E-mail adresi:';

$LNG['step6_head']				= 'Kurulum başaru ile tamamlandı!';
$LNG['step6_desc']				= 'ultimateXnova sisteminize başarı ile kuruldu';
$LNG['step6_info_head']			= 'ultimateXnova kullanılmaya hazır!';
$LNG['step6_info_additional']	= 'Aşağıdaki butona tikladığınızda ultimateXnova admin sayfasına yönlendirileceksiniz. ultimateXnova admin araçlarını buradan inceleyebilirsiniz.<br/><br/><strong> &raquo;includes/ENABLE_INSTALL_TOOL&laquo; dosyasini silmeyi unutmayiniz. Eger bu dosya sisteminizde kalirsa baska birisinin oyunu tekrar kurmasina izin vererek kurulumunuzu buyuk riske atarsiniz!</strong>';

$LNG['sql_close_reason']		= 'Oyun şuanda kapalı';
$LNG['sql_welcome']				= 'ultimateXnova\'a hoşgeldiniz';
$LNG['reg_pdo_active']			= 'PDO Aktif';
$LNG['reg_pdo_desc']			= 'PHP Veri Nesneleri (PDO) eklentisi, PHP\'deki veritabanlarına erişmek için hafif ve tutarli bir arayüz tanımlar. PDO arayüzü tanımı bulunan her veritabanı sürücüsü, veritabanina özgü özellikleri sıradan eklenti işlevleri olarak ifade edebilir.';
$LNG['step8_need_fields']		= 'Zorunlu alanları doldurmadınız. Lütfen geri giderek bütün alanları doldurunuz!';
