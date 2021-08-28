# issabel Send Telegram Message when Called 00

1. Copy all downloaded file in `/var/www/html` directory on issabel

2. Set `775` or `777` permission to all downloaded files

3. Go to `/var/www/html` directory

``` bash script

cd /var/www/html 

```

4. Open `checkcdr00.php` and set issabel database username and password and save
``` php
$username = "root";
$password = "pass_of_root";
```
5. Open `zarbinnetwork_telegram.php` and set telegrambot and telegramchatid
```php
$telegrambot='TelegramBot';
$telegramchatid=TelegramChatID;
```

6. open `/etc/asterisk/extensions_custom.conf` create `zarbinnetwork` context and include it
```
[from-internal-custom]
include => zarbinnetwork

[zarbinnetwork]
exten => _900.,n,AGI(zarbinnetwork_telegram_sendCallinfo.php)
```
7. Reload asterisk dialplan
```bash script
asterisk -r
reload
exit
```
8. you can check 900 destination with `https://issabel_IP_Address/checkcdr00.php`
9. you can also check 900 destination on `User Feild` of CDR Report
