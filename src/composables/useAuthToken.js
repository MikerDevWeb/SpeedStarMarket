import Cookies from "js-cookie";

const TOKEN_KEY = 'auth_token';

export function setToken(token) {
    Cookies.set(TOKEN_KEY, token, {
        expires: 30,
        secure: false, //change for true in production
        sameSite: 'Lax'
    });
}

export function getToken() {
    return Cookies.get(TOKEN_KEY);
}

export function removeToken() {
    Cookies.remove(TOKEN_KEY);
}