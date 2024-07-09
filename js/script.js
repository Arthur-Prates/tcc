function fazerLogin() {
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;
    var alertlog = document.getElementById("alertlog");

    if (email === "") {
        alertlog.style.display = "block";
        alertlog.innerHTML =
            "Email não digitado.";
        return;
    } else if (senha === "") {
        alertlog.style.display = "block";
        alertlog.innerHTML =
            "Senha não digitada.";
        return;
    } else if (senha.length < 8) {
        alertlog.style.display = "block";
        alertlog.innerHTML = "Mínimo de 8 digitos.";
        return;
    } else {
        alertlog.style.display = "none";
    }
    mostrarProcessando();
    fetch("login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
            "email=" +
            encodeURIComponent(email) +
            "&senha=" +
            encodeURIComponent(senha),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data)
            if (data.success) {
                setTimeout(function () {
                    window.location.href = "index.php";
                }, 3000);
                //alert(data.message);
                alertlog.classList.remove("erroBonito");
                alertlog.classList.add("acertoBonito");
                alertlog.innerHTML = data.message;
                alertlog.style.display = "block";
            } else {
                alertlog.style.display = "block";
                alertlog.innerHTML = data.message;
                esconderProcessando();

            }
            // esconderProcessando();
        })
        .catch((error) => {
            console.error("Erro na requisição", error);
        });
}

// FUNCAO DE LOADING
function mostrarProcessando() {
    var divFundoEscuro = document.createElement('div');
    divFundoEscuro.id = 'fundoEscuro';
    divFundoEscuro.style.position = 'fixed';
    divFundoEscuro.style.top = '0';
    divFundoEscuro.style.left = '0';
    divFundoEscuro.style.width = '100%';
    divFundoEscuro.style.height = '100%';
    divFundoEscuro.style.backgroundColor = 'rgba(0,0,0,0.7)';
    document.body.appendChild(divFundoEscuro);

    var divProcessando = document.createElement("div");
    divProcessando.id = "processandoDiv";
    divProcessando.style.position = "fixed";
    divProcessando.style.top = "50%";
    divProcessando.style.left = "50%";
    divProcessando.style.transform = "translate(-50%, -50%)";
    // divProcessando.innerHTML = '<img src="../img/loading.gif" width="80px" alt="Processando..." title="Processando...">';
    divProcessando.innerHTML = '<dotlottie-player autoplay loop mode="normal" src="./img/loadingjson.json" style="width: 140px;"></dotlottie-player>'
    document.body.appendChild(divProcessando);
}

function fazerLoginAdm() {
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;
    var alertlog = document.getElementById("alertlog");

    if (email === "") {
        alertlog.style.display = "block";
        alertlog.innerHTML =
            "Email não digitado.";
        return;
    } else if (senha === "") {
        alertlog.style.display = "block";
        alertlog.innerHTML =
            "Senha não digitada.";
        return;
    } else if (senha.length < 8) {
        alertlog.style.display = "block";
        alertlog.innerHTML = "Mínimo de 8 digitos.";
        return;
    } else {
        alertlog.style.display = "none";
    }
    mostrarProcessandoAdm();
    fetch("login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
            "email=" +
            encodeURIComponent(email) +
            "&senha=" +
            encodeURIComponent(senha),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data)
            if (data.success) {
                setTimeout(function () {
                    window.location.href = "dashboard.php";
                    esconderProcessando();
                }, 3000);
                //alert(data.message);
                alertlog.classList.remove("erroBonito");
                alertlog.classList.add("acertoBonito");
                alertlog.innerHTML = data.message;
                alertlog.style.display = "block";
            } else {
                alertlog.style.display = "block";
                alertlog.innerHTML = data.message;
                esconderProcessando();

            }
        })
        .catch((error) => {
            console.error("Erro na requisição", error);
        });
}

// FUNCAO DE LOADING
function mostrarProcessandoAdm() {
    var divFundoEscuro = document.createElement('div');
    divFundoEscuro.id = 'fundoEscuro';
    divFundoEscuro.style.position = 'fixed';
    divFundoEscuro.style.top = '0';
    divFundoEscuro.style.left = '0';
    divFundoEscuro.style.width = '100%';
    divFundoEscuro.style.height = '100%';
    divFundoEscuro.style.backgroundColor = 'rgba(0,0,0,0.7)';
    document.body.appendChild(divFundoEscuro);

    var divProcessando = document.createElement("div");
    divProcessando.id = "processandoDiv";
    divProcessando.style.position = "fixed";
    divProcessando.style.top = "50%";
    divProcessando.style.left = "50%";
    divProcessando.style.transform = "translate(-50%, -50%)";
    // divProcessando.innerHTML = '<img src="../img/loading.gif" width="80px" alt="Processando..." title="Processando...">';
    divProcessando.innerHTML = '<dotlottie-player autoplay loop mode="normal" src="../img/loadingjson.json" style="width: 140px;"></dotlottie-player>'
    document.body.appendChild(divProcessando);
}


// FUNCAO DE ESCONDER O LOADING
function esconderProcessando() {
    var divProcessando = document.getElementById("processandoDiv");
    var divFundo = document.getElementById('fundoEscuro');
    if (divProcessando) {
        document.body.removeChild(divProcessando);
        document.body.removeChild(divFundo);
    }
}

function carregarConteudo(controle) {
    fetch('controle.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'controle=' + encodeURIComponent(controle),
    })
        .then(response => response.text())
        .then(data => {

            document.getElementById('show').innerHTML = data;
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
        });
}

$('.cpf').mask('000.000.000-00');
$('.cnpj').mask('00.000.000/0000-00');
$('.rgAntigo').mask('xx-00.000.000');
$('.rgNovo').mask('000.000.000-00');
$('.cep').mask('00.000-000');
$('.celular').mask('(00) 0 0000-0000');
$('.telefone').mask('(00) 0000-0000');
$('.dinheiro').mask('000.000.000.000.000,00', {reverse: true});


function abrirModalJsExcluirAluguel(id, inID, innome, idNome, nomeModal, dataTime, abrirModal, botao, addEditDel, inFocus, inFocusValue, formulario) {
    const formDados = document.getElementById(`${formulario}`);
    let formEnviado = false;

    var botoes = document.getElementById(`${botao}`);
    const ModalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`));

    const submitHandler = function (event) {
        event.preventDefault();

        botoes.disabled = true;

        const form = event.target;
        const formData = new FormData(form);

        if (dataTime !== 'nao') {
            formData.append('dataTime', `${dataTime}`);
        }
        formData.append('controle', addEditDel);

        fetch('controle.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                formEnviado = true;
                if (data.success) {
                    ModalInstancia.hide();
                    Swal.fire({
                        title: `${data.message}`,
                        // text: "You clicked the button!",
                        icon: "success"
                    });
                    formDados.removeEventListener('submit', submitHandler);
                    setTimeout(function () {
                        window.location.reload()
                    }, 2000)
                } else {
                    ModalInstancia.hide();
                    Swal.fire({
                        title: `${data.message}`,
                        // text: "You clicked the button!",
                        icon: "error"
                    });
                    formDados.removeEventListener('submit', submitHandler);
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
            });
    };

    document.getElementById('btnMdlExcluirAluguel').addEventListener('click', function () {
        ModalInstancia.hide();
        formDados.removeEventListener('submit', submitHandler);
    });

    if (abrirModal === 'A') {
        ModalInstancia.show();

        const inputFocar = document.getElementById(`${inFocus}`);
        if (inFocusValue !== 'nao') {
            inputFocar.value = inFocusValue;
            setTimeout(function () {
                inputFocar.focus();
            }, 500);
        }

        const ID = document.getElementById(`${inID}`);
        if (inID !== 'nao') {
            ID.value = id;
        }

        const nome = document.getElementById(`${innome}`);
        if (innome !== 'nao') {
            nome.value = idNome;
        }

        formDados.addEventListener('submit', submitHandler);
    } else {
        botoes.disabled = false;
        ModalInstancia.hide();
        formDados.removeEventListener('submit', submitHandler);
    }
}

function abrirModalEpiAdd(img1, nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`)

    var botoes = document.getElementById(`${botao}`);
    const ModalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`))
    if (abrirModal === 'A') {
        ModalInstancia.show();

        const submitHandler = function (event) {
            event.preventDefault();
            botoes.disabled = true;

            const form = event.target;
            const formData = new FormData(form);

            formData.append('controle', `${addEditDel}`)
            fetch('controle.php', {
                method: 'POST', body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alertSuccess(data.message, '#30B27F')
                        carregarConteudo('listarEpi')

                    } else {
                        alertError(data.message)
                        carregarConteudo('listarEpi')

                    }
                    ModalInstancia.hide();
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        }
        formDados.addEventListener('submit', submitHandler);
    } else {

        ModalInstancia.hide();
    }
}

function abrirModalAlterarSenha(nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`)

    var botoes = document.getElementById(`${botao}`);
    const ModalInstacia = new bootstrap.Modal(document.getElementById(`${nomeModal}`))

    if (abrirModal === 'A') {
        ModalInstacia.show();

        let alertSenha = document.getElementById('alertSenha');



        const submitHandler = function (event) {
            event.preventDefault();
            botoes.disabled = true;


            const form = event.target;
            const formData = new FormData(form);

            formData.append('controle', `${addEditDel}`)

            fetch('controle.php', {
                method: 'POST', body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    if (data.success) {
                        alertSuccess(data.message, '#30B27F')

                    } else {
                        alertSenha.style.display = "block";
                        alertSenha.innerText = data.message;
                    }
                    ModalInstacia.hide();
                })
                // .catch(error => {
                //     console.error('Erro na requisição:', error);
                // });

        }

        document.getElementById('btnFecharModalSenha').addEventListener('click', function () {
            ModalInstacia.hide();
            formDados.removeEventListener('submit', submitHandler);
        });

        formDados.addEventListener('submit', submitHandler);
    } else {
        ModalInstacia.hide();
    }

}


function alertSuccess(msg, cor) {

    Toastify({
        text: `${msg}`,
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: `${cor}`,
            color: 'white',
        },
    }).showToast();

}

function alertError(msg) {
    Toastify({
        text: `${msg}`,
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "#F40000",
            color: 'white',
        },
    }).showToast();

}

function attCarrinho(quantidade) {
    var qtdDeItensNoCarrinho = document.getElementById('qtdDeItensNoCarrinho')

    qtdDeItensNoCarrinho.innerText = quantidade
}

function postCarrinho(produto) {
    fetch('addCarrinho.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'idepi=' + encodeURIComponent(produto),
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            attCarrinho(data.qtd)
            if (data.success) {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "success"
                });
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "danger"
                });
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alertError('Ocorreu um erro ao tentar adicionar o produto ao carrinho.');
        });
}

function removeCarrinho(produto, f) {
    fetch('removeCarrinho.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'idepi=' + encodeURIComponent(produto) + '&num=' + encodeURIComponent(f),
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            attCarrinho(data.qtd)
            if (data.success) {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "success"
                });
                setTimeout(function () {
                    window.location.reload()
                }, 1240)
            } else {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "danger"
                });
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({
                // title: `${data.message}`,
                text: "Ocorreu um erro ao tentar remover o produto do carrinho.",
                icon: "danger"
            });
        });
}

function excluirItem(id) {
    fetch('removerItem.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'idepi=' + encodeURIComponent(id),
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.success) {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "success"
                });
                setTimeout(function () {
                    window.location.reload()
                }, 1240)
            } else {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "danger"
                });
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({
                title: `${data.message}`,
                text: "Ocorreu um erro ao tentar remover o produto do carrinho.",
                icon: "danger"
            });
            alertError('Ocorreu um erro ao tentar remover o produto do carrinho.');
        });
}

function limparCarrinho() {
    fetch('controle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'controle=' + encodeURIComponent('limparCarrinho'),
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "danger"
                });
            }
            setTimeout(function () {
                window.location.reload()
            }, 1500)
        })
        .catch(error => {
            // console.error('Erro:', error);
            alertError('Ocorreu um erro ao tentar limpar o carrinho.');
        });
}

function redireciona(link) {
    window.location.href = link;
}

function realizarAluguel(formulario, addEditDel, botoes) {
    const formDados = document.getElementById(formulario);
    let formEnviado = false;
    const submitHandler = function (event) {
        event.preventDefault();
        botoes.disabled = true;

        var dataAluguel = document.getElementById('dataAluguel');
        var horaInicialAluguel = document.getElementById('horaInicialAluguel');
        var horaFinalAluguel = document.getElementById('horaFinalAluguel');

        var alertData = document.getElementById('alertData');
        var horaInicial = document.getElementById('alertHoraInicial');
        var horaFinal = document.getElementById('alertHoraFinal');

        dataAluguel.addEventListener('change', function () {
            alertData.style.display = 'none'
        })
        horaInicialAluguel.addEventListener('change', function () {
            horaInicial.style.display = 'none'
        })
        horaFinalAluguel.addEventListener('change', function () {
            horaFinal.style.display = 'none'
        })

        const form = event.target;
        const formData = new FormData(form);

        formData.append('controle', addEditDel);

        fetch('controle.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                // console.log(data)
                formEnviado = true;
                if (data.success) {
                    Swal.fire({
                        title: `${data.message}`,
                        // text: "You clicked the button!",
                        icon: "success"
                    });
                    formDados.removeEventListener('submit', submitHandler);
                    setTimeout(function () {
                        window.location.href = 'aluguel.php'
                    }, 1500)
                } else {
                    if (data.errodata) {
                        // console.log(data.errodata);
                        if (data.msgData !== '') {
                            alertData.style.color = 'red'
                            alertData.style.display = 'block'
                            alertData.innerHTML = data.msgData;
                        }
                        if (data.msgHoraInicial !== '') {
                            horaInicial.style.color = 'red'
                            horaInicial.style.display = 'block'

                            horaInicial.innerHTML = data.msgHoraInicial;
                        }
                        if (data.msgHoraFinal !== '') {
                            horaFinal.style.color = 'red'
                            horaFinal.style.display = 'block'

                            horaFinal.innerHTML = data.msgHoraFinal;
                        }

                        formDados.removeEventListener('submit', submitHandler);
                    } else {
                        alertError(data.message);
                        formDados.removeEventListener('submit', submitHandler);
                    }

                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
            });
    };
    formDados.addEventListener('submit', submitHandler);

}


function deleletarEpi(id, addEditDel, formulario) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            fetch('controle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'controle=' + encodeURIComponent(`${addEditDel}`) +
                    "&idDelete=" +
                    encodeURIComponent(`${id}`),
            })
                .then(response => response.json())
                .then(data => {
                    carregarConteudo('listarEpi')
                    if (data.success) {

                        Swal.fire({
                            title: "Deletado!",
                            text: `${data.message}`,
                            icon: "success"
                        });

                    } else {
                        Swal.fire({
                            title: "Erro!",
                            text: `${data.message}`,
                            icon: "warning"
                        });

                    }

                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        }


    });
}