# 📚 Biblioteca PHP - Sistema de Gerenciamento de Bibliotecas

Este projeto é um sistema de gerenciamento de biblioteca desenvolvido em PHP utilizando o padrão de arquitetura MVC.

## 🏗️ Sobre o Padrão MVC

O padrão MVC (Model-View-Controller) é uma arquitetura de software que separa uma aplicação em três componentes principais, proporcionando uma estrutura organizada e modular para o desenvolvimento de sistemas. Esta separação de responsabilidades traz diversos benefícios ao desenvolvimento e manutenção de aplicações web.

### 🧩 Componentes do MVC

#### 💾 Model (Modelo)
- Representa a camada de dados e regras de negócio
- Responsável pela leitura e escrita de dados no banco de dados
- Valida os dados antes de armazená-los
- Contém a lógica de negócio da aplicação
- Não depende das outras camadas (View ou Controller)

#### 🖥️ View (Visão)
- Responsável pela interface com o usuário
- Exibe os dados ao usuário final
- Captura as entradas do usuário
- Envia as solicitações do usuário para o Controller

#### 🎮 Controller (Controlador)
- Atua como intermediário entre Model e View
- Processa as requisições do usuário
- Coordena qual model e qual view utilizar para cada ação
- Controla o fluxo da aplicação

### ⭐ Importância do Padrão MVC

1. **🔄 Separação de Responsabilidades**: Cada componente tem um papel bem definido, o que torna o código mais organizado e fácil de entender.

2. **🔧 Manutenção Simplificada**: Alterações em uma camada geralmente não afetam as outras, facilitando a manutenção e reduzindo o risco de introduzir bugs.

3. **👥 Desenvolvimento Paralelo**: Diferentes desenvolvedores podem trabalhar em diferentes componentes simultaneamente (um no front-end e outro no back-end, por exemplo).

4. **♻️ Reusabilidade de Código**: Os modelos podem ser reutilizados em diferentes partes da aplicação ou mesmo em projetos diferentes.

5. **🧪 Testabilidade**: A separação clara de responsabilidades facilita a criação de testes unitários e de integração.

6. **📈 Escalabilidade**: Aplicações MVC são naturalmente mais escaláveis, facilitando a adição de novas funcionalidades sem comprometer a estrutura existente.

7. **🔒 Segurança**: A separação entre a camada de apresentação e a camada de dados ajuda a prevenir vulnerabilidades como injeção de SQL.

8. **🔄 Adaptabilidade**: Facilita a adaptação a mudanças de requisitos ou tecnologias, podendo substituir componentes específicos sem afetar todo o sistema.

## 📂 Estrutura do Projeto

```
BibliotecaPhp/
├── app/
│   ├── controllers/    # Controladores da aplicação
│   ├── models/         # Modelos de dados e regras de negócio
│   └── views/          # Interfaces com o usuário
├── config/             # Configurações da aplicação
├── public/             # Ponto de entrada da aplicação e assets
└── README.md           # Este arquivo
```



