import { useEffect, useState } from "react";
import { Button, Col, Form, Modal, Row } from "react-bootstrap";
import api from "../../../util/api";

const initialState = {
    apelido: "",
    credencial: "",
    senha: ""
}

const ModalConta = (props) => {
    const [input, setInput] = useState(initialState);
    const [verSenha, setVerSenha] = useState(false);

    const handleChange = e => {
        setInput({
            ...input,
            [e.target.name]: e.target.value
        })
    }

    useEffect(() => {
        if (props.idConta) {
            api.get(`/contas/${props.idConta}`)
                .then(response => setInput(response.data))
                .catch(err => console.log(err))
        } else {
            setInput(initialState)
        }
    }, [props.show])

    return (
        <Modal size="xl" show={props.show} onHide={props.handleClose}>
            <Modal.Header className="bg-primary text-light" closeButton>
                <Modal.Title>CONSULTAR CONTA</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Row>
                    <Col>
                        <Form.Label htmlFor="apelido">Apelido da Conta:</Form.Label>
                        <Form.Control onChange={handleChange} type="text" name="apelido" value={input.apelido} id="apelido" />
                    </Col>
                </Row>
                <Row className="mt-2">
                    <Col>
                        <Form.Label htmlFor="credencial">Credencial da Conta:</Form.Label>
                        <Form.Control onChange={handleChange} type="text" name="credencial" value={input.credencial} id="credencial" />
                    </Col>
                </Row>
                <Row className="mt-2">
                    <Form.Label htmlFor="senha">Senha da Conta:</Form.Label>
                    <Col className="input-group">
                        <Form.Control onChange={handleChange} type={verSenha ? 'text' : 'password'} name="senha" value={input.senha} id="senha" />
                        <Button variant="outline-primary"><i className="bi-clipboard"></i></Button>
                        <Button variant="outline-primary"><i className="bi-magic"></i></Button>
                        <Button onClick={() => setVerSenha(!verSenha)} variant="outline-primary"><i className={verSenha ? "bi-eye-slash" : "bi-eye"}></i></Button>
                    </Col>
                </Row>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="success" onClick={props.handleClose}>
                    Salvar
                </Button>
                <Button variant="secondary" onClick={props.handleClose}>
                    Fechar
                </Button>
            </Modal.Footer>
        </Modal>
    );
};
export default ModalConta;
