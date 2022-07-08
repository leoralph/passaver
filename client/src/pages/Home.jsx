import { useEffect, useState } from "react";
import { Button, Col, Container, Form, Row } from "react-bootstrap";
import { authApi } from "../util/api";
import ModalConta from "../components/home/ModalConta";
import TableContas from "../components/home/TableContas";
import ModalExclusao from "../components/modal/ModalExclusao";

const Home = () => {
    document.title = "Passaver - Principal";

    const [contas, setContas] = useState([]);
    const [showConta, setShowConta] = useState(false);
    const [showExclusao, setShowExclusao] = useState(false);
    const [idConta, setIdConta] = useState(null);
    const [apelido, setApelido] = useState(null);
    const [batch, setBatch] = useState(0);

    useEffect(() => {
        authApi.get("/conta").then(result => setContas(result.data.contas));
    }, [batch]);

    const handleCloseConta = () => {
        setIdConta(null);
        setShowConta(false);
    };
    const handleOpenConta = idConta => {
        setIdConta(idConta);
        setShowConta(true);
    };

    const handleCloseExclusao = () => {
        setIdConta(null);
        setApelido(null);
        setShowExclusao(false);
    };
    const handleOpenExclusao = (idConta, apelido) => {
        setIdConta(idConta);
        setApelido(apelido);
        setShowExclusao(true);
    };

    const reloadContas = () => setBatch(batch + 1);

    return (
        <Container>
            <Row className="mt-2">
                <Col>
                    <h4>Contas</h4>
                </Col>
            </Row>
            <Row className="my-2">
                <Col>
                    <Button onClick={() => handleOpenConta(null)} variant="secondary" className="mb-1">
                        <i className="bi-plus-lg"></i> Nova
                    </Button>
                </Col>
            </Row>
            <TableContas handleOpenExclusao={handleOpenExclusao} handleOpenConta={handleOpenConta} contas={contas} />
            <ModalConta reload={reloadContas} idConta={idConta} show={showConta} handleClose={handleCloseConta} />
            <ModalExclusao objeto="conta" nome={apelido} reload={reloadContas} target={idConta} show={showExclusao} handleClose={handleCloseExclusao} />
        </Container>
    );
};
export default Home;
