
const cepInput = document.getElementById('cep');
const cidadeInput = document.getElementById('cidade');
const ufInput = document.getElementById('uf');
const enderecoInput = document.getElementById('endereco');

cepInput.addEventListener('input', () => {
    let cep = cepInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    // Adiciona máscara ao CEP (ex: 12345-678)
    if (cep.length > 5) {
        cep = cep.slice(0, 5) + '-' + cep.slice(5);
    }
    cepInput.value = cep.slice(0,9);;

    // Faz a busca quando o CEP tiver 8 caracteres
    if (cep.length === 9) {
        fetch(`https://viacep.com.br/ws/${cep.replace('-', '')}/json/`)
            .then(response => {
                if (!response.ok) throw new Error('CEP não encontrado');
                return response.json();
            })
            .then(data => {
                if (data.erro) throw new Error('CEP inválido');
                // Preenche os campos com os dados retornados
                cidadeInput.value = data.localidade || '';
                ufInput.value = data.uf || '';
                enderecoInput.value = data.logradouro || '';
            })
            .catch(error => {
                alert('Erro ao buscar CEP: ' + error.message);
                cidadeInput.value = '';
                ufInput.value = '';
                enderecoInput.value = '';
            });
    }
});



// Máscara para CPF
const cpfInput = document.getElementById('cpf');
cpfInput.addEventListener('input', () => {
    let cpf = cpfInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    // Adiciona máscara no formato XXX.XXX.XXX-XX
    if (cpf.length > 3) cpf = cpf.slice(0, 3) + '.' + cpf.slice(3);
    if (cpf.length > 7) cpf = cpf.slice(0, 7) + '.' + cpf.slice(7);
    if (cpf.length > 11) cpf = cpf.slice(0, 11) + '-' + cpf.slice(11);

    cpfInput.value = cpf.slice(0, 14); // Limita o tamanho do CPF
});

// Máscara para Telefone
const telefoneInput = document.getElementById('phone');
telefoneInput.addEventListener('input', () => {
    let telefone = telefoneInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    // Adiciona máscara no formato (XX) XXXXX-XXXX
    if (telefone.length > 2) telefone = '(' + telefone.slice(0, 2) + ') ' + telefone.slice(2);
    if (telefone.length > 7) telefone = telefone.slice(0, 10) + '-' + telefone.slice(10);

    telefoneInput.value = telefone.slice(0, 15); // Limita o tamanho do telefone
});


