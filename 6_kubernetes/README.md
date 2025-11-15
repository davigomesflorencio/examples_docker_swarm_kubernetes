# Kubernetes

- Control Pane
- Nodes
- Deployment
- Pod
- Services
- kubectl - CLiente da linha de comando do kubernetes

## Minikube

> minikube start --driver=\<DRIVER\>

> minikube status

> minikube stop

> minikube dashboard

## Deploy

> kubetcl create deployment NOME --image=IMAGEM

> kubetcl get deployments

> kubectl describe deployments

> kubectl delete deployments

## Pods

> kubectl get pods

> kubetcl describe pods

## Config

> kubectl config view

## Service

> kubectl expose deployment NOME --type=TIPO --port=PORT

> kubectl expose deployments flask-deploy1 --type=LoadBalancer --port=5000

> minikube service NOME

> minikube service flask-deploy1

> kubectl get services

> kubectl describe services

> kubectl delete services

> kubectl scale deployment/NOME --replicas=NUMERO

### Replicas

> kubectl get rs

### Atualizar imagem

> kubectl set image deployment/NOME_SERVICE NOME_CONTAINER=IMAGEM

> kubectl set image deployment/flask-deploy1 flask-kub-projeto=davi1999gomes/flask-kub-projeto:v1


### Desfazer alteração

> kubectl rollout status deployment/NOME_SERVICE

> kubectl rollout undo deployment/NOME_SERVICE


### Modo declarativo

Guiado por um arquivo , semelhante ao docker compose (YAML) 

chaves mais utilizadas

- apiVersion 
- kind (Tipo de arquivo) 
- metadata
- replicas
- containers 

