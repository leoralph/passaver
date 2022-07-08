import { Col, FormCheck, Row } from "react-bootstrap"
import { Link } from "react-router-dom"

const RowRemember = (props) => {
    return (
        <Row className="mt-3">
            <Col>
                <Link to={"/cadastro"}>Cadastre-se</Link>
            </Col>
            <Col xs="auto">
                <FormCheck.Input type="checkbox" onChange={props.onChange} checked={props.checked} name="remember" id="remember" />
                <FormCheck.Label htmlFor="remember" className="ms-1 text-light">Lembrar de mim</FormCheck.Label>
            </Col>
        </Row>
    )
}
export default RowRemember