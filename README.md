Plugin Ocultar Campos do Chamado para GLPI
Visão Geral do Projeto
O plugin "Ocultar Campos do Chamado" é uma extensão para o sistema GLPI que permite personalizar a visibilidade de campos específicos no formulário de tickets.
Características Principais
Funcionalidades

Ocultação Configurável

Campos ocultáveis:

Urgência
Impacto
Prioridade
Origem da Requisição
Status




Painel de Configuração

Interface administrativa
Ativação/desativação individual de campos
Salvamento dinâmico de configurações



Componentes do Plugin
Banco de Dados

Tabela: glpi_plugin_hideticketfields_configs
Campos:

hide_urgency: Ocultar campo de urgência
hide_impact: Ocultar campo de impacto
hide_priority: Ocultar campo de prioridade
hide_source: Ocultar origem da requisição
hide_status: Ocultar status



Recursos Técnicos
Segurança

Verificação de permissão de configuração
Proteção contra CSRF
Restrição de acesso

Personalização

Geração dinâmica de CSS
Ocultação via seletores CSS
Suporte a diferentes versões do GLPI

Tecnologias Utilizadas

Linguagem: PHP
Frontend: HTML, CSS
Framework: GLPI
Banco de Dados: MySQL

Fluxo de Funcionamento

Instalação do plugin
Configuração dos campos a serem ocultados
Geração dinâmica de CSS
Aplicação das regras de ocultação

Benefícios

Personalização da interface de tickets
Simplificação do formulário
Configuração intuitiva
Melhoria da experiência do usuário

Possíveis Melhorias

Configurações por perfil de usuário
Mais campos para ocultação
Opções de personalização avançadas
Suporte a internacionalização

Considerações Finais
O plugin "Ocultar Campos do Chamado" oferece uma solução flexível para simplificar e personalizar a interface de tickets no GLPI, proporcionando maior controle sobre a exibição de campos.
