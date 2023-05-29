function onJsonSearch(json) {
    if (!json) {
        const post = document.querySelector("#feed");
        post.innerHTML = "";
        const notFound = document.createElement("div");
        notFound.classList.add("search_error");
        notFound.textContent = "La ricerca non ha prodotto risultati."
        post.appendChild(notFound);
    }
    else {
        console.log(json);
        console.log(json.length);
        document.querySelector("#feed").innerHTML = "";

        const searchResponse = document.createElement("div");
        searchResponse.textContent = "La tua ricerca '" + json[0].searchedFor + "' ha prodotto " + json.length + " risultati.";
        searchResponse.classList.add("search_success");
        document.querySelector("#feed").appendChild(searchResponse);

        for (let i = 0; i < json.length; i++) {
            const mainFeed = document.querySelector("#feed");

            const div = document.createElement("div");
            div.classList.add("post");

            const title = document.createElement("div");
            title.classList.add("title");
            title.textContent = json[i].content.title;
            div.appendChild(title);

            const author = document.createElement("div");
            author.classList.add("author");
            author.textContent = "@" + json[i].author;
            div.appendChild(author);

            const content = document.createElement("div");
            content.classList.add("content");
            content.textContent = json[i].content.caption;
            div.appendChild(content);

            const gif = document.createElement("img");
            gif.classList.add("gif");
            gif.src = json[i].content.gif;
            div.appendChild(gif);

            mainFeed.appendChild(div);
        }
    }
}

function onResponse(response) {
    return response.json();
}

function onError(error) {
    console.log("Errore: " + error);
}

function searchPost(event) {
    event.preventDefault();

    const query = document.querySelector("#search_fieldbox").value;
    if (query) fetch("fetch.php?search=" + encodeURIComponent(query)).then(onResponse, onError).then(onJsonSearch)
    else {
        document.querySelector("#feed").innerHTML = "";
        const empty = document.createElement("div");
        empty.classList.add("search_error");
        empty.textContent = "Scrivi prima nella barra di ricerca!";
        const article = document.querySelector("#feed");
        article.appendChild(empty);
    }
}

const form = document.querySelector('#search_form');
form.addEventListener('submit', searchPost);
