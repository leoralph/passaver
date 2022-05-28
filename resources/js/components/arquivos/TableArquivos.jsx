import { Button, Table } from "react-bootstrap";

const TableArquivos = props => {
    return (
        <Table>
            <thead>
                <tr>
                    <th>#</th>
                    <th width="100%">Nome</th>
                    <th className="d-none text-nowrap d-lg-table-cell">Data de Criação</th>
                    <th className="d-none text-nowrap d-lg-table-cell">Tamanho</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                {props.arquivos.map((arquivo, index) => (
                    <tr>
                        <td>{index}</td>
                        <td width="100%">
                            <a>{arquivo.nome}</a>
                        </td>
                        <td className="d-none text-nowrap d-lg-table-cell">{arquivo.created_at}</td>
                        <td className="d-none text-nowrap d-lg-table-cell">{arquivo.tamanho}</td>
                        <td className="text-center">
                            <Button variant="danger" size="sm">
                                <i class="bi-trash"></i>
                            </Button>
                        </td>
                    </tr>
                ))}
            </tbody>
        </Table>
    );
};
export default TableArquivos;
