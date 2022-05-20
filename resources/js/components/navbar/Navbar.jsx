import cookie from "react-cookies";
import { Link, useNavigate } from "react-router-dom";
import api from "../../util/api";
import { isLoggedIn } from "../../util/auth";
import NavbarToggler from "./NavbarToggler";
import NavItemLink from "./NavItemLink";

const Navbar = (props) => {
    const navigate = useNavigate()

    const logOut = () => {
        api.get('/logout')
            .then(() => {
                cookie.remove('logged')
                navigate('/login')
            })
    }

    return (
        <nav className="navbar fs-6 p-2 navbar-dark bg-primary navbar-expand-md">
            <div className="container-fluid">
                <Link to={"/"} className="navbar-brand fs-5">
                    Passaver
                </Link>
                <NavbarToggler />
                {isLoggedIn() &&
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
                                <i className="bi-person"></i> Usuário
                            </NavItemLink> 
                            <NavItemLink onClick={logOut} href={"/login"}>
                                <i className="bi-power"></i> Sair
                            </NavItemLink>
                        </ul>
                    </div>
                }
            </div>
        </nav>
    );
};
export default Navbar;
