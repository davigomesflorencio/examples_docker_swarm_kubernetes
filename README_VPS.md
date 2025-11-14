Comandos e passo a passo na VPS
# 1 - Adquirir vps



# 2 - Adquirir domínio



# 3 - Configurar DNS



Tipo: A

Nome: api

Valor: <IP do seu servidor>



# 4 - Colocar projeto no GitHub



# 5 - Acessar servidor



# 6 - Instalar node e pm2



curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
npm i -g pm2


# 7 - clonar projeto



mkdir api
cd api/
git clone https://github.com/matheusbattisti/apinodedeploy.git .


# 8 - criar dotenv



vim .env



DATABASE_URL="file:../db/data.sqlite"
PORT=3000


# 9 - instalar pacotes e rodar prisma



npm i
npm run prisma:generate
npm run prisma:migrate


# 10 - rodar pm2



pm2 start npm --name "api" -- run start
pm2 save
pm2 startup
 
pm2 list


# 11 - configurar nginx



sudo apt install -y nginx
sudo systemctl enable nginx
sudo systemctl start nginx
 
sudo systemctl status nginx


# 12 - configurar sites-available



sudo vim /etc/nginx/sites-available/api.meudominiolegal.com.br
 
server {
listen 80;
server_name api.meudominiolegal.com.br;
 
  location / {
    proxy_pass http://127.0.0.1:3000;
    proxy_http_version 1.1;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
  }
 
}
 
sudo ln -s /etc/nginx/sites-available/api.matheusbattisti.com.br /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx
 
curl -I http://api.matheusbattisti.com.br/health


# 13 - configurar ssl



sudo apt install -y certbot python3-certbot-nginx
 
sudo certbot --nginx -d api.matheusbattisti.com.br
 
sudo nginx -t && sudo systemctl reload nginx
 
curl -I https://api.matheusbattisti.com.br/health




ARQUIVO:



server {
server_name api.meudominiolegal.com.br;
 
  location ^~ /.well-known/acme-challenge/ {
 
    root /var/www/html;
    default_type "text/plain";
  }
 
  location / {
    proxy_pass http://127.0.0.1:3000;
    proxy_http_version 1.1;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
  }
 
 
  listen 443 ssl; # managed by Certbot
  ssl_certificate /etc/letsencrypt/live/api.meudominiolegal.com.br/fullchain.pem; # managed by Certbot
  ssl_certificate_key /etc/letsencrypt/live/api.meudominiolegal.com.br/privkey.pem; # managed by Certbot
  include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
  ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
 
}
server {
  if ($host = api.meudominiolegal.com.br) {
    return 301 https://$host$request_uri;
  } # managed by Certbot
 
 
listen 80;
server_name api.meudominiolegal.com.br;
  return 404; # managed by Certbot
 
 
}


# 14 - testar no thunder client os end points