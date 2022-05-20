import { Button, Table } from "react-bootstrap"

const TableContas = (props) => {
    return (
        <Table>
            <thead>
                <tr>
                    <th>#</th>
                    <th width="100%">Apelido</th>
                    <th colSpan="2" className="text-center">Ações</th>
                </tr>
            </thead>
            <tbody id="tbody">
                {props.contas.map((conta, id) => 
                    <tr key={id}>
                        <td>{id + 1}</td>
                        <td>{conta.apelido}</td>
                        <td className="text-center">
                            <Button onClick={() => props.handleOpen(conta.id)} variant="secondary" size="sm"><i className="bi-search"></i></Button>
                        </td>
                        <td className="text-center px-0">
                            <Button size="sm"><i className="bi-trash"></i></Button>
                        </td>
                    </tr>
                )}
            </tbody>
        </Table>
    )
}
export default TableContas