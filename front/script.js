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






document.getElementById('btn-enter').onclick = function() {
  var selectedOption = document.querySelector('input[name="cadastro"]:checked');
  
  if (selectedOption) {
    var modalId = 'modal' + selectedOption.value;
    var modal = document.getElementById(modalId);
    var mainModal = document.getElementById('modalcadastro');
    
    if (modal) {
      mainModal.style.display = 'none';
      modal.style.display = 'block';
      
      var closeBtns = modal.getElementsByClassName('close');
      for (var i = 0; i < closeBtns.length; i++) {
        closeBtns[i].onclick = function() {
          modal.style.display = 'none';
          mainModal.style.display = 'block';
        };
      }
    }
  }
};

window.onclick = function(event) {
  var modals = document.getElementsByClassName('modal');
  for (var i = 0; i < modals.length; i++) {
    if (event.target == modals[i]) {
      modals[i].style.display = 'none';
      document.getElementById('modalcadastro').style.display = 'block';
    }
  }
};

document.getElementById('close').onclick = function() {
  document.getElementById('modalcadastro').style.display = 'none';
};




$(document).ready(function() {
  // Fazer uma requisição AJAX para obter o link do PHP
  $.ajax({
      url: '/TCCVALENET/back/host.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
          if (data.link) {
              $('#iframe-display1').attr('src', data.link);
          } else {
              $('#iframe-display1').attr('src', ''); // Caso não tenha link, limpa o iframe
          }
      },
      error: function() {
          console.error('Erro ao buscar o link do banco de dados.');
      }
  });

  // Adicionar evento de clique no iframe-display1
  $('#iframe-display1').on('click', function() {
      var link = $(this).attr('src');
      if (link) {
          // Atualiza o iframe dentro do modal individual
          $('#iframe-display').attr('src', link);

          // Abre o modal individual
          $('#modalhostindividual').show();
      }
  });

  // Inicializar o Select2 na lista suspensa
  $('#categorias').select2();

  // Requisição AJAX para buscar categorias do arquivo PHP
  $.ajax({
      url: '/TCCVALENET/back/lista.php',
      dataType: 'json',
      success: function(data) {
          // Iterar sobre os dados retornados e adicionar opções à lista suspensa
          $.each(data, function(index, item) {
              $('#categorias').append('<option value="' + item.link + '">' + item.Tipo + " " + item.IP + '</option>');
          });

          // Atualizar o Select2 para refletir as novas opções adicionadas dinamicamente
          $('#categorias').trigger('change');
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.error('Erro ao carregar categorias: ' + textStatus, errorThrown);
      }
  });

  // Adicionar função para exibir o iframe
  $('#categorias').on('change', function() {
      var selectedValue = $(this).val();
      var iframeDisplay = $('#iframe-display');

      if (selectedValue) {
          iframeDisplay.attr('src', selectedValue);
      } else {
          iframeDisplay.attr('src', '');
      }
  });

  // Fechar modais
  $('#close1').on('click', function() {
      $('#modalhost').hide();
  });

  $('#close2').on('click', function() {
      $('#modalhostindividual').hide();
  });
});