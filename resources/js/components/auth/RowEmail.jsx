import { Col, Form, Row } from "react-bootstrap";
import ErrorSpan from "../error/ErrorSpan";

const RowEmail = props => {
    return (
        <Row className={`justify-content-center ${props.className ?? ""}`}>
            <Col>
                <Form.Label htmlFor="email" className="text-light">
                    E-mail:
                </Form.Label>
                <Form.Control onChange={props.onChange} value={props.value} type="email" name="email" id="email" placeholder="Insira seu e-mail" />
                {"email" in props.errors && <ErrorSpan error={props.errors.email[0]} className="mt-3" />}
            </Col>
        </Row>
    );
};
export default RowEmail;
