import { useEffect, useState } from "react";
import { Button, Col, Form, InputGroup, Modal, Row } from "react-bootstrap";
import api from "../../util/api";
import ErrorSpan from "../error/ErrorSpan";

const initialState = {
    apelido: "",
    credencial: "",
    senha: "",
};

const ModalConta = props => {
    const [input, setInput] = useState(initialState);
    const [verSenha, setVerSenha] = useState(false);
    const [copiado, setCopiado] = useState(false);
    const [errors, setErrors] = useState({});

    const handleChange = e => {
        setInput({
            ...input,
            [e.target.name]: e.target.value,
        });
    };

    const gerarSenha = () => {
        api.get("/senha").then(res => {
            setInput({ ...input, senha: res.data.pwd });
        });
    };

    const copiarSenha = e => {
        navigator.clipboard.writeText(input.senha);
        setCopiado(true);
    };

    const handleSubmit = e => {
        e.preventDefault();

        let req;

        if (props.idConta) {
            req = api.patch(`/conta/${props.idConta}`, input);
        } else {
            req = api.post("/conta", input);
        }

        req.then(() => {
            props.reload();
            props.handleClose();
        }).catch(err => setErrors(err.response.data));
    };

    const limparModal = () => {
        setVerSenha(false);
        setCopiado(false);
        setErrors({});
    };

    useEffect(() => {
        limparModal();
        if (props.idConta) {
            api.get(`/conta/${props.idConta}`)
                .then(response => setInput(response.data))
                .catch(err => console.log(err));
        } else {
            setInput(initialState);
        }
    }, [props.show]);

    return (
        <Modal size="xl" show={props.show} onHide={props.handleClose}>
            <Form onSubmit={handleSubmit}>
                <Modal.Header className="bg-primary text-light" closeButton>
                    <Modal.Title>{props.idConta ? "CONSULTAR" : "CADASTRAR"} CONTA</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Row>
                        <Col>
                            <Form.Label htmlFor="apelido">Apelido da Conta:</Form.Label>
                            <Form.Control onChange={handleChange} type="text" name="apelido" value={input.apelido} id="apelido" />
                            {"apelido" in errors && <ErrorSpan className="mt-1" error={errors.apelido[0]} />}
                        </Col>
                    </Row>
                    <Row className="mt-2">
                        <Col>
                            <Form.Label htmlFor="credencial">Credencial da Conta:</Form.Label>
                            <Form.Control onChange={handleChange} type="text" name="credencial" value={input.credencial} id="credencial" />
                            {"credencial" in errors && <ErrorSpan className="mt-1" error={errors.credencial[0]} />}
                        </Col>
                    </Row>
                    <Row className="mt-2">
                        <Form.Label htmlFor="senha">Senha da Conta:</Form.Label>
                        <Col>
                            <InputGroup>
                                <Form.Control onChange={handleChange} type={verSenha ? "text" : "password"} name="senha" value={input.senha} id="senha" />
                                <Button onClick={copiarSenha} variant="outline-primary">
                                    <i className={copiado ? "bi-clipboard-check" : "bi-clipboard"}></i>
                                </Button>
                                <Button onClick={gerarSenha} variant="outline-primary">
                                    <i className="bi-magic"></i>
                                </Button>
                                <Button onClick={() => setVerSenha(!verSenha)} variant="outline-primary">
                                    <i className={verSenha ? "bi-eye-slash" : "bi-eye"}></i>
                                </Button>
                            </InputGroup>
                        </Col>
                        {"senha" in errors && <ErrorSpan className="mt-1" error={errors.senha[0]} />}
                    </Row>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="success" type="submit">
                        Salvar
                    </Button>
                    <Button variant="secondary" onClick={props.handleClose}>
                        Fechar
                    </Button>
                </Modal.Footer>
            </Form>
        </Modal>
    );
};
export default ModalConta;
