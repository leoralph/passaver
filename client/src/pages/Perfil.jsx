import { Form } from "react-bootstrap";
import api from "../util/api";

const Perfil = props => {
    const submitSheet = e => {
        api.post("/conta/importar", e.target.files, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    };

    return (
        <div>
            <Form.Control onChange={submitSheet} type="file" />
        </div>
    );
};
export default Perfil;
