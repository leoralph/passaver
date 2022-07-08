import { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Navigate, Outlet } from "react-router-dom";
import { changeUser } from "../redux/slices/authSlice";
import api from "../util/api";

const Authenticated = ({ page: Page, ...props }) => {
    const logged = useSelector(state => state.auth.logged);
    const time = useSelector(state => state.auth.time);
    const [loading, setLoading] = useState(true);
    const dispatch = useDispatch();

    useState(() => {
        if (logged && time - Date.now() < 5400) {
            setLoading(false);
        } else {
            api.get("/usuario")
                .then(res => {
                    dispatch(changeUser(res.data.usuario));
                    setLoading(false);
                })
                .catch(() => setLoading(false));
        }
    });

    if (loading) return <></>;

    return logged ? <Outlet /> : <Navigate to={"/login"} />;
};

export default Authenticated;
