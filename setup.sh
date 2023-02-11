echo "\n 1.パッケージのアップデートしました\n"
sudo yum update -y

echo "\n 2.PHPのパッケージをすべてアンインストールしました\n "
sudo yum -y remove php-*

echo "\n 3.amazon-linux-extrasをアップデートしました\n "
sudo yum update -y amazon-linux-extras

echo  "\n 4.amazon-linux-extrasで使用中のパッケージと使えるパッケージを確認\n "
amazon-linux-extras

echo  "\n 5.lamp-mariadb10.2-php7.2を使用停止しました\n "
sudo amazon-linux-extras disable lamp-mariadb10.2-php7.2

echo  "\n 6.PHP8.0を有効化しました\n "
sudo amazon-linux-extras enable php8.0

echo  "\n 7-1.インストールするパッケージの案内があったので、表示されたコマンドを実行しました\n "
yes | sudo yum clean metadata
yes | sudo yum install php-cli php-pdo php-fpm php-mysqlnd

echo  "\n 7-2.インストールするパッケージの案内があったので、表示されたコマンドを実行しました\n "
yes | sudo yum install php-cli php-common php-devel php-fpm php-gd php-mysqlnd php-mbstring php-pdo php-xml

echo  "\n 8-1.apacheの再起動しました\n "
yes | sudo systemctl restart httpd.service

echo  "\n 8-2.php-fpmの再起動しました\n "
yes | sudo systemctl restart php-fpm.service

echo  "\n 9.xdebugの設定を再度インストールしました\n "
yes | sudo yum install php-pear php-devel
yes | sudo pecl uninstall xdebug
yes | sudo pecl install xdebug

echo  "\n 10.expectコマンドをインストール\n "
yes | sudo yum install expect

echo  "\n 11.MariaDBデフォルト確認しました\n "
sudo yum list installed | grep mariadb

echo  "\n 12.MariaDBのインストールしました\n "
sudo amazon-linux-extras install mariadb10.5 -y

echo  "\n 13.Apache, MariaDBの起動しました\n "
sudo systemctl start mariadb

echo  "\n 14-1.MariaDBの初期設定を自動で行なっています\n "
# !/bin/sh
expect -c '
    set timeout 10;
    spawn sudo mysql_secure_installation
    expect "Enter current password for root (enter for none):";
    send "\n";
    expect "Switch to unix_socket authentication";
    send "y\n";
    expect "Set root password?";
    send "y\n";
    expect "New password:";
    send "root\n";
    expect "Re-enter new password:";
    send "root\n";
    expect "Remove anonymous users?";
    send "y\n";
    expect "Disallow root login remotely?";
    send "y\n";
    expect "Remove test database and access to it?";
    send "y\n";
    expect "Reload privilege tables now?";
    send "y\n";
    interact;'


echo  "\n 14-2.MaridaDBの自動起動を有効化しました\n "
sudo systemctl enable mariadb
sudo systemctl is-enabled mariadb

echo  "\n 15-1. Composerインストール（バージョン指定）しました\n "
curl -sS https://getcomposer.org/installer | php -- --version=2.3.5

echo  "\n 15-2. Composerのパスを通しました\n "
sudo mv composer.phar /usr/bin/composer

echo  "\n 15-3. Composerインストールできたかチェックしました\n "
composer

echo  "\n 16-1. Laravelプロジェクトをバージョン9指定で作成します\n "
composer create-project "laravel/laravel=9.*" cms

echo  "\n 16-2. コンポーザーをアップデートしました\n "
yes | sudo composer update

echo  "\n 17-1. phpMyAdminを作成する為にディレクトリ移動\n "
cd cms

echo  "\n 17-2. phpMyAdminを作成する為にディレクトリ移動\n "
cd public

echo  "\n 17-3. phpMyAdminをダウンロード\n "
wget https://files.phpmyadmin.net/phpMyAdmin/5.1.2/phpMyAdmin-5.1.2-all-languages.zip

echo  "\n 17-4. phpMyAdminを解凍\n "
unzip phpMyAdmin-5.1.2-all-languages.zip

echo  "\n 17-5. phpMyAdminのファイル名変更\n "
mv phpMyAdmin-5.1.2-all-languages phpMyAdmin

echo  "\n 17-6. cms階層に戻る\n "
cd ..

echo  "\n 17-7. セットアップファイルの削除\n "
rm setup.sh
