function onJsonPosts(json) {
    const mainFeed = document.querySelector("#feed");

    if (!json) {
        console.log("Nessun risultato trovato.");
        const notFound = document.createElement("div")
        notFound.classList.add("no-data")
        notFound.textContent = "Non ho trovato nulla, riprova!";
        mainFeed.appendChild(notFound);
    }
    
    if (json) {
        console.log(json);
        console.log("Trovati " + json.length + " risultati");
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

        const feedEnd = document.createElement('div');
        feedEnd.classList.add("end");
        feedEnd.textContent = "Fine dei risultati. Hai visualizzato " + json.length + " posts.";
        mainFeed.appendChild(feedEnd);
    }

}


function onResponse(response) {
    return response.json();
}

function onError(error) {
    console.log("Errore durante la ricerca: " + error);
}

fetch("fetch.php?posts=all").then(onResponse, onError).then(onJsonPosts);