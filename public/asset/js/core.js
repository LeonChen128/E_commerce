
const Data = {
    set (key, val) { localStorage.setItem(key, JSON.stringify(val)) },
    get (key) { return JSON.parse(localStorage.getItem(key)) },
    del (key) { return localStorage.removeItem(key) }
}