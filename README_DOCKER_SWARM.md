# Docker Swarm - Resumo e Principais Comandos

O que é Docker Swarm?
Docker Swarm é uma ferramenta de orquestração de containers nativa do Docker que permite criar e gerenciar um cluster de máquinas Docker. Ele transforma múltiplos hosts Docker em um único host virtual.

# Conceitos Principais

- Manager Nodes: Nós que gerenciam o cluster e orquestram os serviços

- Worker Nodes: Nós que executam as tarefas (containers)

- Services: Definições de como containers devem ser executados

- Tasks: Instâncias individuais de containers

- Stack: Conjunto de serviços definidos em um arquivo compose

#### Inicializar um swarm

> docker swarm init

#### Inicializar swarm em IP específico

> docker swarm init --advertise-addr <IP>

#### Juntar um nó como worker ao swarm

> docker swarm join --token <WORKER_TOKEN> <MANAGER_IP>:2377

#### Juntar um nó como manager ao swarm

> docker swarm join-token manager

#### Listar nós do cluster

> docker node ls

#### Promover worker para manager

> docker node promote <NODE_ID>

#### Rebaixar manager para worker

> docker node demote <NODE_ID>

#### Remover nó do swarm

> docker node rm <NODE_ID>

#### Deixar o swarm

> docker swarm leave

#### Forçar saída do swarm (manager)

> docker swarm leave --force

# Gerenciamento de Serviços

#### Criar um serviço

> docker service create --name <SERVICE_NAME> <IMAGE>

#### Criar serviço com replicas

> docker service create --name <SERVICE_NAME> --replicas 3 <IMAGE>

#### Listar serviços

> docker service ls

#### Inspecionar um serviço

> docker service inspect <SERVICE_NAME>

#### Ver logs de um serviço

> docker service logs <SERVICE_NAME>

#### Escalar um serviço

> docker service scale <SERVICE_NAME>=5

#### Atualizar um serviço

> docker service update --image <NEW_IMAGE> <SERVICE_NAME>

#### Remover um serviço

> docker service rm <SERVICE_NAME>

#### Listar tarefas de um serviço

> docker service ps <SERVICE_NAME>

#### Fazer rollback de atualização

> docker service rollback <SERVICE_NAME>

# Gerenciamento de Stacks

#### Deploy de uma stack

> docker stack deploy -c docker-compose.yml <STACK_NAME>

#### Listar stacks

> docker stack ls

#### Listar serviços de uma stack

> docker stack services <STACK_NAME>

#### Remover uma stack

> docker stack rm <STACK_NAME>

#### Ver tarefas de uma stack

> docker stack ps <STACK_NAME>

# Rede no Swarm

#### Criar rede overlay

> docker network create -d overlay <NETWORK_NAME>

#### Listar redes

> docker network ls

#### Conectar serviço à rede

> docker service update --network-add <NETWORK_NAME> <SERVICE_NAME>

# Comandos Úteis para Troubleshooting

##### Ver informações do swarm

> docker system info

##### Ver estatísticas dos nós

> docker node ps $(docker node ls -q)

##### Ver detalhes de um nó

> docker node inspect <NODE_ID>

##### Drain mode (parar tarefas e não agendar novas)

> docker node update --availability drain <NODE_ID>

##### Reativar nó

> docker node update --availability active <NODE_ID>
