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
                    <tr key={index}>
                        <td>{index + 1}</td>
                        <td width="100%">
                            <a>{arquivo.nome}</a>
                        </td>
                        <td className="d-none text-nowrap d-lg-table-cell">{arquivo.created_at}</td>
                        <td className="d-none text-nowrap d-lg-table-cell">{arquivo.tamanho}</td>
                        <td className="text-center">
                            <Button onClick={() => props.handleOpenExclusao(arquivo.id, arquivo.nome)} variant="danger" size="sm">
                                <i className="bi-trash"></i>
                            </Button>
                        </td>
                    </tr>
                ))}
            </tbody>
        </Table>
    );
};
export default TableArquivos;
