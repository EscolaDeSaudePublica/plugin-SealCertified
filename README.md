# Plugin que gera selos para certificado
Esse plugin tem a finalidade de gerar um selo e configurar a uma oportunidade ou agente, dando a possibilidade do agente imprimir um certificado devidamente configurado

### Passos para instalação

Além de tudo, deve serguir os passos de instalação e configuração da documentação oficial nesse [link](https://github.com/mapasculturais/mapasculturais/wiki/Forma%C3%A7%C3%A3o-b%C3%A1sica-para-desenvolvedores#plugins) .


Habilitar um plugin inicial, pois esse plugin herda os métodos desse plugin.

`'SealModelTab' => ['namespace' => 'SealModelTab' ],`

Depois deve habilitar esse plugin (_SealCertified_)

`'SealCertified' => [
    'namespace' => 'SealCertified',
    'config' => [
        'logo-site' => 'img/logo-saude.png'
    ]
],`


### Observações
Substituir o nome _logo-saude.png_ pelo nome que da logo que está no seu tema em assets/img
Substituir o arquivo _seal-certified--preview.jpg_ pelo arquivo que deseja mostar como preview
Pode ocorrer a necessidade de habilitar o plugin dentro do arquivo **plugins.php** em src/protected/aplication/conf/conf-base.d e dentro do tema também em **conf-base.php**
Dentro da repositorio plugins na aplicação do mapas, deve trocar o nome da pasta apos o clone para SealCertified, poderá digitar o seguinte comando:

`mv plugin-SealCertified SealCertified`


