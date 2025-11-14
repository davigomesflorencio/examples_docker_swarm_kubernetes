# Curso Docker

#### Hello World

> docker run docker/whalesay cowsay Hello_World

Comando Não funcionou!

## Comandos de containers

## Container x VM (Virtual Machine)

#### Rodando Container

> docker run -it ubuntu

#### Parar container

> docker stop nome

#### Listar containers

> docker ps

> docker container ls

#### Container já executados!

> flag -a

#### Container executando no terminal

> flag -it

#### Container em Background

> flag -d

#### Expor portas

> :flag -p 80:80

> docker run -d -p 80:80 nginx

#### Iniciar Container

> docker start < nome ou id >

#### Nome para container

> flag --name

> docker --name

> docker run -d -p 80:80 --name nginx_app nginx

#### Verificando logs de um container

> docker logs < id >

Atualizações no terminal

> flag -f

#### Removendo containers

> docker rm < id >

flag -f (Forçar e remover)

> docker rm < id > -f

## Imagem

São originadas de arquivos que programamos
Instruções executadas em camadas

#### Apache

> docker run -d -p 80:80 --name meu_apache httpd

#### Executando uma imagem

> docker build < imagem >

#### Listar imagems

> docker image ls

#### Subir imagem

> docker run < id ou nome>

> docker run -d -p 3000:3000 --name my_image 003c59017c1e

#### Download de Imagens

> docker pull < imagem >

> docker pull python

#### Aprender mais sobre os comandos

> docker run --help

#### Multiplas aplicações mesmo container

> Mudar porta

#### Nome da imagem

flag -t

> docker build -t meu_nome_diferente .

#### Comando start interativo

> docker start -it <container>

#### Removendo imagens

> docker rmi < imagem >

#### Removendo imagens e containers

> docker system prune

Remover imagens container e networks

#### Removendo container apos utilizar

flag --rm

> docker run --rm < container >

> docker run -d -p 3000:3000 --name container --rm minhaimagem

#### Copiar arquivos entre containers

> docker cp

#### Verificar informações de processamento

> docker top < container >

#### Inspecionando container

> docker inspect < container >

#### verificar Processamento

> docker stats

#### Nome da imagem e tag

> docker tag imageId \<nome_imagem>:\<tag>

#### Nomear imagem na criação

flag -t

> docker build -t \<nome_imagem>:\<tag> .

#### Start interativo

flat -it

> docker run -d 3000:3000 \<imagem>

> docker start -i id_container

## Enviando Imagens para o Docker Hub

Criar o repositorio e estar logado

> docker push < imagem >

---

# Volumes

Uma forma pratica de persistir dados sem depender de containers

Fazer backups mais simples

#### Tipo de Volumes

- Anonimo - flag -v - Nome aleatorio
- Named - Volumes com nomes
- Bind Mounts - Salvar na maquina sem o docker , informar o diretorio

#### Volume Anonimo

> docker run -d -p 80:80 --name container_php --rm -v /data volumephp

#### Volume Nomeado

> docker run -d -p 80:80 --name container_php --rm -v < nome do volume >:/data volumephp

> docker run -d -p 80:80 --name container_php --rm -v volume1:/var/www/html volumephp

#### Bind Mounts

> docker run -d -p 80:80 --name container_php -v C:\Users\davig\Downloads\Docker\volumes\messages:/var/www/html/messages --rm volumephp

#### Criar volumes

> docker volume create < nome >

#### Checar volumes

> docker volume inspect < nome >

#### Removendo volumes

> docker volume rm < nome >

#### Removendo volumes não utilizados

> docker volume prune

#### Volume apenas leitura

> docker run -v volume:/data:ro

ro -> read only

rw -> read and write

---

# Networks

Uma forma de gerenciar a conexão do Docker com outras plataformas

## Tipo de conexão

- Externa - API
- Com o Host - Com a maquina
- Entre Containers - Driver Bridge

## Tipos de rede

- Bridge - O mais comum e padrão do docker
- Host - Container e a maquina que está hosteando
- Macvlan - Container e um Mac Adress
- none - Remove todas as conexões de rede de um container
- plugins - permite extensões de terceiros

#### Listando redes

> docker network ls

#### Criando redes

> docker network create < nome >

##### Network externa

> docker build -t flaskexterna .

> docker run -d -p 5000:5000 --name flaskexterno_container flaskexterna

##### Network interna

##### Containers

> docker build -t mysqlnetworkapi .

> docker network create flasknetwork

> docker run -d -p 3306:3306 --name mysql_api_container --rm --network flasknetwork -e MYSQL_ALLOW_EMPTY_PASSWORD=True mysqlnetworkapi

> docker build -t flaskapinetwork .

> docker run -p 5000:5000 --name flask_api_container --rm --network flasknetwork flaskapinetwork

##### Conectar container

> docker network connect flasknetwork cadfff1421e9

##### Desconectar container

> docker network disconnect flasknetwork cadfff1421e9

## Docker Compose

> docker compose up

#### Modo background

> docker compose up -d

#### Parando o compose

> docker compose down
