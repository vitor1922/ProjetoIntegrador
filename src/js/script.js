// // Selecionar o formulário e a tabela
// const form = document.getElementById('estoqueForm');
// const tabelaEstoque = document.getElementById('estoqueTabela');

// // Função para remover um produto da lista
// function removerProduto(botao) {
//     const row = botao.parentNode.parentNode;
//     row.parentNode.removeChild(row);
// }

// // Função para adicionar um produto à lista
// form.addEventListener('submit', function(event) {
//     event.preventDefault();

//     // Obter valores dos campos de entrada
//     const produto = document.getElementById('produto').value;
//     const quantidade = document.getElementById('quantidade').value;

//     // Criar uma nova linha na tabela
//     const novaLinha = document.createElement('tr');
//     novaLinha.innerHTML = `
//         <td>${produto}</td>
//         <td>${quantidade}</td>
//         <td><button onclick="removerProduto(this)">Remover</button></td>
//     `;

//     // Adicionar a nova linha à tabela
//     tabelaEstoque.appendChild(novaLinha);

//     // Limpar os campos do formulário
//     document.getElementById('produto').value = '';
//     document.getElementById('quantidade').value = '';
// });

function mostrarOcultarSenha(){
    let senha=document.querySelector(".txtSenha")
    if(senha.type=="password"){
        senha.type = "text"
    }else{
        senha.type="password"
    }
}


