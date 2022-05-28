import React from "react";
import ReactDOM from "react-dom/client";
import { Provider } from "react-redux";
import Store from "./redux/Store";
import Router from "./Router";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
    // <React.StrictMode>
    <Provider store={Store}>
        <Router />
    </Provider>
    // </React.StrictMode>,
);
