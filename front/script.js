// Função para abrir o modal de cadastro
function abrirCadastroModal() {
    const modalcadastro = document.getElementById('modalcadastro');
    modalcadastro.style.display = 'block'; // Exibe o modal
}

// Evento de clique no botão de login para abrir o modal
const menucadastro = document.getElementById('menucadastro');
menucadastro.addEventListener('click', abrirCadastroModal);

//Função para fechar o modal de cadastro ao clicar no 'X'
function fecharCadastroModal() {
  const modalcadastro = document.getElementById('modalcadastro');
  modalcadastro.style.display = 'none';// Oculta o modal
  console.log("dnadasl")
} 

// Evento de clique no botão de fechar ('X') para fechar o modal
const closeBtn = document.getElementsByClassName('close')[0];
const closeBtn1 = document.getElementsByClassName('close')[1];
const closeBtn2 = document.getElementsByClassName('close')[2];
const closeBtn3 = document.getElementsByClassName('close')[3];
const closeBtn4 = document.getElementsByClassName('close')[4];
closeBtn.addEventListener('click', fecharCadastroModal);
closeBtn1.addEventListener('click', fecharHost);
closeBtn2.addEventListener('click', fecharhostindividual);
closeBtn3.addEventListener('click', fecharnotificacao); 
closeBtn4.addEventListener('click', fecharusuario);


// Função para abrir o modal de host
function abrirHost() {
    const modalhost = document.getElementById('modalhost');
    modalhost.style.display = 'block'; // Exibe o modal
}

// Evento de clique no botão de login para abrir o modal
const menuhost = document.getElementById('menuhost');
menuhost.addEventListener('click', abrirHost);

//Função para fechar o modal de cadastro ao clicar no 'X'
function fecharHost() {
  const modalhost = document.getElementById('modalhost');
  modalhost.style.display = 'none';// Oculta o modal
  console.log("dnadasl")
} 




// Função para abrir o modal de cadastro
function abrirmodalhostindividual() {
    const modalhostindividual = document.getElementById('modalhostindividual');
    modalhostindividual.style.display = 'block'; // Exibe o modal
}

// Evento de clique no botão de login para abrir o modal
const menuhostindividual = document.getElementById('menuhostindividual');
menuhostindividual.addEventListener('click', abrirmodalhostindividual);

//Função para fechar o modal de cadastro ao clicar no 'X'
function fecharhostindividual() {
  const modalhostindividual = document.getElementById('modalhostindividual');
  modalhostindividual.style.display = 'none';// Oculta o modal
  console.log("dnadasl")
}




// Função para abrir o modal de cadastro
function abrirnotificacao() {
    const modalnotificacao = document.getElementById('modalnotificacao');
    modalnotificacao.style.display = 'block'; // Exibe o modal
}

// Evento de clique no botão de login para abrir o modal
const notificacao = document.getElementById('notificacao');
notificacao.addEventListener('click', abrirnotificacao);

//Função para fechar o modal de cadastro ao clicar no 'X'
function fecharnotificacao() {
  const modalnotificacao = document.getElementById('modalnotificacao');
  modalnotificacao.style.display = 'none';// Oculta o modal
} 


// Função para abrir o modal de cadastro
function abrirusuario() {
    const modalusuario = document.getElementById('modalusuario');
    modalusuario.style.display = 'block'; // Exibe o modal
}

// Evento de clique no botão de login para abrir o modal
const usuario = document.getElementById('usuario');
usuario.addEventListener('click', abrirusuario);

//Função para fechar o modal de cadastro ao clicar no 'X'
function fecharusuario() {
  const modalusuario = document.getElementById('modalusuario');
  modalusuario.style.display = 'none';// Oculta o modal
} 

//Fução do buscador de equipamentos
function buscar(event) {
    event.preventDefault(); // Previne o envio do formulário padrão
    const query = document.getElementById('query').value;
    fetch('/TCCvalenet/back/buscador.php?query=' + encodeURIComponent(query))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = '';

            if (data.resultados.length > 0) {
                data.resultados.forEach(equipamento => {
                    const equipamentoDiv = document.createElement('div');
                    equipamentoDiv.innerHTML = `
                        <h3>Cliente CPF: ${equipamento.Cliente_CPF}</h3>
                        <h3>Funcionário Matrícula: ${equipamento.Funcionario_Matricula}</h3>
                        <p>IP: ${equipamento.IP}</p>
                        <p>Mac: ${equipamento.Mac}</p>
                        <p>Tipo: ${equipamento.Tipo}</p>
                        <p>Descrição: ${equipamento.Descricao}</p>
                        <hr>
                    `;
                    resultadosDiv.appendChild(equipamentoDiv);
                });
            } else {
                resultadosDiv.innerHTML = `<p>Nenhum resultado encontrado para "${data.query}"</p>`;
            }
        })
        .catch(error => {
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = `<p>Erro na busca: ${error.message}</p>`;
        });
}