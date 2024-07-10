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

function mostrarsenha(input) {
    var inputPass = document.getElementById(`${input}`);
    var btnShowPass = document.getElementById('btn-senha');

    if (inputPass.type === 'password') {
        inputPass.setAttribute('type', 'text');
        btnShowPass.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        inputPass.setAttribute('type', 'password');
        btnShowPass.classList.replace('bi-eye', 'bi-eye-slash');
    }
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

function abrirModalEpiAdd(img1, nomeFoto, idEpi, inpIdEpi, idNome, inpIdNome, idCertificado, inpIdCertificado, nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`)
    var botoes = document.getElementById(`${botao}`);
    const ModalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`))

    if (!formDados || !botoes || !ModalInstancia) {
        console.error('Verificar a chamada da função e checar se os IDs estão corretos!')
    }

    const inpidEpiEdit = document.getElementById(`${inpIdEpi}`)
    if (idEpi !== 'nao') {
        inpidEpiEdit.value = idEpi
    }
    const nomeEpi = document.getElementById(`${inpIdNome}`)
    if (idNome !== 'nao') {
        nomeEpi.value = idNome
    }
    const certificado = document.getElementById(`${inpIdCertificado}`)
    if (idCertificado !== 'nao') {
        certificado.value = idCertificado
    }
    const idFoto = document.getElementById(img1)
    const idVerimg = document.getElementById('imgPreview')
    const visualizaImg = document.getElementById(`${nomeFoto}`)


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
                        formDados.removeEventListener('submit', submitHandler);
                    } else {
                        alertError(data.message)
                        carregarConteudo('listarEpi')
                        formDados.removeEventListener('submit', submitHandler);
                    }
                    ModalInstancia.hide();
                })
            // .catch(error => {
            //     console.error('Erro na requisição:', error);
            // });
        }

        const btnFecharModalAddEpi = document.getElementById('btnFecharModalAddEpi');
        if (btnFecharModalAddEpi) {
            btnFecharModalAddEpi.addEventListener('click', function () {
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });
        } else {
            console.error('ID do botão de fechar a modal está errado!');
        }

        const btnFecharModalEditEpi = document.getElementById('btnFecharModalEditEpi');
        if (btnFecharModalEditEpi) {
            btnFecharModalEditEpi.addEventListener('click', function () {
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });
        } else {
            console.error('ID do botão de fechar a modal está errado!');
        }

        formDados.addEventListener('submit', submitHandler);
    } else {

        ModalInstancia.hide();
    }
}


function abrirModalUsuario(INPid, IDid, INPnomeUsuario, IDnomeUsuario, INPsobrenome, IDsobrenome, INPcpf, IDcpf, INPnascimento, IDnascimento, INPcargo, IDcargo, INPemail, IDemail, INPsenha, IDsenha, nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`)
    var botoes = document.getElementById(`${botao}`);
    const ModalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`))

    if (!formDados || !botoes || !ModalInstancia) {
        console.error('Verificar a chamada da função e checar se os IDs estão corretos!')
    }

    const INPidi = document.getElementById(`${INPid}`)
    if (IDid !== 'nao') {
        INPidi.value = IDid
    }
    const INPnome = document.getElementById(`${INPnomeUsuario}`)
    if (IDnomeUsuario !== 'nao') {
        INPnome.value = IDnomeUsuario
    }

    const INPsobre = document.getElementById(`${INPsobrenome}`)
    if (IDsobrenome !== 'nao') {
        INPsobre.value = IDsobrenome
    }

    const INPcpefi = document.getElementById(`${INPcpf}`)
    if (IDcpf !== 'nao') {
        INPcpefi.value = IDcpf
    }

    const INPdata = document.getElementById(`${INPnascimento}`)
    if (IDnascimento !== 'nao') {
        INPdata.value = IDnascimento
    }
    const INPtrabalho = document.getElementById(`${INPcargo}`)
    if (IDcargo !== 'nao') {
        if (IDcargo === 'Adminstrador') {
            IDcargo = 'adm'
        } else if (IDcargo === 'Almoxarife') {
            IDcargo = 'almoxarife'
        } else if (IDcargo === 'Funcionário') {
            IDcargo = 'funcionario'
        } else if (IDcargo === 'Recursos Humanos') {
            IDcargo = 'rh'
        } else {
            IDcargo = 'sem Cargo'
        }
        INPtrabalho.value = IDcargo
    }

    const INPemailu = document.getElementById(`${INPemail}`)
    if (IDemail !== 'nao') {
        INPemailu.value = IDemail
    }


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
                    console.log(data)
                    if (data.success) {
                        alertSuccess(data.message, '#30B27F')
                        carregarConteudo('listarUsuario')
                        formDados.removeEventListener('submit', submitHandler);
                    } else {
                        alertError(data.message)
                        carregarConteudo('listarUsuario')
                        formDados.removeEventListener('submit', submitHandler);
                    }
                    ModalInstancia.hide();
                })
                // .catch(error => {
                //     console.error('Erro na requisição:', error);
                // });
        }

        const btnFecharModalAddUsuario = document.getElementById('btnFecharModalAddUsuario');
        const btnFecharModalEditUsuario = document.getElementById('btnFecharModalEditUsuario');
        if (btnFecharModalAddUsuario) {
            btnFecharModalAddUsuario.addEventListener('click', function () {
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });
        } else if (btnFecharModalEditUsuario) {
            btnFecharModalEditUsuario.addEventListener('click', function () {
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });

        } else {
            console.error('ID do botão de fechar a modal está errado!');

        }


        formDados.addEventListener('submit', submitHandler);
    } else {

        ModalInstancia.hide();
    }
}


function abrirModalAlterarSenha(nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`);
    const botoes = document.getElementById(`${botao}`);
    const modalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`));

    if (!formDados || !botoes || !modalInstancia) {
        console.error('Revisar os IDs na chamada da função e chechar se a função está sendo chamada corretamente!');
        return;
    }

    if (abrirModal === 'A') {
        modalInstancia.show();

        const alertSenha = document.getElementById('alertSenha');
        const inpAlterarSenha = document.getElementById('inpAlterarSenha');
        const confirmarAlteracaoDaSenha = document.getElementById('confirmarAlteracaoDaSenha');

        if (!alertSenha || !inpAlterarSenha || !confirmarAlteracaoDaSenha) {
            console.error('Os IDs dos inputs e do alerta para verificação de senha estão errados.');
            return;
        }

        const verificarSenha = () => {
            alertSenha.style.display = 'none';
            if (inpAlterarSenha.value.length < 8) {
                alertSenha.classList.add('mt-4');
                alertSenha.style.display = "block";
                alertSenha.innerHTML = "Mínimo de 8 dígitos.";
            } else if (inpAlterarSenha.value !== confirmarAlteracaoDaSenha.value) {
                alertSenha.classList.add('mt-4');
                alertSenha.style.display = "block";
                alertSenha.innerHTML = "As senhas não coincidem";
            }
        };
        setTimeout(function () {
            inpAlterarSenha.addEventListener('input', verificarSenha);
            confirmarAlteracaoDaSenha.addEventListener('input', verificarSenha);
        }, 10000)


        const submitHandler = function (event) {
            event.preventDefault();
            botoes.disabled = true;

            const form = event.target;
            const formData = new FormData(form);
            formData.append('controle', addEditDel);

            fetch('controle.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        formDados.removeEventListener('submit', submitHandler);
                        Swal.fire({
                            title: data.message,
                            icon: "success"
                        });
                        botoes.disabled = false;
                        modalInstancia.hide();
                        form.reset();
                    } else {
                        formDados.removeEventListener('submit', submitHandler);
                        botoes.disabled = false;
                        alertSenha.style.display = 'block';
                        alertSenha.classList.add('mt-4');
                        alertSenha.innerText = data.message;
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        };

        const btnFecharModalSenha = document.getElementById('btnFecharModalSenha');
        if (btnFecharModalSenha) {
            btnFecharModalSenha.addEventListener('click', function () {
                modalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
                inpAlterarSenha.removeEventListener('input', verificarSenha);
                confirmarAlteracaoDaSenha.removeEventListener('input', verificarSenha);
            });
        } else {
            console.error('ID do botão de fechar a modal está errado!');
        }

        formDados.addEventListener('submit', submitHandler);
    } else {
        modalInstancia.hide();
    }
}


function abrirModalAlterarDados(nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`);
    const botoes = document.getElementById(`${botao}`);
    const ModalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`));

    if (!formDados || !botoes || !ModalInstancia) {
        console.error('Revisar os IDs na chamada da função e chechar se a função está sendo chamada corretamente!');
        return;
    }

    if (abrirModal === 'A') {
        ModalInstancia.show();

        const submitHandler = function (event) {
            event.preventDefault();
            botoes.disabled = true;
            console.log('submit')
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
                    if (data.success) {
                        formDados.removeEventListener('submit', submitHandler);
                        Swal.fire({
                            title: data.message,
                            icon: "success"
                        });
                        botoes.disabled = false;
                        ModalInstancia.hide();
                        form.reset();
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000)
                    } else {
                        formDados.removeEventListener('submit', submitHandler);
                        botoes.disabled = false;
                        Swal.fire({
                            title: data.message,
                            icon: "error"
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        };

        const btnFecharModalDados = document.getElementById('btnFecharModalDados');
        if (btnFecharModalDados) {
            btnFecharModalDados.addEventListener('click', function () {
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });
        } else {
            console.error('ID do botão de fechar a modal está errado!');
        }

        formDados.addEventListener('submit', submitHandler);
    } else {
        ModalInstancia.hide();
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
        title: "Você tem certeza?",
        text: "Esta ação não pode ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, eu tenho certeza!"
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