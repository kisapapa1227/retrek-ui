セットアップ方法
以下をターミナルで実行

cd hoge<br>
# 手順１: コードを作業用ディレクトリーにダウンロードする。<br>
git clone https://github.com/kisapapa1227/retrek-ui.git<br>
cd retrek-ui<br>
git clone https://github.com/kisapapa1227/ReTReKpy.git<br>
cp .env.easy .env # docker の設定ファイルを準備する。<br>
\# ok?

Dockerコンテナの反映（以下をターミナルで実行）

docker-compose down

docker-compose rm -f

docker volume prune -f

docker network prune -f

docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs

#/var/www/html がすでにある場合、別名で保存しておく(mv /var/www/html /var/www/html.org)

#apache が起動している場合は止める (service apache2 stop)、

#実行ディレクトリーにリンクをはる。コピーでもok

ln -s $PWD /var/www/html

#log ファイル、一時ファイル用の書き込みパーミッションをつける。

chmod 666 /var/www/html/.env

touch /var/www/html/storage/logs/laravel.log

chmod 666 /var/www/html/storage/logs/laravel.log

chmod -R 777 /var/www/html

./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan migrate
 
./vendor/bin/sail npm install

./vendor/bin/sail npm run build


使用方法（以下のコマンドをターミナルで実行したのち、localhost80に接続して使用する）
./vendor/bin/sail up<br>
ブラウザで<br>
http://localhost<br>
に接続する
