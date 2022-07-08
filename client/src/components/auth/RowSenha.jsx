import { Col, Form, Row } from "react-bootstrap";
import ErrorSpan from "../error/ErrorSpan";

const RowSenha = props => {
    return (
        <Row className="justify-content-center mt-2">
            <Col>
                <Form.Label htmlFor="senha" className="text-light">
                    Senha:
                </Form.Label>
                <Form.Control onChange={props.onChange} value={props.value} type="password" id="senha" name="senha" placeholder="Insira sua senha"></Form.Control>
                {"senha" in props.errors && <ErrorSpan error={props.errors.senha[0]} className="mt-2" />}
            </Col>
        </Row>
    );
};
export default RowSenha;
