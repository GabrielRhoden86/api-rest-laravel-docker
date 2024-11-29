## 1 - crie um arquivo de sh(script) que irá roda mais tarde na app do serv linux
mkdir .script
echo . > deploy

## 2 - implemente as configurações em: 
.scripts/deploy.sh


## 4 - execute no servidor iniciar a criação da chave ssh:
ssh-keygen -t rsa -b 4096 -C "gabrielrhodden@gmail.com"

## inseira o caminho onde quer que a chave seja salva:
                                                                            (caminho)
Enter file in which to save the key (/home/gabriel_rhoden/.ssh/id_rsa): /home/gabriel_rhoden/.ssh/id_rsa

## nao precisa escolher senha para o proximo passo é so press enter
Enter passphrase (empty for no passphrase):

## 4.1 - Iniciar o agente SSH:
eval "$(ssh-agent -s)"

## 4.2 - Iniciar o agente SSH:
ssh-add ~/.ssh/id_rsa

## 4.3 - Adicionar a chave pública ao arquivo authorized_keys
cat ~/.ssh/id_rsa.pub >> ~/.ssh/authorized_keys

## 4.4 - copie a chave publica
cat ~/.ssh/id_rsa.pub

## 5 No github em:
settings > Deploy keys > Add deploys Keys: de um nome para chave ex PROD_SERVER

## 6 - cole a chave criada em key e press:
add key

## IMPORTANTE O PRIMEIRO DEPLOY FAÇA 'MANUALMENTE' NO SERVIDOR:
1 - sudo apt-get update
2 - git clone git@github.com:GabrielRhoden86/api-rest-laravel-docker.git
3 - composer install
4 - cp .env.example .env
5 - php artisan key:generate
6 - php artisan optimize


## execute no servidor para autorizar a permissão de acesso ao arquivo
chmod +x .scripts/deploy.sh

## EXECUTE NO SERVIDOR './':
./scripts/deploy.sh

