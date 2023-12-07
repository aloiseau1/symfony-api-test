
function startRequestCommunes() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/communes", true);
    xhr.onprogress = function () {
        console.log("PROGRESS:", xhr.responseText)
    }
    xhr.send();
}

function startRequestPortes() {
    const params = {
        'porteCount': parseInt(document.getElementById('porteCount').value),
        'prefixName': document.getElementById('prefixName').value,
        'comments': document.getElementById('comments').value,
        'version': parseInt(document.getElementById('version').value)
    }
    console.log(params);
    const xhr = new XMLHttpRequest();
    let lastResponseLength = null;
    let response = null;
    xhr.open("POST", "/api/portes/collection", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onprogress = function () {
        if (!lastResponseLength) {
            response = xhr.responseText;
            lastResponseLength = xhr.responseText.length;
        } else {
            response = xhr.responseText.substring(lastResponseLength);
            lastResponseLength = xhr.responseText.length;
        }
        console.log(response);
        const div = document.getElementById('progress-bar-portes');
        const responseData = JSON.parse(response);

        div.ariaValueNow = responseData.progress;
        div.style.width = `${responseData.progress}%`;
    }
    xhr.send(JSON.stringify(params));
}

function startRequestDeletePorte() {
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", "/api/portes/collection");
    xhr.send();
}