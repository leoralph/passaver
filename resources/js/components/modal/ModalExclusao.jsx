import { Button, Modal } from "react-bootstrap";
import api from "../../util/api";

const ModalExclusao = props => {
    const handleExclusao = () => {
        api.delete(`/${props.objeto}/${props.target}`).then(() => {
            props.reload();
            props.handleClose();
        });
    };

    return (
        <Modal show={props.show} onHide={props.handleClose}>
            <Modal.Header className="bg-warning text-light">
                <Modal.Title>EXCLUIR CONTA</Modal.Title>
            </Modal.Header>
            <Modal.Body>Deseja confirmar a exclusão do(a) {props.objeto} "{props.nome}"?</Modal.Body>
            <Modal.Footer>
                <Button onClick={handleExclusao} variant="success">
                    <i className="bi-check-lg"></i> Sim
                </Button>
                <Button onClick={props.handleClose} variant="secondary" type="button">
                    <i className="bi-x-lg"></i> Não
                </Button>
            </Modal.Footer>
        </Modal>
    );
};
export default ModalExclusao;
