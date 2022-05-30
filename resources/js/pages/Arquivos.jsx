import { useEffect, useState } from "react";
import { Button, Col, Container, Form, Row, Table } from "react-bootstrap";
import ModalArquivo from "../components/arquivos/ModalArquivo";
import TableArquivos from "../components/arquivos/TableArquivos";
import ModalExclusao from "../components/modal/ModalExclusao";
import api, { authApi } from "../util/api";

const Arquivos = () => {
    document.title = "Passaver - Arquivos";

    const [arquivos, setArquivos] = useState([]);
    const [idArquivo, setIdArquivo] = useState(0);
    const [nomeArquivo, setNomeArquivo] = useState("");
    const [showPublicar, setShowPublicar] = useState(false);
    const [showExclusao, setShowExclusao] = useState(false);
    const [batch, setBatch] = useState(0);

    const reload = () => {
        setBatch(batch + 1);
    };

    const handleOpenExclusao = (idArquivo, nomeArquivo) => {
        setIdArquivo(idArquivo);
        setNomeArquivo(nomeArquivo);
        setShowExclusao(true);
    };

    useEffect(() => {
        authApi.get("/arquivo").then(res => setArquivos(res.data.arquivos));
    }, [batch]);

    return (
        <Container>
            <Row className="mt-2">
                <Col>
                    <h4>Arquivos</h4>
                </Col>
            </Row>
            <Row className="mt-2">
                <Col xs="6" md="2">
                    <Form.Control size="sm" type="text" placeholder="Pesquisar" />
                </Col>
                <Col className="text-end">
                    <Button onClick={() => setShowPublicar(true)} variant="secondary">
                        <i className="bi-plus-lg"></i> Publicar
                    </Button>
                </Col>
            </Row>
            <TableArquivos handleOpenExclusao={handleOpenExclusao} arquivos={arquivos} />
            <ModalArquivo reload={reload} show={showPublicar} handleClose={() => setShowPublicar(false)} />
            <ModalExclusao nome={nomeArquivo} show={showExclusao} reload={reload} handleClose={() => setShowExclusao(false)} objeto="arquivo" target={idArquivo} />
        </Container>
    );
};
export default Arquivos;
