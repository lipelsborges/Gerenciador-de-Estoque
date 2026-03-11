# ✈️ FLY BY DAY - Gerenciamento de Estoque

O **FLY BY DAY** é um sistema completo de controle de inventário, desenvolvido em PHP com foco em organização modular e facilidade de gestão para múltiplos pontos de venda.

---

## 📊 Dashboard de Indicadores
A interface principal (construída com **Bootstrap 5**) oferece uma visão gerencial imediata:
* **Cards de Resumo:** Contagem total de produtos, fornecedores e lojas.
* **Alertas de Validade:** Identificação visual de produtos vencidos ou próximos ao vencimento (janela de 30 dias).
* **Controle de Ruptura:** Monitoramento de itens com estoque crítico (unidades < 5).
* **Filtros de Relatório:** Atalhos rápidos para consultas por loja e fornecedor.

---

## 📂 Estrutura de Pastas e Módulos

O projeto é separado por responsabilidades para facilitar a manutenção:

### 📦 Módulos de Gestão
* `/estoque`: Controle de movimentação (entradas e saídas).
* `/fornecedores`: Gestão de parceiros comerciais.
* `/lojas`: Administração de unidades físicas.
* `/produtos`: Catálogo técnico (preços, quantidades e validades).
* `/usuarios`: Administração de perfis de acesso.
* `/relatorios`: Consultas filtradas e análises de estoque baixo.

### ⚙️ Núcleo do Sistema (Back-end)
* `/src`: Centraliza a inteligência e regras de negócio.
    * `banco.php`: Conexão PDO segura com o banco de dados.
    * `autenticacao.php`: Core de segurança (`exigirLogin()` e `logout()`).
    * `*_crud.php`: Funções de banco de dados separadas por módulo.
    * `utils.php`: Funções auxiliares de formatação.

### 🎨 Front-end e Layout
* `/includes`: Peças reutilizáveis (`cabecalho.php` e `rodape.php`).
* `/css` & `/js`: Estilização e scripts de interatividade.
* `.htaccess`: Configurações de servidor e rotas.

---

## 🔐 Segurança e Autenticação
O sistema implementa camadas de proteção robustas:
1. **Proteção de Rotas:** A função `exigirLogin()` bloqueia o acesso de usuários não autenticados.
2. **Logout Centralizado:** A função `logout()` em `src/autenticacao.php` encerra a sessão e limpa os dados com segurança.
3. **Caminhos Dinâmicos:** Uso de `__DIR__` em inclusões para garantir o carregamento correto em qualquer diretório.

---

## 🛠️ Tecnologias Utilizadas
* **PHP 8.x** (Lógica e Processamento)
* **MySQL** (Persistência de Dados)
* **Bootstrap 5** (Layout Responsivo e Componentes de Alerta)
* **Font Awesome** (Ícones da Interface)

---

## 🔧 Configuração Rápida
1. Configure as credenciais do banco em `src/banco.php`.
2. Certifique-se de que o servidor (XAMPP/WAMP) está lendo o arquivo `.htaccess`.
3. Acesse `index.php` para o dashboard ou `login.php` para autenticação.

---
**Desenvolvido por Felipe Leonardo Santana Borges** 🚀