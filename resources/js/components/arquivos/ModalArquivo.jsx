import { useState } from "react";
import { Button, Form, Modal } from "react-bootstrap";
import api from "../../util/api";

const ModalArquivo = props => {
    const [arquivos, setArquivos] = useState([]);

    useState(() => {
        setArquivos([]);
    }, [props.show]);

    const postFiles = () => {
        if (arquivos.length) {
            api.post("/arquivo", arquivos, {
                headers: {
                    "Content-Type": "multipart-form-data"
                }
            }).then(() => {
                props.reload()
                props.handleClose()
            });
        }
    };

    return (
        <Modal size="xl" show={props.show} onHide={props.handleClose}>
            <Modal.Header className="bg-primary text-light" closeButton>
                <Modal.Title>SALVAR ARQUIVO</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Form.Label>Inserir Arquivos</Form.Label>
                <Form.Control files={arquivos} onChange={e => setArquivos(e.target.files)} type="file" multiple />
            </Modal.Body>
            <Modal.Footer>
                <Button onClick={postFiles} variant="success" type="submit">
                    Salvar
                </Button>
                <Button variant="secondary" onClick={props.handleClose}>
                    Fechar
                </Button>
            </Modal.Footer>
        </Modal>
    );
};
export default ModalArquivo;
