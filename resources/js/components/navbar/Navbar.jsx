import { Container } from "react-bootstrap";
import { useDispatch, useSelector } from "react-redux";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { logout } from "../../redux/slices/authSlice";
import api from "../../util/api";
import NavbarToggler from "./NavbarToggler";
import NavItemLink from "./NavItemLink";

const Navbar = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const logged = useSelector(state => state.auth.logged);
    const user = useSelector(state => state.auth.user);

    const handleLogout = () => {
        api.get("/logout").then(() => {
            dispatch(logout());
            navigate("/login");
        });
    };

    return (
        <nav className="navbar fs-6 p-2 navbar-dark bg-primary navbar-expand-md">
            <Container fluid>
                <Link to={"/"} className="navbar-brand fs-5">
                    Passaver
                </Link>
                <NavbarToggler />
                {logged && (
                    <div className="collapse navbar-collapse" id="myNav">
                        <ul className="navbar-nav ms-3 me-auto">
                            <NavItemLink href={"/"}>
                                <i className="bi-house"></i> Principal
                            </NavItemLink>
                            <NavItemLink href={"/arquivos"}>
                                <i className="bi-file-post"></i> Arquivos
                            </NavItemLink>
                        </ul>
                        <ul className="navbar-nav ms-auto">
                            <NavItemLink href={"/perfil"}>
                                <i className="bi-person"></i> {user.nome}
                            </NavItemLink>
                            <NavItemLink onClick={handleLogout} href={"/login"}>
                                <i className="bi-power"></i> Sair
                            </NavItemLink>
                        </ul>
                    </div>
                )}
            </Container>
        </nav>
    );
};
export default Navbar;
