import { useEffect, useState } from "react";
import { Button, Col, Container, Form, Row, Table } from "react-bootstrap";
import TableArquivos from "../components/arquivos/TableArquivos";

const Arquivos = () => {
    document.title = "Passaver - Arquivos";

    const [arquivos, setArquivos] = useState([]);

    useEffect(() => {});

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
                    <Button variant="secondary">
                        <i className="bi-plus-lg"></i> Publicar
                    </Button>
                </Col>
            </Row>
            <TableArquivos arquivos={arquivos} />
        </Container>
    );
};
export default Arquivos;
