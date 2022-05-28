import api from "./api"

export const isLoggedIn = () => {
    let user = api.get("/usuario")
        .then(() => {
            return true
        })

    console.log(user)
}