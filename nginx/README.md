# Nginx
Official repository: http://hg.nginx.org/nginx/

GitHub mirror: https://github.com/nginx/nginx

# RTMP Module
GitHub: https://github.com/sergey-dryabzhinsky/nginx-rtmp-module

# Reference
OBSProject: https://obsproject.com/forum/resources/how-to-set-up-your-own-private-rtmp-server-using-nginx.50/

# Usage
- nginx を以下のコマンドでビルドしてください (コマンドは上記 #Reference サイトより)
```
sudo apt install build-essential libpcre3 libpcre3-dev libssl-dev
wget http://nginx.org/download/nginx-1.15.10.tar.gz
wget https://github.com/sergey-dryabzhinsky/nginx-rtmp-module/archive/dev.zip
tar -zxvf nginx-1.15.10.tar.gz
unzip dev.zip
cd nginx-1.15.10
./configure --with-http_ssl_module --add-module=../nginx-rtmp-module-dev
make
```

- `nginx-1.15.1/objs/` フォルダ内に生成された `nginx` を現在と同じフォルダに置いてください。 

- `list` フォルダを `chown` か `chmod` とかで `www-data` が読み書きできるようにしておいてください。

- `chown www-data -R ./list/`
