//+++++++++++++++++++++++++++++++++++ CARRINHO ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


function fetchParaCarrinho() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'listarCarrinho.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            atualizarCarrinhoAutomaticamente(data);
        } else {
            // console.error('Erro na requisição AJAX: ', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Erro na requisição AJAX');
    };
    xhr.send();
}





function atualizarCarrinhoAutomaticamente(data) {
    const itemElement = document.getElementById('listagemCarrinho');

    if (itemElement) {

        itemElement.innerHTML = '';


        data.carrinho.forEach(item => {
            const colImg = document.createElement('div');
            colImg.classList.add('col-lg-3', 'col-5', 'mt-4');

            const imgEpiCarrinho = document.createElement('img');
            imgEpiCarrinho.classList.add('text-center');
            imgEpiCarrinho.setAttribute('width', '100%');
            imgEpiCarrinho.id = 'imgEpiCarrinho';
            imgEpiCarrinho.src = `./img/produtos/${item.foto}`;
            colImg.appendChild(imgEpiCarrinho);
            itemElement.appendChild(colImg);

            const divCorpoProduto = document.createElement('div');
            divCorpoProduto.classList.add('col-lg-9', 'col-7', 'mt-4')

            const nomeEpiCarrinho = document.createElement('h3');
            nomeEpiCarrinho.id = 'nomeEpiCarrinho';
            nomeEpiCarrinho.innerText = `${item.nome}`;
            nomeEpiCarrinho.classList.add('mb-4');
            divCorpoProduto.appendChild(nomeEpiCarrinho);
            itemElement.appendChild(divCorpoProduto);

            const certificadoEpiCarrinho = document.createElement('p');
            certificadoEpiCarrinho.id = 'certificadoEpiCarrinho';
            certificadoEpiCarrinho.innerText = `Certificado de Aprovação: ${item.certificado}`;
            divCorpoProduto.appendChild(certificadoEpiCarrinho);
            itemElement.appendChild(divCorpoProduto);


            const qtdLG = document.createElement('div');
            qtdLG.classList.add('px-3');
            qtdLG.classList.add('align-items-center', 'd-flex');
            qtdLG.id = 'qtdLG';
            qtdLG.innerText = `${item.quantidade}`;

            const botaoMais = document.createElement('button');
            botaoMais.classList.add('btn', 'btn-sm', 'btn-success', 'px-3');
            botaoMais.innerText = '+';
            botaoMais.addEventListener('click', function () {
                aumentarQuantidade(`${item.idproduto}`)
            })

            const botaoMenos = document.createElement('button');
            botaoMenos.classList.add('btn', 'btn-sm', 'btn-warning', 'px-3');
            botaoMenos.innerText = '-';
            if (item.quantidade == 1) {
                botaoMenos.setAttribute('disabled', 'disabled');
            }
            botaoMenos.addEventListener('click', function () {
                diminuirQuantidade(`${item.idproduto}`)
            })

            const btnRemover = document.createElement('button')
            btnRemover.classList.add('btn', 'btn-sm', 'btn-danger', 'px-4')
            btnRemover.innerHTML = '<i class="bi bi-trash"></i>'

            btnRemover.addEventListener('click', function () {
                excluirItem(`${item.idproduto}`)
            })

            const divQtdGrupo = document.createElement('div');
            divQtdGrupo.classList.add('d-flex')

            const divBotoesCarrinho = document.createElement('div')
            divBotoesCarrinho.classList.add('d-flex', 'justify-content-between', 'align-items-center','margemTop')


            divQtdGrupo.appendChild(botaoMais);
            divQtdGrupo.appendChild(qtdLG);
            divQtdGrupo.appendChild(botaoMenos);

            divBotoesCarrinho.appendChild(divQtdGrupo);
            divBotoesCarrinho.appendChild(btnRemover);

            divCorpoProduto.appendChild(divBotoesCarrinho)
            itemElement.appendChild(divCorpoProduto)

        });
        const btnConcluirAluguel = document.getElementById('btnConcluirAluguel');

        if (data.qtdTotalCarrinho === 0) {
            btnConcluirAluguel.setAttribute('disabled', 'disabled');

        }

    }
}

setInterval(fetchParaCarrinho, 500);


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
