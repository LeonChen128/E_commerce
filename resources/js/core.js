// 取得 URL 之參數
function getParameterByName(name, url = window.location.href) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

const Data = {
  set (key, val) { localStorage.setItem(key, JSON.stringify(val)) },
  get (key) { return JSON.parse(localStorage.getItem(key)) },
  del (key) { return localStorage.removeItem(key) }
}

export { getParameterByName, Data }
