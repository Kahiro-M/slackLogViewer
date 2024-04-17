window.onload = () => {
    const anchor = location.hash.slice(1);
    if(anchor != "eom"){
        $("#"+anchor).addClass("search_find");
    }
}