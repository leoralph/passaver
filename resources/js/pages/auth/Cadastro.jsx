import { useState } from "react"
import { Col, Container, Form, Row } from "react-bootstrap"
import { Link } from "react-router-dom"
import api from "../../util/api"
import RowNome from "../../components/auth/cadastro/RowNome"
import RowEmail from "../../components/auth/RowEmail"
import RowSenha from "../../components/auth/RowSenha"
import RowSenhaConfirmation from "../../components/auth/RowSenhaConfirmation"
import RowSubmit from "../../components/auth/RowSubmit"

const initialState = {
    nome: "",
    email: "",
    senha: "",
    senha_confirmation: ""
}

const Cadastro = (props) => {
    const [input, setInput] = useState(initialState);
    const [errors, setErrors] = useState({})

    const handleSubmit = e => {
        e.preventDefault();
        let cadastro = api.post("/usuario", input)
        cadastro
            .then(res => console.log(res))
            .catch(err => setErrors(err.response.data))
    }

    const handleChange = e => {
        setInput({
            ...input,
            [e.target.name]: e.target.value
        })
    }

    return (
        <Container>
            <Row className="mt-5 justify-content-center">
                <Col xs md="6" lg="4" className="p-3 bg-secondary rounded">
                    <Form onSubmit={handleSubmit}>
                        <RowNome errors={errors} onChange={handleChange} value={input.nome} />
                        <RowEmail errors={errors} onChange={handleChange} value={input.email} className="mt-2" />
                        <RowSenha errors={errors} onChange={handleChange} value={input.senha} />
                        <RowSenhaConfirmation onChange={handleChange} value={input.senha_confirmation} />
                        <Row className="mt-3">
                            <Col>
                                <Link to={"/login"}>Fazer login</Link>
                            </Col>
                        </Row>
                        <RowSubmit>CADASTRAR</RowSubmit>
                    </Form>
                </Col>
            </Row>
        </Container>
    )
}
export default Cadastro