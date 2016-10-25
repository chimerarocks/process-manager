# README #

Guia de instalação da aplicação.

## Summary ##

* Dependências
* Configuração da aplicação
* Configuração do script
* Apêndice

### Dependências ###

* PhantomJs
* Biblioteca browserify do node em modo global
* PHP 7
* Extensões Curl e Yaml para o php 7.

### Configuração da aplicação ###

* env.yaml
>Copie o arquivo env.yaml.exmpl para env.yaml no diretório root da aplicação com as seguinte configurações:


```
#!yaml

#caminho de execução do phantomjs (no Unix utilize "whereis phantomjs", copie o caminho e cole aqui)
phantomjs: (obrigatório)

#uri para requisição do bot, caso o host do bot seja um subdiretório
#por exemplo:
#a uri para a acessar o bot é 'http://127.0.0.1/bot', nesse caso o base_uri será '/bot'
#mas se o bot está no host raiz como 'http://127.0.0.1' então este campo deve ficar vazio
base_uri: (obrigatório no caso citado acima)

#caminho completo para a pasta resources da aplicação, onde ficarão as imagens dos captchas
#atenção: é obrigatório a barra no final do caminho: "resources/"
resource_path: (obrigatório)

#host onde se encontra o bot
host: (obrigatório) #http://api.bot.dev

#uri para acesso a action captchareader do bot
recon_path: (obrigatório) #/captchareader

debug: false

#dados de definição do banco de dados
db_driver: pdo_mysql #mantenha este
db_user: #root
db_password: #pass
db_dbname: #dbname
```
### Configuração do script ###

* config/crawling-conf.js
>Copie o arquivo config/crawling-conf.js.exmpl para config/crawling-conf.js com as seguinte configurações:

```
#!javascript

//host onde se encontra o bot
exports.host = "http://api.service.com.br";

//uri para acesso a action captchareader do bot
exports.recon_path = "/captchareader";

//debug options do script
exports.debug = {
	isRunning: false,
	seeConsole: false,
	holdCaptchaFilled: false,
	holdCaptcha: false,
	holdFinalPoint: false
};

//path completo para o diretório resources da aplicação
exports.resource_path = "/var/www/api.service.com.br/botdetran/resources/";
```

* Rodando o build
> Vá no diretório scripts e rode "npm run build" e pronto.

## Apêndice ##
* Instalação do Curl
* Instalação do Yaml
* Configuração do Apache

### Instalação do Curl ###
@Todo

### Instalação do Yaml ###
>pecl install yaml-dev
>apt-get install php7.0-dev
>verificar se está liberado no php.ini (cli e apache)

### Configuração do Apache ###
>Criar o vhost como no exemplo:

```
#!xml

<VirtualHost *:80> 
       ServerAdmin admin@service.com.br 
       ServerName api.service.com.br 
       SetEnv APPLICATION_ENV "development" 
       DocumentRoot /var/www/api.service.com.br/ 
       ErrorLog /var/www/api.service.com.br/tmp/log/apache/error.log 
       CustomLog /var/www/api.service.com.br/tmp/log/apache/access.log combined 
       <Directory /var/www/api.service.com.br> 
               Options Indexes FollowSymLinks MultiViews 
               AllowOverride All 
               Order allow,deny 
               allow from all 
       </Directory> 

</VirtualHost>
```


### Gerando Documentação ###
apidoc -i documentation/ -o public/apidoc