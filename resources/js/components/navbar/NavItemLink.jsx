import { Link } from "react-router-dom"

const NavItemLink = (props) => {
    return (
        <li className="nav-item">
            <Link onClick={props.onClick} className="nav-link" to={props.href}>{props.children}</Link>
        </li>
    )
}
export default NavItemLink