window.onload = function () {
    searchNews();
};



function searchNews() {

    let params = {};

    const query = document.getElementById("query").value;
    const from = document.getElementById("fromDate").value;
    const to = document.getElementById("toDate").value;
    const language = document.getElementById("language").value;
    const sortBy = document.getElementById("sortBy").value;

    if (query) params.query = query;
    if (from) params.from = from;
    if (to) params.to = to;
    if (language) params.language = language;
    if (sortBy) params.sortBy = sortBy;

    console.log("SEARCH STARTED");
    console.log(params);

    sendRequest(params);
}

function sendRequest(params) {

    fetch("/news/fetch", {

        method: "POST",

        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },

        body: JSON.stringify(params)
    })

    .then(res => {
        console.log(res);
        return res.json();
    })

    .then(data => {

        console.log(data);

        const container = document.getElementById("results");

        container.innerHTML = "";

        if (data.error) {

            container.innerHTML =
                `<p style="color:red;">${data.error}</p>`;

            return;
        }

        if (!data.articles || data.articles.length === 0) {

            container.innerHTML =
                "<p>No results found</p>";

            return;
        }

        data.articles.forEach(article => {
            const date = article.publishedAt 
                ? new Date(article.publishedAt).toLocaleDateString("en-US", { month: "short", day: "numeric" })
                : "Recently";

            const validImage =
                article.urlToImage &&
                article.urlToImage !== "null" &&
                article.urlToImage.trim() !== "";

            const image = validImage
                ? `<img 
                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500"
                    src="${article.urlToImage}" 
                    alt="news image"
                    onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '<div class=\\'w-full h-48 flex items-center justify-center text-4xl\\'>📰</div>')"
                    >`
                : `<div class="w-full h-48 flex items-center justify-center text-4xl">📰</div>`;

            container.innerHTML += `
                <div class="group flex flex-col bg-surface-container-low rounded-2xl overflow-hidden hover:bg-surface-bright transition-all duration-300">
                    <div class="aspect-[16/9] overflow-hidden">
                        ${image}
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-6 h-6 rounded-full bg-primary/20 flex items-center justify-center text-xs font-bold text-primary">
                                ${article.source?.name ? article.source.name.substring(0,2).toUpperCase() : "NW"}
                            </div>
                            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">${article.source?.name || "News"}</span>
                            <span class="text-xs text-muted/60">• ${date}</span>
                        </div>

                        <h3 onclick="window.open('${article.url}', '_blank')" 
                            class="text-xl font-bold text-slate-50 mb-4 leading-snug cursor-pointer group-hover:text-primary transition-colors line-clamp-2">
                            ${article.title}
                        </h3>

                        <p class="text-on-surface-variant/80 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                            ${article.description || "No description available."}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-outline-variant/10">
                            <div class="flex items-center gap-4">
                                <button class="flex items-center gap-1.5 text-error text-xs font-bold">
                                    <i class="fa-solid fa-heart"></i> 
                                    <span>${Math.floor(Math.random()*1500)+500}</span>
                                </button>
                                <button class="flex items-center gap-1.5 text-on-surface-variant text-xs font-bold hover:text-on-surface">
                                    <i class="fa-solid fa-comment"></i> 
                                    <span>${Math.floor(Math.random()*80)+15}</span>
                                </button>
                            </div>
                            <button onclick="window.open('${article.url}', '_blank')" class="text-on-surface-variant hover:text-on-surface">
                                <span class="material-symbols-outlined">bookmark</span>
                            </button>
                        </div>
                    </div>
                </div>
                    
            `;
        });
    })

    .catch(error => {

        console.log(error);

        document.getElementById("results").innerHTML =
            "<p style='color:red;'>Server error. Try again later.</p>";
    });
}

function showCategory(category) {

    const language =
        document.getElementById("language").value;

    const categoryMap = {
        'Philosophy': 'فلسفة',
        'Art': 'فن',
        'Technology': 'تكنولوجيا',
        'Politics': 'سياسة'
    };

    if (
        language === "ar" ||
        language === "arabic" ||
        language === "Arabic"
    ) {

        if (categoryMap[category]) {
            category = categoryMap[category];
        }
    }

    const query = category;

    document.getElementById("query").value = category;

    const from =
        document.getElementById("fromDate").value;

    const to =
        document.getElementById("toDate").value;

    const sortBy =
        document.getElementById("sortBy").value;

    let params = { query, from, to, language, sortBy };


    
    console.log("SEARCH STARTED");
    console.log(params);

    sendRequest(params);
}