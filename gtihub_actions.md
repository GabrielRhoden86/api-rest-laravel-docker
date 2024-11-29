## 1 - crie um arquivo de sh(script) que irá roda mais tarde na app do serv linux
mkdir .script
echo . > deploy

## 2 - implemente as configurações em: 
.scripts/deploy.sh

## 3 - exceute no servidor para autorizar a permissão de acesso ao arquivo
chmod +x .scripts/deploy.sh

## 4 - execute no servidor iniciar a criação da chave ssh:
ssh-keygen -t rsa -b 4096 -C "gabrielrhodden@gmail.com"

## 4.1 - Iniciar o agente SSH:
eval "$(ssh-agent -s)"

## 4.2 - Iniciar o agente SSH:
ssh-add ~/.ssh/id_rsa

## 4.3 - Adicionar a chave pública ao arquivo authorized_keys
cat ~/.ssh/id_rsa.pub >> ~/.ssh/authorized_keys

## 4.4 - copie a chave publica
cat ~/.ssh/id_rsa.pub

## 5 No github em:
settings > Deploy keys: de um nova para chave ex PROD_SERVER

## 6 - cole a chave criada em key:
