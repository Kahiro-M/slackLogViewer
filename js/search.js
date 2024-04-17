window.addEventListener('load', () => {
    const anchor = location.hash.slice(1);
    if(anchor != "eom" && anchor != ""){
        $("#"+anchor).addClass("search_find");
    }
})
