# Sistema de Login com PHP e MySQL

Este projeto é um sistema de login simples utilizando PHP e MySQL

## 🚀 Tecnologias Utilizadas
- PHP
- MySQL
- HTML/CSS
- JavaScript
- XAMPP: Ambiente de desenvolvimento local (Apache + MySQL)

## ⚡ Como executar o projeto

1. **Clone o repositório**:
   ```sh
   git clone https://github.com/Viniciusmq25/Login_Register.git

2. **Configure o banco de dados no XAMPP**:

    - Abra o phpMyAdmin no navegador.
    - Crie um banco de dados chamado, por exemplo, login_register.
    - Importe o arquivo banco.sql (se você tiver criado um dump do banco de dados).

3. **Configure a conexão no arquivo config.php: Atualize as credenciais do banco de dados:**
    ```sh 
    <?php
    $servername = "localhost";
    $username = "root"; // Usuário padrão do XAMPP
    $password = "";     // Senha padrão do XAMPP
    $dbname = "login_register";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    ?>

4. **Inicie o servidor local:**

    - Abra o painel de controle do XAMPP.
    - Inicie os serviços Apache e MySQL.
    - Navegue até a pasta do projeto no navegador:
        ```sh
        http://localhost/LOGIN_REGISTER/
        