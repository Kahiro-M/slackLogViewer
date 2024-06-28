window.addEventListener('load', () => {

    // 複数行コード
    $('.msg_content').each(function() {
        var content = $(this).html();
        var newContent = content.replace(/```(.*?)```/gs, '<span class="block-code">$1</span>');
        $(this).html(newContent);
    });

    // 1行コード
    $('.msg_content').each(function() {
        var content = $(this).html();
        var newContent = content.replace(/`(.*?)`/gs, '<span class="inline-code">$1</span>');
        $(this).html(newContent);
    });

    // 引用行
    $('.msg_content').each(function() {
        var content = $(this).html();
        var lines = content.split(/(\n|<br>)/);
        for (var i = 0; i < lines.length; i++) {
            if (lines[i].trim().startsWith('&gt;')) {
                lines[i] = '<span class="quote">' + lines[i].trim().replace('&gt;','') + '</span>';
            }
        }
        $(this).html(lines.join('\n'));
    });
})