import cookie from "react-cookies";
import { useNavigate } from "react-router-dom";

export const isLoggedIn = () => cookie.load('logged')
