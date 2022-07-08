import { useEffect, useState } from "react";
import { Button, Col, Form, Pagination, Row, Table } from "react-bootstrap";

const TableContas = props => {
    const [pagina, setPagina] = useState(1);
    const [contas, setContas] = useState([]);
    const [quantidade, setQuantidade] = useState(10);
    const [ultimaPagina, setUltimaPagina] = useState(null);
    const [contasExibicao, setContasExibicao] = useState([]);

    const handleChangeQuantidade = e => {
        let value = parseInt(e.target.value);
        if (value) setQuantidade(value);
    };

    useEffect(() => {
        setContas(props.contas);
    }, [props.contas]);

    useEffect(() => {
        let ultima = Math.ceil(contas.length / quantidade);
        let contasExibicao = contas.slice(quantidade * (pagina - 1), quantidade * pagina);
        setContasExibicao(contasExibicao);
        setUltimaPagina(ultima);
    }, [contas, quantidade, pagina]);

    const pesquisar = e => {
        if (!e.target.value) {
            setContas(props.contas);
            return;
        }
        let contasFiltro = props.contas.filter(conta => {
            return conta.apelido.toLowerCase().includes(e.target.value);
        });
        setPagina(1);
        setContas(contasFiltro);
    };

    return (
        <>
            <Row>
                <Col lg="6">
                    <Form.Select onChange={handleChangeQuantidade} className="d-inline-block" size="sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                    </Form.Select>
                </Col>
                <Col lg="6">
                    <Form.Control onChange={pesquisar} size="sm" type="text" placeholder="Pesquisar" />
                </Col>
            </Row>
            <Row>
                <Col>
                    <Table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="100%">Apelido</th>
                                <th colSpan="2" className="text-center">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {contasExibicao.map((conta, index) => (
                                <tr key={index}>
                                    <td>{index + (pagina - 1) * quantidade + 1}</td>
                                    <td>{conta.apelido}</td>
                                    <td className="text-center">
                                        <Button onClick={() => props.handleOpenConta(conta.id)} variant="secondary" size="sm">
                                            <i className="bi-search"></i>
                                        </Button>
                                    </td>
                                    <td className="text-center px-0">
                                        <Button onClick={() => props.handleOpenExclusao(conta.id, conta.apelido)} size="sm">
                                            <i className="bi-trash"></i>
                                        </Button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </Table>
                </Col>
            </Row>
            <Row>
                <Col xs="12" lg="6">
                    Exibindo {(pagina - 1) * quantidade + 1} à {pagina != ultimaPagina ? pagina * quantidade : contas.length} de {contas.length} registros.
                </Col>
                <Col xs="12" lg="6" className="text-end">
                    <Pagination className="justify-content-end">
                        <Pagination.Item disabled={pagina == 1} onClick={() => setPagina(pagina - 1)}>
                            Anterior
                        </Pagination.Item>
                        <Pagination.Item disabled={pagina == 1} onClick={() => setPagina(1)}>
                            1
                        </Pagination.Item>
                        <Pagination.Item disabled={pagina == ultimaPagina} onClick={() => setPagina(ultimaPagina)}>
                            {ultimaPagina}
                        </Pagination.Item>
                        <Pagination.Next disabled={pagina == ultimaPagina} onClick={() => setPagina(pagina + 1)} />
                    </Pagination>
                </Col>
            </Row>
        </>
    );
};
export default TableContas;
