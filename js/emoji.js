window.addEventListener('load', () => {

    // 絵文字の変換
    $(".msg_content").each(function(){
        const html = $(this).html();
        const convertedHtml = emojione.shortnameToUnicode(html);
        $(this).html(convertedHtml);
    });
})