## 1 - crie um arquivo de sh(script) que irá roda mais tarde na app do serv linux
mkdir .script
echo . > deploy

## 2 - implemente as configurações em: 
.scripts/deploy.sh

## 4 - execute no servidor iniciar a criação da chave ssh:
ssh-keygen -t rsa -b 4096 -C gabrielrhodden@gmail.com

ssh-keygen -t ed25519 gabrielrhodden@gmail.com


ssh-keygen -t rsa -b 4096 -m PEM -C "gabrielrhodden@gmail.com"
ou
ssh-keygen -t ed25519 -C "gabrielrhodden@gmail.com"



## 5 - inseira o caminho onde quer que a chave seja salva: 
                                                                            (caminho)
Enter file in which to save the key (/home/gabriel_rhoden/.ssh/id_rsa): /home/gabriel_rhoden/.ssh/id_rsa

## 6 - nao precisa escolher senha para o proximo passo é so press enter
Enter passphrase (empty for no passphrase):

## 7.1 - Iniciar o agente SSH:
eval "$(ssh-agent -s)"

## 7.3 - Adicionar a chave pública ao arquivo authorized_keys
cat ~/.ssh/id_rsa.pub >> ~/.ssh/authorized_keys

## 7.4 - copie a chave publica
cat ~/.ssh/id_rsa.pub

## 8 No github em:
settings > Deploy keys > Add deploys Keys: de um nome para chave ex PROD_SERVER

## 9 - cole a chave criada em key e press:
add key

## IMPORTANTE O PRIMEIRO DEPLOY FAÇA 'MANUALMENTE' NO SERVIDOR:
1 - sudo apt-get update
2 - git clone git@github.com:GabrielRhoden86/api-rest-laravel-docker.git
3 - composer install
4 - cp .env.example .env
5 - php artisan key:generate
6 - php artisan optimize

## 1 - confirme que a pasta script esta no scrips subiu corretamente
ls -la .scripts

## 2 - execute no servidor para autorizar a permissão de acesso ao arquivo
chmod +x .scripts/deploy.sh

## EXECUTE NO SERVIDOR './':
./.scripts/deploy.sh
_______________________________
Obs: em caso de erro no git pull
git reset --hard HEAD
git pull

configure o o db caso necessário:
sudo mysql -u root -p

execute para liberar acesso:
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
FLUSH PRIVILEGES;

## ____________________________________PARTE 2 CONFIGURANDO WORKFLOWS GITHUB ACTIONS________________________________

## 1 - criar um novo arquivo chamado .github/workflows/deploy.yml
mkdir .github
mkdir .github\workflows
echo . > .github\workflows\deploy.yml

## 2 - implemente o código: .github\workflows\deploy.yml

## 3 - agora vamos criar as variaveis de ambiente que configuramos no github, vá em:
/settings/secrets/actions

## 4  - click em Repository secrets:
USERNAME: root
HOST: 172.21.66.8
PORT: 22
KEY: (coloque a chave ssh privada aqui)  execute:cat ~/.ssh/id_rsa

## TESTE 03
