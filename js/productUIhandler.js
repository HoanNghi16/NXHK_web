const params = new URLSearchParams(window.location.search);

function changeURL(){
    const url = new URL(window.location)
    url.search = params.toString()
    window.location.href = url
}

document.addEventListener("DOMContentLoaded", ()=>{
    if (!params.has("cate")) {
        params.set("cate", "");
    }
    if (!params.has("price")) {
        params.set("price", "");
    }
    if (!params.has("page")) {
        params.set("page", "1");
        
    }
    const pageInput = document.getElementById("pageInput");
    pageInput.value = params.get("page");
    const url = new URL(window.location)
    url.search = params;
    window.history.replaceState({}, "", url)
})

function filterForm(e){
    const id = e.id;
    if (id == "cate") {
        params.set("cate", e.value);
    }
    if (id == "price") {
        params.set("price", e.value);
    }
    changeURL()
}

function changePage(e, max){
    const id = e.id;
    let page = parseInt(params.get("page"));
    if (id == "prev") {
        page = Math.max(1, page - 1);

    }
    if (id == "next") {
        page = Math.min(max,page + 1);
    }
    if(id=="pageInput"){
        if (e.value>max){
            page = max
        }else if (e.value < 1){
            page = 1
        }
    }
    params.set("page", page);
    const url = new URL(window.location);
    url.search = params.toString();
    window.location.href = url;
}

function sortHandler(e){
    params.set("sort", e.value);
    const url = new URL(window.location);
    url.search = params.toString();
    window.location.href=url
}