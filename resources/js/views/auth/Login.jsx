import { useEffect, useState } from "react"
import { Col, Container, Form, Row } from "react-bootstrap"
import api, { getCSRF } from "../../util/api"
import RowEmail from "../../components/auth/RowEmail"
import RowRemember from "../../components/auth/login/RowRemember"
import RowSenha from "../../components/auth/RowSenha"
import RowSubmit from "../../components/auth/RowSubmit"
import { useNavigate } from "react-router-dom"
import cookie from "react-cookies"

const initialState = {
    email: "",
    senha: "",
    remember: false,
}

const Login = () => {
    const [input, setInput] = useState(initialState)
    const navigate = useNavigate();

    const login = async (e) => {
        e.preventDefault()
        getCSRF().then(() => {
            let login = api.post("/login", input)
            login
                .then(() => {
                    cookie.save('logged', true)
                    navigate('/')
                })
                .catch(err => console.log(err))
        });
    }

    useEffect(() => {
        document.title = 'Passaver - Login'
    }, [])


    const handleChange = (e) => {
        let target = e.target;
        let value = target.type == 'checkbox' ? target.checked : target.value
        setInput({
            ...input,
            [target.name]: value
        })
    }

    return (
        <Container>
            <Row className="mt-5 justify-content-center">
                <Col xs md="6" lg="4" className="mx-2 mx-lg-0 p-3 bg-secondary rounded">
                    <Form onSubmit={login}>
                        <RowEmail onChange={handleChange} value={input.email}/>
                        <RowSenha onChange={handleChange} value={input.senha}/>
                        <RowRemember onChange={handleChange} checked={input.remember} />
                        <RowSubmit>ENTRAR</RowSubmit>
                    </Form>
                </Col>
            </Row>
        </Container>
    )
}
export default Login