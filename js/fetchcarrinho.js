//+++++++++++++++++++++++++++++++++++ CARRINHO ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function fetchParaCarrinho() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'listarCarrinho.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            atualizarCarrinhoAutomaticamente(data);
        } else {
            console.error('Erro na requisição AJAX: ', xhr.statusText);
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
            const colItem = document.createElement('div')
            colItem.classList.add('col-lg-6', 'col-md-12', 'col-12')

            const card = document.createElement('div');
            card.classList.add('card', 'mb-3');

            const row = document.createElement('div');
            row.classList.add('row', 'g-0');

            const colImg = document.createElement('div');
            colImg.classList.add('col-md-3','d-flex', 'justify-content-center', 'align-items-center');

            const imgEpiCarrinho = document.createElement('img');
            imgEpiCarrinho.classList.add('img-fluid', 'rounded-start');
            imgEpiCarrinho.setAttribute('title',item.nome)
            imgEpiCarrinho.src = `./img/produtos/${item.foto}`;
            imgEpiCarrinho.alt = item.nome;
            colImg.appendChild(imgEpiCarrinho);

            const colBody = document.createElement('div');
            colBody.classList.add('col-md-9');

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            const nomeEpiCarrinho = document.createElement('h5');
            nomeEpiCarrinho.classList.add('card-title','tituloDoCardCarrinho');
            nomeEpiCarrinho.innerText = item.nome;
            cardBody.appendChild(nomeEpiCarrinho);

            const certificadoEpiCarrinho = document.createElement('p');
            certificadoEpiCarrinho.classList.add('card-text');
            certificadoEpiCarrinho.innerText = `Certificado de Aprovação: ${item.certificado}`;
            cardBody.appendChild(certificadoEpiCarrinho);

            const qtdLG = document.createElement('div');
            qtdLG.classList.add('px-3', 'align-items-center', 'd-flex');
            qtdLG.id = 'qtdLG';
            qtdLG.innerText = `${item.quantidade}`;

            const botaoMais = document.createElement('button');
            botaoMais.classList.add('btn', 'btn-sm', 'btn-success', 'rounded-bolinha');
            botaoMais.innerText = '+';
            botaoMais.addEventListener('click', function () {
                aumentarQuantidade(`${item.idproduto}`);
            });

            const botaoMenos = document.createElement('button');
            botaoMenos.classList.add('btn', 'btn-sm', 'btn-warning', 'rounded-bolinha');
            botaoMenos.innerText = '-';
            if (item.quantidade == 1) {
                botaoMenos.setAttribute('disabled', 'disabled');
            }
            botaoMenos.addEventListener('click', function () {
                diminuirQuantidade(`${item.idproduto}`);
            });

            const btnRemover = document.createElement('button');
            btnRemover.classList.add('btn', 'btn-sm', 'btnVermelhoRonan', 'px-5', 'rounded-2');
            btnRemover.innerHTML = '<i class="bi bi-trash"></i>';
            btnRemover.addEventListener('click', function () {
                excluirItem(`${item.idproduto}`);
            });

            const divQtdGrupo = document.createElement('div');
            divQtdGrupo.classList.add('d-flex');

            const divBotoesCarrinho = document.createElement('div');
            divBotoesCarrinho.classList.add('d-flex','justify-content-center', 'align-items-center', 'margemTop');


            divBotoesCarrinho.appendChild(divQtdGrupo);
            divBotoesCarrinho.appendChild(btnRemover);

            cardBody.appendChild(divBotoesCarrinho);
            colBody.appendChild(cardBody);
            row.appendChild(colImg);
            row.appendChild(colBody);
            card.appendChild(row);
            colItem.appendChild(card)

            itemElement.appendChild(colItem);
        });

        const btnConcluirAluguel = document.getElementById('btnConcluirAluguel');

        if (data.qtdTotalCarrinho === 0) {
            btnConcluirAluguel.setAttribute('disabled', 'disabled');
        }
    }
}


setInterval(fetchParaCarrinho, 500);


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
