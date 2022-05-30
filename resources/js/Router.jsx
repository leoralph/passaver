import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./components/navbar/Navbar";
import ProtectedPage from "./util/middleware/ProtectedPage";
import Cadastro from "./pages/auth/Cadastro";
import Login from "./pages/auth/Login";
import Home from "./pages/Home";
import Arquivos from "./pages/Arquivos";
import Perfil from "./pages/Perfil";

const Router = () => {
    return (
        <BrowserRouter>
            <Navbar />
            <Routes>
                <Route path="/login" element={<Login />} />
                <Route path="/cadastro" element={<Cadastro />} />
                <Route path="/" element={<ProtectedPage page={Home} />} />
                <Route path="/arquivos" element={<ProtectedPage page={Arquivos} />} />
                <Route path="/perfil" element={<ProtectedPage page={Perfil} />} />
            </Routes>
        </BrowserRouter>
    );
};

export default Router;
