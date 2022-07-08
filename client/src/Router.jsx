import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./components/navbar/Navbar";
import ProtectedPage from "./middleware/Authenticated";
import Cadastro from "./pages/auth/Cadastro";
import Login from "./pages/auth/Login";
import Home from "./pages/Home";
import Arquivos from "./pages/Arquivos";
import Perfil from "./pages/Perfil";
import Authenticated from "./middleware/Authenticated";

const Router = () => {
    return (
        <BrowserRouter>
            <Navbar />
            <Routes>
                <Route path="/login" element={<Login />} />
                <Route path="/cadastro" element={<Cadastro />} />
                <Route element={<Authenticated/>}>
                    <Route path="/" element={<Home/>} />
                    <Route path="/arquivos" element={<Arquivos/>} />
                    <Route path="/perfil" element={<Perfil/>} />
                </Route>
            </Routes>
        </BrowserRouter>
    );
};

export default Router;
