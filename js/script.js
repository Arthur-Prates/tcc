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
            if (data.success) {
                setTimeout(function () {
                    window.location.href = "pagina-inicial";
                }, 2900);
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
    fetch("../admin/login.php", {
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
            if (data.success) {
                setTimeout(function () {
                    esconderProcessando();
                    telaBemvindo(data.nome)
                }, 1000)
                setTimeout(function () {
                    window.location.href = "../admin/dashboard.php";
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

function telaBemvindo(nome) {
    var divFundoClaro = document.createElement('div');
    divFundoClaro.id = 'fundoEscuro';
    divFundoClaro.style.position = 'fixed';
    divFundoClaro.style.top = '0';
    divFundoClaro.style.left = '0';
    divFundoClaro.style.width = '100%';
    divFundoClaro.style.height = '100%';
    divFundoClaro.style.backgroundColor = 'rgba(255,255,255,0.95)';
    document.body.appendChild(divFundoClaro);

    var divBemvindo = document.createElement("div");
    divBemvindo.id = "telaBemVindo";
    divBemvindo.style.position = "fixed";
    divBemvindo.style.top = "50%";
    divBemvindo.style.left = "50%";
    divBemvindo.style.transform = "translate(-50%, -50%)";
    divBemvindo.innerHTML = '<h4>Bem-vindo, ' + nome + ' !</h4>';
    document.body.appendChild(divBemvindo);
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

function abrirModalEpiAdd(img1, nomeFoto, idEpi, inpIdEpi, idNome, inpIdNome, idCertificado, inpIdCertificado, idQuantidade, inpIdQuantidade, nomeModal, abrirModal = 'A', botao, addEditDel, formulario) {
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
    const quantidade = document.getElementById(`${inpIdQuantidade}`)
    if (idQuantidade !== 'nao') {
        quantidade.value = idQuantidade
    }
    const idFoto = document.getElementById(img1)
    const idVerimg = document.getElementById('imgPreview')
    const visualizaImg = `${nomeFoto}`

    idVerimg.src = '../img/produtos/' + visualizaImg;

    idFoto.addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = () => {
            idVerimg.src = reader.result
        }
        reader.readAsDataURL(idFoto.files[0])
    })

    document.getElementById('fotoEpiAdd').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
                document.getElementById('icon').style.display = "none";
                document.getElementById('text').style.display = "none";
            }
            reader.readAsDataURL(file);
        }
    });

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
                        botoes.disabled = false;
                        alertSuccess(data.message, '#30B27F')
                        carregarConteudo('listarEpi')
                        formDados.removeEventListener('submit', submitHandler);
                        form.reset()
                        idVerimg.src = ''
                        setTimeout(function () {
                            destacarLinha(data.idEpi)
                        }, 300)
                    } else {
                        botoes.disabled = false;
                        alertError(data.message)
                        carregarConteudo('listarEpi')
                        formDados.removeEventListener('submit', submitHandler);
                        form.reset()
                    }
                    ModalInstancia.hide();
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
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


function abrirModalUsuario(INPid, IDid, INPnomeUsuario, IDnomeUsuario, INPsobrenome, IDsobrenome, INPtelefone, IDtelefone, INPcpf, IDcpf, INPnascimento, IDnascimento, INPcargo, IDcargo, INPemail, IDemail, INPsenha, IDsenha, nomeModal, abrirModal = 'A', botao, addEditDel, listagem, formulario) {
    const formDados = document.getElementById(`${formulario}`)
    var botoes = document.getElementById(`${botao}`);
    const ModalInstancia = new bootstrap.Modal(document.getElementById(`${nomeModal}`))

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
    const INPcelular = document.getElementById(`${INPtelefone}`)
    if (IDtelefone !== 'nao') {
        INPcelular.value = IDtelefone
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
        INPtrabalho.value = IDcargo
    }

    const INPemailu = document.getElementById(`${INPemail}`)
    if (IDemail !== 'nao') {
        INPemailu.value = IDemail
    }


    if (abrirModal === 'A') {
        ModalInstancia.show();
        const btnFecharAlterarSenha = document.getElementById('btnFecharAlterarSenha')
        const btnAlterarSenha = document.getElementById('btnAlterarSenha');
        const dNone = document.getElementById('dNone');
        const novaSenhaUsuarioEdit = document.getElementById('novaSenhaUsuarioEdit');
        const confirmNovaSenhaUsuarioEdit = document.getElementById('confirmNovaSenhaUsuarioEdit');
        const alertaSenha = document.getElementById('alertaSenha');

        btnAlterarSenha.addEventListener('click', function () {
            dNone.style.display = 'block';
            alertaSenha.style.display = 'none';
            btnAlterarSenha.style.display = 'none';
            btnFecharAlterarSenha.style.display = 'block';
            const confirmaSenha = () => {
                alertaSenha.style.display = 'none';
                if (novaSenhaUsuarioEdit.value.length < 8) {
                    alertaSenha.classList.add('mt-4');
                    alertaSenha.style.display = "block";
                    alertaSenha.innerHTML = "A senha precisa ter no mínimo de 8 dígitos.";
                } else if (novaSenhaUsuarioEdit.value !== confirmNovaSenhaUsuarioEdit.value) {
                    alertaSenha.classList.add('mt-4');
                    alertaSenha.style.display = "block";
                    alertaSenha.innerHTML = "As senhas não coincidem";
                }
            };

            novaSenhaUsuarioEdit.addEventListener('input', function () {
                alertaSenha.style.display = 'none';
            })
            confirmNovaSenhaUsuarioEdit.addEventListener('input', function () {
                alertaSenha.style.display = 'none';
            })
            setInterval(confirmaSenha, 3500)
        })

        btnFecharAlterarSenha.addEventListener('click', function () {
            btnFecharAlterarSenha.style.display = 'none';
            btnAlterarSenha.style.display = 'block'
            dNone.style.display = 'none';
            alertaSenha.style.display = 'none';
        })


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
                        botoes.disabled = false;
                        alertSuccess(data.message, '#30B27F')
                        carregarConteudo(`${listagem}`)
                        formDados.removeEventListener('submit', submitHandler);
                        setTimeout(function () {
                            destacarLinha(data.idUsuario)
                        }, 500)
                    } else {
                        botoes.disabled = false;
                        alertError(data.message)
                        carregarConteudo(`${listagem}`)
                        formDados.removeEventListener('submit', submitHandler);
                    }
                    formDados.reset()
                    ModalInstancia.hide();
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        }

        const btnFecharModalAddUsuario = document.getElementById('btnFecharModalAddUsuario');
        const btnFecharModalEditUsuario = document.getElementById('btnFecharModalEditUsuario');
        const btnFecharModalVermaisUsuario = document.getElementById('btnFecharModalVermaisUsuario');
        const btnUsuarioAdd = document.getElementById('btnUsuarioAdd');
        if (btnFecharModalAddUsuario) {
            btnFecharModalAddUsuario.addEventListener('click', function () {
                alertaSenha.style.display = 'none';
                dNone.style.display = 'none';
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });
        } else {
            console.error('ID do botão de fechar a modal está errado!');
        }
        if (btnFecharModalEditUsuario) {
            btnFecharModalEditUsuario.addEventListener('click', function () {
                alertaSenha.style.display = 'none';
                dNone.style.display = 'none';
                ModalInstancia.hide();
                formDados.removeEventListener('submit', submitHandler);
            });
        } else {
            console.error('ID do botão de fechar a modal está errado!');
        }
        if (btnFecharModalVermaisUsuario) {
            btnFecharModalVermaisUsuario.addEventListener('click', function () {
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
        inpAlterarSenha.addEventListener('input', function () {
            alertSenha.style.display = "none";
        });

        confirmarAlteracaoDaSenha.addEventListener('input', function () {
            alertSenha.style.display = "none";
        });

        setInterval(verificarSenha, 4000)

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
                        setTimeout(function () {
                            window.location.reload()
                        }, 2000)
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
                        setTimeout(function () {
                            window.location.reload()
                        }, 2000)
                        formDados.removeEventListener('submit', submitHandler);
                        Swal.fire({
                            title: data.message,
                            icon: "success"
                        });
                        botoes.disabled = false;
                        ModalInstancia.hide();
                        form.reset();
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
    const qtdDeItensNoCarrinho1 = document.getElementById('qtdDeItensNoCarrinho1');
    const qtdDeItensNoCarrinho2 = document.getElementById('qtdDeItensNoCarrinho2');

    qtdDeItensNoCarrinho1.innerText = quantidade;
    qtdDeItensNoCarrinho2.innerText = quantidade;

}

function postCarrinho(produto) {
    fetch('addCarrinho.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'idepi=' + encodeURIComponent(produto),
    })
        .then(response => response.json())
        .then(data => {
            attCarrinho(data.qtd)
            if (data.success) {
                alertSuccess(`${data.message}`, '#008f34')
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

function aumentarQuantidade(produto) {
    fetch('aumentarQtd.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'idepi=' + encodeURIComponent(produto),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alertSuccess(`${data.message}`, '#008f34')
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


function diminuirQuantidade(produto) {
    fetch('removeCarrinho.php', {
        method: 'POST', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }, body: 'idepi=' + encodeURIComponent(produto),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alertSuccess(`${data.message}`, '#008f34')

            } else {
                Swal.fire({
                    title: `${data.message}`,
                    // text: "You clicked the button!",
                    icon: "warning"
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
            attCarrinho(data.qtd)
            if (data.success) {
                Swal.fire({
                    title: `${data.message}`,
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: `${data.message}`,
                    icon: "error"
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
            if (data.success) {
                Swal.fire({
                    title: `${data.message}`,
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: `${data.message}`,
                    icon: "danger"
                });
            }
            setTimeout(function () {
                window.location.reload()
            }, 1500)
        })
        .catch(error => {
            console.error('Erro:', error);
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
                        window.location.href = 'meus-emprestimos'
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

function buscarLinha(listaPagina, idBusca) {
    carregarConteudo(`${listaPagina}`)
    setTimeout(function () {
        destacarLinha(`${idBusca}`)
    }, 300)
}

function destacarLinha(idLinhaParaDestaque) {
    const row = document.getElementById('row-' + idLinhaParaDestaque);
    if (row) {
        row.classList.add('table-info');
        row.classList.add('border-dark');
        setTimeout(function () {
            row.scrollIntoView({behavior: 'smooth', block: 'center'});
        }, 550)

        setTimeout(() => {
            row.classList.remove('border-dark');
            row.classList.remove('table-info');
        }, 3000);
    }
}


function deletarEpi(id, addEditDel) {
    Swal.fire({
        title: "Você tem certeza?",
        text: "Esta ação não pode ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, eu tenho certeza!",
        cancelButtonText: "Cancelar"
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
                    console.log(data)
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

function deleletarUsuario(id, addEditDel) {
    Swal.fire({
        title: "Você tem certeza?",
        text: "Esta ação não pode ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, eu tenho certeza!",
        cancelButtonText: "Cancelar"
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
                    carregarConteudo('listarUsuario')
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

function devolverEpi(idEmprestimoEpi, controle, valor, codEmprestimo, qtdDevolucao) {
    fetch('controle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'controle=' + encodeURIComponent(`${controle}`) +
            "&idDevolucao=" + encodeURIComponent(`${idEmprestimoEpi}`) +
            "&valor=" + encodeURIComponent(`${valor}`) +
            "&codEmprestimo=" + encodeURIComponent(`${codEmprestimo}`) +
            "&qtdDevolucao=" + encodeURIComponent(`${qtdDevolucao}`),
    })
        .then(response => response.json())
        .then(data => {
            setTimeout(function () {
                window.location.reload();
            }, 2500)
            if (data.success) {
                Swal.fire({
                    title: "Sucesso!",
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

function devolverEmprestimo(controle, codEmprestimo, valor) {
    fetch('controle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'controle=' + encodeURIComponent(`${controle}`) +
            "&codEmprestimo=" + encodeURIComponent(`${codEmprestimo}`) +
            "&valor=" + encodeURIComponent(`${valor}`),
    })
        .then(response => response.json())
        .then(data => {
            setTimeout(function () {
                window.location.reload();
            }, 2500)

            if (data.success) {
                Swal.fire({
                    title: "Sucesso!",
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

function getdataFomartada() {
    const date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1; // Janeiro é 0
    let year = date.getFullYear();

    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }

    return day + '/' + month + '/' + year;
}

function imprimir(nomeTabela, tabela) {
    const conteudo = document.getElementById(tabela).innerHTML;

    let estilo = "<style>";
    estilo += "table {width: 100%; font: 20px Calibri;}";
    estilo += "th, td {border: solid 2px #000; border-collapse: collapse; padding: 4px 8px; text-align: center;}";
    estilo += "button {display:none !important;}";
    estilo += "a {display:none !important;}";
    estilo += ".no-print {display: none !important;}";
    estilo += "@media print { @page { size: landscape; margin: none; }}";
    estilo += "</style>";

    const win = window.open('', '_self', 'height=700,width=1000');

    win.document.write('<!doctype html>');
    win.document.write('<head>');
    win.document.write('<title>Imprimir resultado</title>');
    win.document.write(estilo);
    win.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">');
    win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">');
    win.document.write('<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">');
    win.document.write('<link rel="stylesheet" href="../css/style.css">');
    win.document.write('</head>');
    win.document.write('<body>');
    win.document.write('<h3>' + nomeTabela + '</h3>');
    win.document.write(conteudo);
    win.document.write('Dados imprimidos Em ' + getdataFomartada() + '. <br>');
    win.document.write('© SafeTech ' + new Date().getFullYear() + ' Todos os direitos reservados.');
    win.document.write('</body>');
    win.document.write('</html>');
    win.document.write('<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>');
    win.document.write('<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>');

    win.print();
}

function buscaUsuario(formulario, botoes, addEditDel) {
    const formDados = document.getElementById(formulario);

    let formEnviado = false;
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
                formEnviado = true;
                if (data.success) {
                    form.reset()
                    formDados.removeEventListener('submit', submitHandler);
                    carregarConteudo('listarBusca')
                } else {
                    alertError(data.message);
                    formDados.removeEventListener('submit', submitHandler);
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
            });
    };
    formDados.addEventListener('submit', submitHandler);
}

window.onscroll = function () {
    mostrarBotaoTopo()
};

function mostrarBotaoTopo() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        document.getElementById("btnTopo").style.display = "block";
    } else {
        document.getElementById("btnTopo").style.display = "none";
    }
}

function voltarAoTopo() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}


document.addEventListener('DOMContentLoaded', function () {
    var inputPesquisa = document.getElementById('emprestimo');
    var formPesquisa = document.getElementById('emprestimoForm');

    if (inputPesquisa) {
        inputPesquisa.addEventListener('blur', function () {
            formPesquisa.submit();
        });
    }
});