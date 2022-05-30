import { Col, Form, Row } from "react-bootstrap";

const RowNome = props => {
    return (
        <Row className="justify-content-center">
            <Col>
                <Form.Label htmlFor="nome" className="text-light">
                    Nome:
                </Form.Label>
                <Form.Control onChange={props.onChange} type="text" name="nome" value={props.value} placeholder="Nome" />
                {props.errors.nome && props.errors.nome[0]}
            </Col>
        </Row>
    );
};
export default RowNome;
