import { Col, Form, Row } from "react-bootstrap"

const RowEmail = (props) => {
    return (
        <Row className={`justify-content-center ${props.className ?? ''}`}>
            <Col>
                <Form.Label htmlFor="email" className="text-light">E-mail:</Form.Label>
                <Form.Control onChange={props.onChange} value={props.value} type="email" name="email" id="email" placeholder="Insira seu e-mail"/>
            </Col>
        </Row>
    )
}
export default RowEmail