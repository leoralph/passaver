import { Navigate, Router } from "react-router-dom"
import { isLoggedIn } from "../auth"

export const authenticated = (component) => {

    if (isLoggedIn()) {
        return component
    }

}