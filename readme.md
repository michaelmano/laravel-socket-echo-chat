# Simple Example Chat built with Socket.io and Laravel Echo

Please NOTE: This is for refrences only. A reminder on how to get laravel echo working with socket.

## Setup

 1. Install Laravel echo on the machine `npm install -g laravel-echo-server`.
 2. run `laravel-echo-server init` to generate your configuration file.
 3. 

## NGINX config

You will require to add the config below as to proxy pass the socket to the local machine.

```nginx
...
server {
    listen 80;
    listen [::]:80;

    root /var/www/chat/public;
    server_name _;

    index index.php index.html;

    add_header 'Access-Control-Allow-Origin' '*';
    add_header 'Access-Control-Allow-Headers' 'origin, content-type, accept';

    location /socket.io {
        proxy_pass http://127.0.0.1:6001;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "Upgrade";
        proxy_set_header Host $host;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~* (index)\.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.2-fpm.sock;
    }

    location ~ /\.ht {
            deny all;
    }
}
```
