# API RESTful desenvolvida no Lumen PHP Framework para Jogo de Poções 🧪🔮

Esta API foi criada para dar suporte a um projeto integrador destinado a um aplicativo mobile, no qual os usuários podem participar de um emocionante jogo de poções envolvendo compra e venda desses itens mágicos. A API oferece operações completas, incluindo inserção, atualização e exclusão de poções, todas acessíveis através de rotas de API. Os usuários podem fornecer uma rota específica e receber os dados em formato JSON, contendo informações sobre as rotas disponíveis. Além disso, a API implementa um sistema de autenticação baseado em tokens para garantir o acesso seguro às rotas, ao mesmo tempo em que oferece um tratamento de erros eficiente, incluindo códigos HTTP apropriados. ✨🎩

## Recursos Principais 🚀

- **Operações de Poções:** A API permite aos usuários comprar, vender, inserir, atualizar e excluir poções por meio de suas rotas dedicadas. 💰🛍️

- **Retorno JSON:** Os dados são retornados no formato JSON, facilitando o processamento e a integração com diferentes sistemas. 📦🔗

- **Autenticação com Token:** O acesso às rotas é protegido por autenticação baseada em tokens, garantindo que apenas usuários autorizados possam interagir com a API. 🔐🔑

- **Tratamento de Erros Avançado:** A API oferece tratamento adequado de erros, incluindo códigos HTTP descritivos, para uma experiência de usuário mais amigável. 🚦🔧

## Como Usar

1. **Autenticação:** Antes de usar a API, obtenha um token de autenticação através de um processo de autenticação apropriado.

2. **Rotas Disponíveis:** Consulte a lista de rotas disponíveis e suas funcionalidades:

### Poções

- **Listar todas as Poções:** `GET /pocoes` (Rota: `pocoes.all`)
- **Recuperar uma Poção por ID:** `GET /pocoes/{id}` (Rota: `pocoes.one`)
- **Criar uma Nova Poção:** `POST /pocoes` (Rota: `pocoes.store`)
- **Atualizar uma Poção:** `PUT /pocoes/{id}` (Rota: `pocoes.update`)
- **Excluir uma Poção:** `DELETE /pocoes/{id}` (Rota: `pocoes.delete`)

### Inventário

- **Listar todos os Itens do Inventário:** `GET /inventario` (Rota: `inventario.all`)
- **Recuperar um Item do Inventário por ID:** `GET /inventario/{id}` (Rota: `inventario.one`)
- **Adicionar um Novo Item ao Inventário:** `POST /inventario` (Rota: `inventario.store`)
- **Atualizar um Item do Inventário:** `PUT /inventario/{id}` (Rota: `inventario.update`)
- **Remover um Item do Inventário:** `DELETE /inventario/{id}` (Rota: `inventario.delete`)



