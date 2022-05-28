import { createSlice } from "@reduxjs/toolkit";

export const authSlice = createSlice({
    name: "auth",

    initialState: {
        user: {},
        logged: false,
        time: 0
    },

    reducers: {
        changeUser(state, { payload }) {
            return { ...state, logged: true, user: payload, time: Date.now() };
        },
        logout(state) {
            return { ...state, logged: false, user: {}, time: 0 };
        },
    },
});

export const { changeUser, logout } = authSlice.actions;

export const getUser = state => state.user;

export default authSlice.reducer;
