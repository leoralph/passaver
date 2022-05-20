import { Col, Form, Row } from "react-bootstrap"

const RowSenhaConfirmation = (props) => {
    return (
        <Row className="justify-content-center mt-2">
            <Col>
                <Form.Label htmlFor="senha_confirmation" className="text-light">Confirmar Senha:</Form.Label>
                <Form.Control onChange={props.onChange} value={props.value} type="password" id="senha_confirmation" name="senha_confirmation" placeholder="Confirme sua senha"></Form.Control>
            </Col>
        </Row>
    )
}
export default RowSenhaConfirmation