const dicas = [
    {
      imagem: 'img/imagem1.jpg',
      textoID: 'textoDica1'
    },
    {
      imagem: 'img/imagem2.jpg',
      textoID: 'textoDica2'
    },
    {
      imagem: 'img/imagem3.jpg',
      textoID: 'textoDica3'
    }
  ];
  
  let indiceAtual = 0;
  
  window.onload = function() {
    exibirDicaAtual();
  };
  
  function mudarDica() {
    indiceAtual = (indiceAtual + 1) % dicas.length;
    exibirDicaAtual();
  }
  
  function exibirDicaAtual() {
    document.getElementById('imagemDica').style.backgroundImage = `url('${dicas[indiceAtual].imagem}')`;
  
    for (let i = 0; i < dicas.length; i++) {
      const elemento = document.getElementById(dicas[i].textoID);
      elemento.style.display = 'none';
    }
  
    document.getElementById(dicas[indiceAtual].textoID).style.display = 'block';
  }
  
  function mostrarMais(idMaisInfo) {
    const elementoMaisInfo = document.getElementById(idMaisInfo);
    elementoMaisInfo.style.display = 'block';
  }
  
  function ocultarMaisInfo() {
    const elementosMaisInfo = document.querySelectorAll('[id^="maisInfo"]');
    elementosMaisInfo.forEach(elemento => {
      elemento.style.display = 'none';
    });
  }