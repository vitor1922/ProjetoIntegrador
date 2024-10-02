// Arquivo app.js

// Seleciona o formulário e a tabela de estoque
const form = document.getElementById('addForm');
const tabelaEstoque = document.getElementById('estoqueTabela').getElementsByTagName('tbody')[0];

// Função para adicionar produtos
form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Pegar os valores dos campos de entrada
    const produto = document.getElementById('produto').value;
    const quantidade = document.getElementById('quantidade').value;

    // Criar uma nova linha para a tabela
    const novaLinha = document.createElement('tr');

    // Adicionando as colunas para o produto e a quantidade
    novaLinha.innerHTML = `
        <td>${produto}</td>
        <td>${quantidade}</td>
        <td><button class="remove-btn" onclick="removerProduto(this)">Remover</button></td>
    `;

    // Adicionar a nova linha à tabela
    tabelaEstoque.appendChild(novaLinha);

    // Limpar os campos do formulário
    form.reset();
});

// Função para remover produtos
function removerProduto(botao) {
    // Encontrar a linha do botão clicado e removê-la
    const linha = botao.parentNode.parentNode;
    linha.remove();
}
