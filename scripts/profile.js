function deletePost(event) {
    fetch("delete_post.php?q=" + event.currentTarget.dataset.postId);
    const toDelete = event.currentTarget.parentNode.parentNode;
    toDelete.remove();
}

function onJson(json) {
    const mainFeed = document.querySelector("#feed");

    if (!json) {
        console.log("Non ho trovato alcun elemento.");
        const notFound = document.createElement("div")
        notFound.classList.add("no-data")
        notFound.textContent = "Non hai ancora creato nessun post!"
        mainFeed.appendChild(notFound);
    }

    if (json) {
        console.log(json);
        console.log("Trovati " + json.length + " elementi");
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

            const pageDeleteContent = document.createElement('div');
            pageDeleteContent.classList.add('deletecontent');
            div.appendChild(pageDeleteContent);

            const pageDelete = document.createElement('button');
            pageDelete.classList.add('delete');
            pageDelete.textContent = "Elimina Post";
            pageDelete.dataset.postId = json[i].id_post;
            pageDeleteContent.appendChild(pageDelete);
            mainFeed.appendChild(div);



            const deleteButtons = document.querySelectorAll('.delete');
            for (const deleteButton of deleteButtons) {
                deleteButton.addEventListener('click', deletePost);
            }
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
    console.log("Errore: " + error);
}

fetch("fetch.php?posts=mine").then(onResponse).then(onJson);