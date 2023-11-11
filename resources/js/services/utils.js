export function getCookie(name) {
    const regex = new RegExp(`(^| )${name}=([^;]+)`)
    const match = document.cookie.match(regex)
    console.log('cookies: ', document.cookie)
    console.log(match[2])
    if (match) {
        return decodeURI(match[2])
    }

}


