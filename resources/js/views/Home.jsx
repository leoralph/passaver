import { useEffect, useState } from "react"
import { Button, Col, Container, Form, Row } from "react-bootstrap"
import api from "../util/api"
import ModalConta from "../components/home/modal-conta/ModalConta"
import TableContas from "../components/home/TableContas"

const Home = (props) => {
    const [contas, setContas] = useState([])
    const [show, setShow] = useState(false);
    const [idConta, setIdConta] = useState(null)
    const [pesquisa, setPesquisa] = useState('')
    
    useEffect(() => {
        document.title = "Passaver - Principal";
        let reqContas = api.get("/contas")
        reqContas
        .then(result => setContas(result.data))
    }, [])

    const handleClose = idConta => {
        setIdConta(idConta)
        setShow(false)
    }
    const handleOpen = idConta => {
        setIdConta(idConta)
        setShow(true)
    }

    return (
        <Container>
            <ModalConta idConta={idConta} show={show} handleClose={handleClose}/>
            <Row className="mt-2">
                <Col>
                    <h4>Contas</h4>
                </Col>
            </Row>
            <Row className="mt-2">
                <Col xs="6" md="2">
                    <Form.Control value={pesquisa} onChange={(e) => setPesquisa(e.target.value)} size="sm" type="text" id="pesquisar" placeholder="Pesquisar" />
                </Col>
                <Col className="text-end">
                    <Button onClick={() => handleOpen(null)} variant="secondary" className="mb-1"><i className="bi-plus-lg"></i> Nova</Button>
                </Col>
            </Row>
            <TableContas handleOpen={handleOpen} contas={contas}/>
        </Container>
    )
}
export default Home