export function isValidUsername(username) {
    const regex = /^[a-zA-Z0-9_]+$/;
    return regex.test(username);
}