import { Col, Form, Row } from "react-bootstrap"

const RowSenha = (props) => {
    return (
        <Row className="justify-content-center mt-2">
            <Col>
                <Form.Label htmlFor="senha" className="text-light">Senha:</Form.Label>
                <Form.Control onChange={props.onChange} value={props.value} type="password" id="senha" name="senha" placeholder="Insira sua senha"></Form.Control>
            </Col>
        </Row>
    )
}
export default RowSenha