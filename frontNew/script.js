
function abrirCadastroModal() {
    const modalcadastro = document.getElementById('modalcadastro');
    modalcadastro.style.display = 'block'; 
}


const menucadastro = document.getElementById('menucadastro');
menucadastro.addEventListener('click', abrirCadastroModal);


function fecharCadastroModal() {
  const modalcadastro = document.getElementById('modalcadastro');
  modalcadastro.style.display = 'none';
  console.log("dnadasl")
} 


const closeBtn = document.getElementById('close');
const closeBtn1 = document.getElementById('close1');
const closeBtn2 = document.getElementById('close2');
const closeBtn3 = document.getElementById('close3');
const closeBtn4 = document.getElementById('close4');
closeBtn.addEventListener('click', fecharCadastroModal);
closeBtn1.addEventListener('click', fecharHost);
closeBtn2.addEventListener('click', fecharhostindividual);
closeBtn3.addEventListener('click', fecharnotificacao); 
closeBtn4.addEventListener('click', fecharusuario);



function abrirHost() {
    const modalhost = document.getElementById('modalhost');
    modalhost.style.display = 'block'; 
}


const menuhost = document.getElementById('menuhost');
menuhost.addEventListener('click', abrirHost);


function fecharHost() {
  const modalhost = document.getElementById('modalhost');
  modalhost.style.display = 'none';
  console.log("dnadasl")
} 





function abrirmodalhostindividual() {
    const modalhostindividual = document.getElementById('modalhostindividual');
    modalhostindividual.style.display = 'block'; 
}


const menuhostindividual = document.getElementById('menuhostindividual');
menuhostindividual.addEventListener('click', abrirmodalhostindividual);


function fecharhostindividual() {
  const modalhostindividual = document.getElementById('modalhostindividual');
  modalhostindividual.style.display = 'none';
  console.log("dnadasl")
}





function abrirnotificacao() {
    const modalnotificacao = document.getElementById('modalnotificacao');
    modalnotificacao.style.display = 'block'; 
}


const notificacao = document.getElementById('notificacao');
notificacao.addEventListener('click', abrirnotificacao);


function fecharnotificacao() {
  const modalnotificacao = document.getElementById('modalnotificacao');
  modalnotificacao.style.display = 'none';
} 



function abrirusuario() {
    const modalusuario = document.getElementById('modalusuario');
    modalusuario.style.display = 'block'; 
}


const usuario = document.getElementById('usuario');
usuario.addEventListener('click', abrirusuario);


function fecharusuario() {
  const modalusuario = document.getElementById('modalusuario');
  modalusuario.style.display = 'none';// Oculta o modal
} 
